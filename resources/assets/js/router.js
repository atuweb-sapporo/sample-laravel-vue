import Vue    from 'vue'
import Router from 'vue-router'
import store  from '@/js/stores/index'

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

import MiscAboutPage from '@/js/components/Pages/Misc/About'
routes.push({
  path: '/about',
  component: MiscAboutPage
});


Vue.use(Router);
const router = new Router({
  mode: 'history',
  routes: routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    return {
      x: 0,
      y: 0
    }
  }
});

router.beforeEach((to, from, next) => {
  store.commit('loading/start');
  next();
});
router.afterEach(() => {
  store.commit('loading/finish');
});

export default router
