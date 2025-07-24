<script setup>
import LoginForm from '../components/Login/LoginForm.vue'

import { onMounted, onUnmounted } from 'vue'

onMounted(() => {
  document.querySelector('.app-container')?.classList.add('no-scroll')
})

onUnmounted(() => {
  document.querySelector('.app-container')?.classList.remove('no-scroll')
})
</script>

<template>
  <div class="form-container">
    <LoginForm></LoginForm>
  </div>
</template>

<style>
.form-container {
  display: grid;
  place-items: center;
  max-height: calc(100vh - 103px);
  min-height: calc(100vh - 103px);
  overflow-y: auto;
  box-sizing: border-box;
  padding-bottom: 10px;
}
</style>
