<template>
  <header>
    <div class="header-content">
      <router-link to="/" class="header-title">SALES AI</router-link>
      <nav>
        <router-link to="/" class="nav-link">ГЛАВНАЯ</router-link>
        <router-link to="/generate" class="nav-link">ГЕНЕРИРОВАТЬ</router-link>
        <router-link to="" class="nav-link">ПОДПИСКА</router-link>
        <router-link to="" class="nav-link">ИСТОРИЯ</router-link>
      </nav>
      <button class="login-btn">ВХОД</button>
    </div>
  </header>
</template>

<script>
import { RouterLink } from 'vue-router'

export default {
  name: 'AppHeader',
  components: {
    RouterLink,
  },
}
</script>

<style scoped>
.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 32px 80px;
}

.header-title {
  font-size: 32px;
  color: var(--actient-color);
  font-weight: 400;
  text-decoration: none;
}
nav {
  display: flex;
  gap: 25px;
  align-items: center;
  font-weight: 500;
}
.nav-link {
  color: var(--standart-color);
  text-decoration: none;
  font-size: 20px;
}

.nav-link:hover {
}

.login-btn {
  background-color: var(--btn-background-color);
  color: var(--btn-text-color);
  border: none;
  font-size: 20px;
  font-weight: 600;
  border-radius: 18px;
  cursor: pointer;
  height: 45px;
  width: 114px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.login-btn:hover {
}
</style>
