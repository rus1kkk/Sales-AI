<template>
  <div class="notifications-container">
    <NotificationBlock> </NotificationBlock>
  </div>
</template>

<script setup>
import NotificationBlock from '../components/Notifications/NotificationBlock.vue'
</script>

<style scoped>
.notifications-container {
  display: grid;
  place-items: center;
  margin-top: 30px;
  overflow-y: auto;
  box-sizing: border-box;
  padding-bottom: 10px;
}
</style>
