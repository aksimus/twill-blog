
import Vue from 'vue';

import feLib from 'fe-lib';
import store from '~/store';
import FrontpageDemoWidget from '~/FrontpageDemoWidget.vue';

import * as shared from '~/components/shared';

const frontPageDiv = document.querySelector('#front-page-demo-widget');
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

  import './theme';