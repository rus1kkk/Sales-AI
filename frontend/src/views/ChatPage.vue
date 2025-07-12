<template>
  <div class="chat-wrapper">
    <div class="chat-container">
      <section class="chat-messages">
        <div v-for="(msg, index) in messages" :key="index" :class="['message', msg.sender]">
          <p>{{ msg.text }}</p>
        </div>
      </section>
    </div>
    <InputPrompt :onSubmit="handlePrompt" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import InputPrompt from '@/components/Generate/InputPrompt.vue'

const messages = ref([])
const route = useRoute()

const initialPrompt = route.query.prompt
if (initialPrompt) {
  handlePrompt(initialPrompt)
}

function handlePrompt(promptText) {
  messages.value.push({ sender: 'user', text: promptText })

  setTimeout(() => {
    messages.value.push({ sender: 'bot', text: `Ответ на: ${promptText}` })
  }, 1000)
}
</script>

<style scoped>
.chat-wrapper {
  display: flex;
  flex-direction: column;
  height: 90vh;
}

.chat-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 18px;
  width: 90%;
  max-width: 1130px;
  margin: 0 auto;
}

.chat-messages::-webkit-scrollbar {
  width: 8px;
  height: 8px;
  background: transparent;
}

.chat-messages::-webkit-scrollbar-track {
  background: transparent;
}

.chat-messages::-webkit-scrollbar-thumb {
  background-color: rgba(255, 255, 255, 0.32);
  border-radius: 4px;
}

.chat-messages::placeholder {
  color: rgb(168, 169, 175);
  font-weight: 500;
  font-size: 16px;
  line-height: 120%;
}

.message {
  font-size: 12px;
  background-color: rgba(255, 255, 255, 0.2);
  max-width: 90%;
  word-wrap: break-word;
  word-break: break-word;
  white-space: pre-wrap;
  text-align: left;
}

.user {
  border-radius: 60px 12px 60px 60px;
  padding: 24px 48px;
  align-self: flex-end;
}

.bot {
  border-radius: 12px 60px 60px 60px;
  padding: 24px 48px;
  align-self: flex-start;
}
</style>
