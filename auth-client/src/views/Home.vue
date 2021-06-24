<template>
  <div class="container">
    <div v-if="isLoggedIn" class="card">
        <div class="card-content">
            <div class="content">
                Welcome back <strong>{{ user.name }}!</strong>
            </div>
        </div>
    </div>
    <div v-else class="notification is-danger">
        You're not logged in!
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { getters } from '@/store';

export default {
  name: 'Home',
  data() {
    return {
      user: {},
    };
  },
  computed: {
    isLoggedIn: () => getters.isLoggedIn(),
  },
  async mounted() {
    if (this.isLoggedIn) {
      try {
        const response = await axios.get(`${process.env.VUE_APP_OAUTH_AUTH_SERVER}/api/user`);

        this.user = response.data;
      } catch (error) {
        console.log(error);
      }
    }
  },
};
</script>
