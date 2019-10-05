import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/customers/edit',
      name: 'customers-edit',
      component: () => import('./pages/customers/Edit.vue')
    },
    {
      path: '/customers',
      name: 'customers-index',
      component: () => import('./pages/customers/Index.vue')
    },
    {
      path: '/',
      redirect: '/customers'
    }
  ]
})
