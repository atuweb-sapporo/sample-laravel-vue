<template>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <router-link to="/" class="navbar-brand">To TopPage</router-link>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul v-if="userState.loaded" class="nav navbar-nav navbar-right">
          <li v-if="userState.authenticated" class="login-name">
            <span class="label label-info">ログイン中</span> <span>{{ userState.user.name }}</span>
          </li>
          <li v-if="userState.authenticated">
            <router-link to="/logout">Logout</router-link>
          </li>
          <li v-if=" ! userState.authenticated">
            <router-link to="/login">Login</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import userStore from '@/js/stores/userStore'

export default {
  data() {
    return {
      userState: userStore.state
    }
  }
}
</script>

<style>
  .nav li.login-name {
    padding: 10px 15px;
  }
</style>
