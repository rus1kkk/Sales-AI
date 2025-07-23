import { createRouter, createWebHistory } from 'vue-router'

import MainPage from '../views/MainPage.vue'
import GeneratePage from '../views/GeneratePage.vue'
import SubscriptionPage from '../views/SubscriptionPage.vue'
import ProfileView from '../views/ProfileView.vue'
import HistoryPage from '../views/HistoryPage.vue'
import LoginPage from '../views/LoginPage.vue'
import ChatPage from '../views/ChatPage.vue'
import PaymentPage from '../views/PaymentPage.vue'

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
    path: '/chat/:chatId?',
    name: 'ChatPage',
    component: ChatPage, // Импортируешь нужный компонент
    props: true,
  },
  {
    path: '/history',
    name: 'HistoryPage',
    component: HistoryPage,
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage,
  },
  {
    path: '/payment',
  name: 'PaymentPage',
  component: PaymentPage,
}
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
