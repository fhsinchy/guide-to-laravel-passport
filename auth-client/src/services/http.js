import axios from 'axios';
import router from '@/router';
import { store, mutations, actions } from '@/store';

export default function configureAxios() {
  axios.defaults.headers = {
    // eslint-disable-next-line quote-props
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  };
  axios.defaults.baseURL = process.env.VUE_APP_OAUTH_AUTH_SERVER;

  axios.interceptors.request.use(
    (config) => {
      const token = store.accessToken;

      if (token) {
        // eslint-disable-next-line no-param-reassign
        config.headers.Authorization = `Bearer ${token}`;
      }

      return config;
    },
    (error) => {
      Promise.reject(error);
    },
  );

  axios.interceptors.response.use(
    (response) => response,
    async (error) => {
      const originalRequest = error.config;

      // eslint-disable-next-line no-underscore-dangle
      if (error.response.status === 401 && !originalRequest._retry) {
        // eslint-disable-next-line no-underscore-dangle
        originalRequest._retry = true;

        const res = await axios.post('/oauth/token', {
          grant_type: 'refresh_token',
          refresh_token: window.localStorage.getItem('refreshToken'),
          client_id: process.env.VUE_APP_OAUTH_CLIENT_ID,
          client_secret: process.env.VUE_APP_OAUTH_CLIENT_SECRET,
          scope: '',
        });

        mutations.setToken(res.data.access_token);
        window.localStorage.setItem('accessToken', res.data.access_token);
        window.localStorage.setItem('refreshToken', res.data.refresh_token);

        originalRequest.headers.Authorization = `Bearer ${res.data.accessToken}`;

        return axios(originalRequest);
      }

      actions.logout();
      router.go();
      return Promise.reject(error);
    },
  );
}
