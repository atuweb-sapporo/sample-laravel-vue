import Vue    from 'vue'
import Router from 'vue-router'

let routes = [];

import IndexPage from '@/js/components/Pages/Index'
routes.push({
  path: '/',
  component: IndexPage
});

import LoginPage from '@/js/components/Pages/Login'
routes.push({
  path: '/login',
  component: LoginPage
});

import LogoutPage from '@/js/components/Pages/Logout'
routes.push({
  path: '/logout',
  component: LogoutPage
});


import PostEditPage from '@/js/components/Pages/Post/Edit'
routes.push({
  path: '/post/edit',
  component: PostEditPage
});

Vue.use(Router);
export default new Router({
  mode: 'history',
  routes: routes,
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    return {
      x: 0,
      y: 0
    }
  }
});
