import { createRouter, createWebHistory } from 'vue-router'

import MainPage from '../views/MainPage.vue'
import GeneratePage from '../views/GeneratePage.vue'
import SubscriptionPage from '../views/SubscriptionPage.vue'
import ProfileView from '../views/ProfileView.vue'
import LoginPage from '../views/LoginPage.vue'

const routes = [
  {
    path: '/',
    name: 'MainPage',
    component: MainPage,
  },
  {
    path: '/generate',
    name: 'GeneratePage',
    component: GeneratePage,
  },
  {
    path: '/subscription',
    name: 'SubscriptionPage',
    component: SubscriptionPage,
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage,
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
