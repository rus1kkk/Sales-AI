<script setup>
import LoginForm from '../components/Login/LoginForm.vue'
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
  min-height: 90vh;
  height: 90vh;
  overflow-y: auto;
  box-sizing: border-box;
  padding-bottom: 10px;
}
</style>
