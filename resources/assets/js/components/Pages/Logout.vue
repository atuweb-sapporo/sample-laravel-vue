<template>
  <div class="login">
    <h3>Logout</h3>
  </div>
</template>

<script>
import firebase  from 'firebase'
import userStore from '@/js/stores/userStore'

export default {
  created() {
    firebase.auth().signOut();
    userStore.setCurrentUser({});
    localStorage.removeItem('jwt-token');

    this.$router.push('/');
  }
}
</script>
