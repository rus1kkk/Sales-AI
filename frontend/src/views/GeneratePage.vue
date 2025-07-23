<script setup>
import InputPrompt from '../components/Generate/InputPrompt.vue'
</script>

<template>
  <div class="input-prompt-container">
    <h1 class="fade-up" style="animation-delay: 0.2s">Какая задача будет сегодня?</h1>
    <InputPrompt></InputPrompt>
  </div>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  font-family: 'Montserrat', sans-serif;
}

.input-prompt-container {
  display: flex;
  flex-direction: column;
  height: 90vh;
  justify-content: center;
  align-items: center;
  gap: 34px;
}

.input-prompt-container > h1 {
  font-size: 38px;
  font-weight: 400;
  line-height: 120%;
  text-align: center;
  color: var(--white-color);
}

.fade-up {
  opacity: 0;
  animation: fadeUp 0.8s ease-out forwards;
}

@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
