window.dataLayer = window.dataLayer || [];
/*

vue -> dataLayer -> GTM -> GA4 
vue -> dataLayer -> push lintener in events.js -> FB 

vue components must use window.dataLayer.push({ ... })
don't use window.dataLayer.push() inside _sendEvents function, otherwise they will be looped
GTM read events from dataLayer and send them to GA4 ()



*/
(function (DL_NAME = 'dataLayer') {

  window[DL_NAME] = window[DL_NAME] || [];
  const dl = window[DL_NAME];


  const originalPush = dl.push.bind(dl);


  const subscribers = new Set();
  function notify(eventObj) {
    
    try {
      window.dispatchEvent(new CustomEvent('datalayer:event', { detail: eventObj }));
    } catch (e) {}
    // Колбэки
    subscribers.forEach(fn => {
      try { fn(eventObj); } catch (e) { console.error('DL subscriber error', e); }
    });
  }


  dl.push = function () {
    for (let i = 0; i < arguments.length; i++) {
      const payload = arguments[i];
      notify(payload);
    }
    return originalPush.apply(dl, arguments);
  };

  window.dataLayerListener = {
    subscribe(fn) { subscribers.add(fn); return () => subscribers.delete(fn); },
    getDataLayer() { return dl; },
    backlog() {
        if (dl.length) {
          dl.forEach(notify);
        }
    }
  };
})();



function uuidv4() {
  return ([1e7]+-1e3+-4e3+-8e3+-1e11)
    .replace(/[018]/g, c =>
      (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

window._sendEvent = async function (event) {
  _sendEvents([event]);
};

window._sendEvents = async function (events) {


  if (!Array.isArray(events)) {
    console.error('_sendEvent expects an array of event objects');
    return;
  }

  // Validate each event object, exclude GTM internal events, and keep only whitelisted names
  const allowedEventNames = [
    'app_init',
    'user_initialized', 
    'login', 
    'registration', 
    'demo_recalc_run', 
    'begin_checkout', 
    'purchase'
  ];
  const validEvents = events
    .filter(event => event && typeof event.event === 'string')
    .filter(event => !event.event.startsWith('gtm.'))
    .filter(event => allowedEventNames.includes(event.event));
  if (validEvents.length === 0) {
    return;
  }

  validEvents
    .forEach((event) => {


      // FB
      try {
        if (event.event == 'app_init') {

          fbq('track', 'PageView', {}, {eventID: event.event_id});
        }

        if (event.event == 'registration') {
          fbq('track', 'CompleteRegistration', {content_name: 'User Registration'}, {eventID: event.event_id});
        }

        if (event.event == 'purchase') {
          const { value, currency } = event.ecommerce;
          fbq('track', 'Purchase', { value, currency });
        }
      } catch (error) {
        console.error('Error sending events to FB:', error);
      }
    });
    

  try {
    const response = await fetch('/api/events', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ events: validEvents }),
    });

    if (!response.ok) {
      console.error('Failed to send events:', response.statusText);
    }
    
  } catch (error) {
    console.error('Error sending events:', error);
  }

};
window.getFbpFromCookie = function () {
  const match = document.cookie.match(/_fbp=([^;]+)/);
  return match ? match[1] : null;
};
window.getFbcFromCookie = function () {
  const cookie = document.cookie
    .split('; ')
    .find(row => row.startsWith('_fbc='));
  return cookie ? cookie.split('=')[1] : null;
};

window.getClientIdFromCookie = function () {
  const gaCookie = document.cookie
    .split('; ')
    .find(row => row.startsWith('_ga='));

  if (gaCookie) {
    const parts = gaCookie.split('.');
    if (parts.length >= 4) {
      return `${parts[2]}.${parts[3]}`;
    }
  }

  return null;
};


window.addEventListener('business_logic_event', (event) => {
  _sendEvent(event.detail);
});





function runInitEvent() {

  let attempts = 0;
  const maxAttempts = 10;
  const interval = 1000; // 1 second
 
  let browserData = {};
  try {
    browserData = {

      url: window.location.href,
      timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
      browserLang: navigator.language || navigator.userLanguage,
      screenResolution: `${screen.width}x${screen.height}`,
      browser: navigator.userAgent.match(/(Chrome|Firefox|Safari|Edge|Opera)/i)?.[0] || 'Unknown',
      os: navigator.platform || 'Unknown',
      isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    };
  } catch (error) {

    browserData = {

    };
  }

  const timer = setInterval(() => {
    attempts++;

    const gclientid = getClientIdFromCookie();
    const fbp = getFbpFromCookie();
    const fbc = getFbcFromCookie();


    const eventId = uuidv4();

    _sendEvent({
      event: 'app_init',
      gclientid,
      fbp,
      fbc,
      event_id: eventId,
      ...browserData
    });

    // run only if both are NOT empty
    if ((gclientid && fbp) || (attempts >= maxAttempts)) {
      clearInterval(timer); // stop if success
    }

  }, interval);
}

// Check if DOM is already ready or wait for it
function initWhenReady() {

  runInitEvent();

  const unsubscribe = window.dataLayerListener.subscribe((e) => {
     _sendEvent(e);

  });
  window.dataLayerListener.backlog();

}

if (document.readyState === 'loading') {
  // DOM is still loading, wait for DOMContentLoaded
  document.addEventListener("DOMContentLoaded", initWhenReady);
} else {
  // DOM is already ready, run immediately
  initWhenReady();
}
