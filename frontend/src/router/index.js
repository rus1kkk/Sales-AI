import { createRouter, createWebHistory } from 'vue-router'
import MainPage from '../views/MainPage.vue'
import GeneratePage from '../views/GeneratePage.vue'

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
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
