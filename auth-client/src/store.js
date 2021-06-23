import Vue from 'vue';

export default Vue.observable({
  accessToken: window.localStorage.getItem('accessToken'),
});
