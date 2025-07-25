import { createRouter, createWebHistory } from 'vue-router'

import MainPage from '../views/MainPage.vue'
import GeneratePage from '../views/GeneratePage.vue'
import SubscriptionPage from '../views/SubscriptionPage.vue'
import ProfileView from '../views/ProfileView.vue'
import HistoryPage from '../views/HistoryPage.vue'
import LoginPage from '../views/LoginPage.vue'
import PresentationPage from '../views/PresentationPage.vue'
import ChatPage from '../views/ChatPage.vue'
import EditorPage from '../views/EditorPage.vue'
import NotificationsPage from '../views/NotificationsPage.vue'
import PaymentPage from '../views/PaymentPage.vue'
import TzPage from '../views/TzPage.vue'

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
    component: ChatPage,
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
  },
  {
  path: '/manager',
  name: 'ManagerPage',
  component: () => import('@/views/ManagerPage.vue')
    },
  {
    path: '/presentation',
    name: 'PresentationPage',
    component: PresentationPage,
  },
  {
    path:'/edit',
    name: 'EditorPage',
    component:EditorPage,
  },
  {
    path: '/notifications',
    name: 'NotificationsPage',
    component: NotificationsPage,
  },
  {
    path: '/editTZ',
    name: 'TzPage',
    component: TzPage,
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
