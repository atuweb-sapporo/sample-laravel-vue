import Vue    from 'vue'
import Router from 'vue-router'

let routes = [];

import Example from '@/js/components/Example'
routes.push({
  path: '/',
  component: Example
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
