import Vue       from 'vue'
import router    from '@/js/router'
import http      from '@/js/services/http'
import userStore from '@/js/stores/userStore.js'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import fontawesome from '@fortawesome/fontawesome';
import fontawesome_regular from '@fortawesome/fontawesome-free-regular';
import fontawesome_solid from '@fortawesome/fontawesome-free-solid';
fontawesome.library.add(fontawesome_regular);
fontawesome.library.add(fontawesome_solid);

require('@/js/bootstrap');
require('@/js/global-defines');
require('@/js/services/firebase');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  router,
  el: '#app',
  created () {
    http.init()
    userStore.init()
  },
  render: h => h(require('@/js/app.vue')),
}).$mount('#app');
