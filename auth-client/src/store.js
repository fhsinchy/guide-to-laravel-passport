import Vue from 'vue';

export const store = Vue.observable({
  accessToken: window.localStorage.getItem('accessToken'),
});

export const getters = {
  isLoggedIn() {
    return !!store.accessToken;
  },
};

export const mutations = {
  setToken(token) {
    store.accessToken = token;
  },
};

export const actions = {
  logout() {
    store.accessToken = null;
    window.localStorage.removeItem('accessToken');
    window.localStorage.removeItem('refreshToken');
  },
};
