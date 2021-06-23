<template>
  <div class="container">
    <div class="notification is-info">
        Logging you in...
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import store from '@/store';

export default {
  async mounted() {
    try {
      const response = await axios.post(`${process.env.VUE_APP_OAUTH_AUTH_SERVER}/oauth/token`, {
        grant_type: 'authorization_code',
        client_id: process.env.VUE_APP_OAUTH_CLIENT_ID,
        client_secret: process.env.VUE_APP_OAUTH_CLIENT_SECRET,
        redirect_uri: process.env.VUE_APP_OAUTH_CLIENT_REDIRECT,
        code: this.$route.query.code,
      });

      store.accessToken = response.data.access_token;
      window.localStorage.setItem('accessToken', response.data.access_token);
      window.localStorage.setItem('refreshToken', response.data.refresh_token);

      this.$router.push('/');
    } catch (error) {
      console.log(error);

      this.$router.push('/');
    }
  },
};
</script>
