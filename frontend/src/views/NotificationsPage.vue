<template>
  <div class="notifications-container">
    <NotificationBlock> </NotificationBlock>
  </div>
</template>

<script setup>
import NotificationBlock from '../components/Notifications/NotificationBlock.vue'

import { onMounted, onUnmounted } from 'vue'

onMounted(() => {
  document.querySelector('.app-container')?.classList.add('no-scroll')
})

onUnmounted(() => {
  document.querySelector('.app-container')?.classList.remove('no-scroll')
})
</script>

<style scoped>
.notifications-container {
  display: grid;
  place-items: center;
  overflow-y: auto;
  box-sizing: border-box;
  padding-bottom: 10px;
}
</style>
