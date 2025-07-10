<template>
  <header>
    <div class="header-content">
      <router-link to="/" class="header-title">SALES AI</router-link>
      <nav>
        <router-link to="/" class="nav-link">ГЛАВНАЯ</router-link>
        <router-link to="/generate" class="nav-link">ГЕНЕРАЦИЯ</router-link>
        <router-link to="/subscription" class="nav-link">ПОДПИСКА</router-link>
        <router-link to="/history" class="nav-link disabled">ИСТОРИЯ</router-link>
      </nav>
      <router-link to="" class="login-btn">ВХОД</router-link>
    </div>
  </header>
</template>

<script>
import { RouterLink } from 'vue-router'
import '../assets/styles/AppHeader.css'

export default {
  name: 'AppHeader',
  components: {
    RouterLink,
  },
}
</script>
