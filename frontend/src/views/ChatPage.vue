<template>
  <main class="chat-page">
    <ChatBlock />
  </main>
</template>

<script setup>
import ChatBlock from '../components/Chat/ChatBlock.vue'
import { onMounted, onUnmounted } from 'vue'

onMounted(() => {
  document.querySelector('.app-container')?.classList.add('no-scroll')
})

onUnmounted(() => {
  document.querySelector('.app-container')?.classList.remove('no-scroll')
})
</script>

<style></style>
