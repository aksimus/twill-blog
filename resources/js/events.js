window._sendEvent = async function (event) {
  _sendEvents([event]);
};

window._sendEvents = async function (events) {
  window.dataLayer = window.dataLayer || [];

  if (!Array.isArray(events)) {
    console.error('_sendEvent expects an array of event objects');
    return;
  }

  // Validate each event object
  const validEvents = events.filter(event => event && typeof event.event === 'string');
  if (validEvents.length === 0) {
    return;
  }

  validEvents
    .filter(event => ['user_initialized', 'demo_recalc_run', 'begin_checkout', 'purchase'].includes(event.event))
    .forEach((event) => {
      window.dataLayer.push({ ecommerce: null }); // Clear the previous ecommerce object.
      window.dataLayer.push({ _type: 'business_logic_event', ...event });

      // FB
      try {
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


window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
  event: 'scriptReadyListener',
});

function runWhenGTMIsLoaded(callback) {
  const originalPush = dataLayer.push;
  dataLayer.push = function () {
    const args = Array.prototype.slice.call(arguments);
    for (const arg of args) {
      if (arg && arg.event === 'gtm.js') {
        callback();
      }
    }
    return originalPush.apply(dataLayer, args);
  };

  // Check if GTM is already loaded
  for (const item of dataLayer) {
    if (item && item.event === 'gtm.js') {
      callback();
      break;
    }
  }
}
/*
// Example usage:
runWhenGTMIsLoaded(() => {
  _sendEvent({
    event: 'init',
    gclientid: getClientIdFromCookie(),
    fbp: getFbpFromCookie(),
  });
});
*/
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
    
    _sendEvent({
      event: 'app_init',
      gclientid,
      fbp,
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
}

if (document.readyState === 'loading') {
  // DOM is still loading, wait for DOMContentLoaded
  document.addEventListener("DOMContentLoaded", initWhenReady);
} else {
  // DOM is already ready, run immediately
  initWhenReady();
}
