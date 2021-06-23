import Vue from 'vue';
import App from './App.vue';
import router from './router';
import configureAxios from './services/http';

import 'bulma/css/bulma.min.css';

Vue.config.productionTip = false;

configureAxios();

new Vue({
  router,
  render: (h) => h(App),
}).$mount('#app');
