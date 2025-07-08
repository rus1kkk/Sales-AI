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

.nav-link:hover,
.nav-link.router-link-active,
.login-btn:hover {
  color: var(--actient-color);
}

.nav-link.disabled {
  color: var(--muted-color);
  cursor: default;
  pointer-events: none;
}

.login-btn {
  color: var(--standart-color);
  font-size: 24px;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;

  /*background-color: var(--btn-background-color);
  color: var(--btn-text-color);
  border-radius: 18px;
  border: none;
  height: 45px;
  width: 114px;
  display: flex;
  align-items: center;
  justify-content: center;*/
}
</style>
