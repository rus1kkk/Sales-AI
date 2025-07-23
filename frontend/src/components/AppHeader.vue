<template>
  <header>
    <div class="header-content">
      <div class="header-btn menu-btn" @click="toggleMenu">
        <img src="../assets/images/burger.svg" alt="btn" />
      </div>
      <router-link to="/" class="header-title">SALES AI</router-link>
      <nav class="header-nav menu-list" :class="{ active: isMenuOpen }">
        <router-link to="/" class="nav-link" @click="closeMenu">ГЛАВНАЯ</router-link>
        <router-link to="/generate" class="nav-link" @click="closeMenu">ГЕНЕРАЦИЯ</router-link>
        <router-link to="/subscription" class="nav-link" @click="closeMenu">ПОДПИСКА</router-link>
        <router-link to="/history" class="nav-link" @click="closeMenu">ИСТОРИЯ</router-link>
        <router-link to="/login" class="nav-link login-btn nav-login-btn" @click="closeMenu"
          >ВХОД</router-link
        >
        <img
          src="../assets/images/cross.svg"
          alt="btn"
          class="img-fluid close-btn"
          @click="closeMenu"
        />
      </nav>
      <router-link to="/login" class="login-btn header-login-btn">ВХОД</router-link>
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
  data() {
    return {
      isMenuOpen: false,
    }
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen
    },
    closeMenu() {
      this.isMenuOpen = false
    },
    handleOutsideClick(event) {
      const menuList = this.$el.querySelector('.menu-list')
      const menuBtn = this.$el.querySelector('.menu-btn')

      if (this.isMenuOpen && !menuList.contains(event.target) && !menuBtn.contains(event.target)) {
        this.closeMenu()
      }
    },
  },
  mounted() {
    document.addEventListener('click', this.handleOutsideClick)
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleOutsideClick)
  },
  watch: {
    $route() {
      // Закрываем меню при изменении маршрута
      this.closeMenu()
    },
  },
}
</script>
