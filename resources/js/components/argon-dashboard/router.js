import Vue from 'vue'
import Router from 'vue-router'
import DashboardLayout from './layout/DashboardLayout'
import AuthLayout from './layout/AuthLayout'
Vue.use(Router)

export default new Router({
  linkExactActiveClass: 'active',
  routes: [
    {
      path: '/',
      redirect: 'dashboard',
      component: DashboardLayout,
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          // route level code-splitting
          // this generates a separate chunk (about.[hash].js) for this route
          // which is lazy-loaded when the route is visited.
          component: () => import(/* webpackChunkName: "demo" */ './views/Dashboard.vue')
        },
        {
          path: '/service',
          name: 'Service',
          component: () => import(/* webpackChunkName: "demo" */ './views/Service.vue')
        },
        {
          path: '/jobcat',
          name: 'Jasa & Kategori Servis',
          component: () => import(/* webpackChunkName: "demo" */ './views/JobCat.vue')
        },
        {
          path: '/spart',
          name: 'Spare Part',
          component: () => import(/* webpackChunkName: "demo" */ './views/SparePart.vue')
        },
        {
          path: '/sales',
          name: 'Penjualan',
          component: () => import(/* webpackChunkName: "demo" */ './views/Sales.vue')
        },
        {
          path: '/supplier',
          name: 'Supplier',
          component: () => import(/* webpackChunkName: "demo" */ './views/Supplier.vue')
        },
        {
          path: '/technician',
          name: 'Teknisi',
          component: () => import(/* webpackChunkName: "demo" */ './views/Technician.vue')
        },
        {
          path: '/user',
          name: 'User',
          component: () => import(/* webpackChunkName: "demo" */ './views/User.vue')
        },
        {
          path: '/customer',
          name: 'Pelanggan',
          component: () => import(/* webpackChunkName: "demo" */ './views/Customer.vue')
        },
        {
          path: '/report',
          name: 'Laporan',
          component: () => import(/* webpackChunkName: "demo" */ './views/Report.vue')
        }
      ]
    },
    {
      path: '/',
      redirect: 'login',
      component: AuthLayout,
      children: [
        {
          path: '/login',
          name: 'login',
          component: () => import(/* webpackChunkName: "demo" */ './views/Login.vue')
        },
        {
          path: '/register',
          name: 'register',
          component: () => import(/* webpackChunkName: "demo" */ './views/Register.vue')
        }
      ]
    }
  ]
})
