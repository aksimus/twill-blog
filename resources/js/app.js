
import Vue from 'vue';

import feLib from 'fe-lib';
import store from '~/store';
import FrontpageDemoWidget from '~/FrontpageDemoWidget.vue';
import OpenCalculatorButton from '~/OpenCalculatorButton.vue';

import * as shared from '~/components/shared';

const frontPageDiv = document.querySelector('#front-page-demo-widget');
const openCalculatorButton = document.querySelector('#open-calculator-button');

Vue.use(feLib);
Object.keys(shared).forEach((component) => {
    Vue.component(component, shared[component]);
  });
new Vue({
    el: frontPageDiv,
    components: { FrontpageDemoWidget },
    template: '<frontpage-demo-widget />',
    store,
  });



// Find all elements with specific attribute
const calculatorButtons = document.querySelectorAll('[data-vue-calculator]');

calculatorButtons.forEach((element) => {
  // Get attributes from existing element
  const props = {
    cssClass: element.className,
    href: element.getAttribute('href') || '#',
    target: element.getAttribute('target') || '_self',
    rel: element.getAttribute('rel') || '',
    buttonText: element.getAttribute('data-text') || element.textContent.trim(),
    iconClass: element.getAttribute('data-icon') || 'bx bx-user fs-5 lh-1 me-1'
  };

  new Vue({
    el: element,
    components: { OpenCalculatorButton },
    render(h) {
      return h('open-calculator-button', { props });
    },
    store,
  });
});
store.dispatch('auth/fetchUser');

  import './theme';