<template>
  <div class="chat-wrapper">
    <h1 class="chat-name">{{ chatName }}</h1>

    <div class="chat-container">
      <section class="chat-messages" ref="chatMessagesRef">
        <div v-for="(msg, index) in messages" :key="index" :class="['message-wrapper', msg.sender]">
          <img
            :src="msg.sender === 'user' ? userAvatarUrl : botAvatarUrl"
            alt="Avatar"
            class="avatar"
          />
          <div class="message" :class="msg.sender">
            <p>{{ msg.text }}</p>
          </div>
        </div>
      </section>
    </div>

    <InputPrompt :onSubmit="handlePrompt" />
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRoute } from 'vue-router'
import InputPrompt from '@/components/Generate/InputPrompt.vue'

const messages = ref([])
const chatName = ref('Название чата')
const route = useRoute()
const initialPrompt = route.query.prompt

const userAvatarUrl = './ChatPhoto/user_avatar.png'
const botAvatarUrl = './ChatPhoto/bot_avatar.png'

const chatMessagesRef = ref(null)

onMounted(() => {
  if (initialPrompt) {
    handlePrompt(initialPrompt)
  }
})

function handlePrompt(promptText) {
  addMessage('user', promptText)

  if (messages.value.length === 1) {
    updateChatName(promptText)
  }

  simulateBotResponse(promptText)
}

function addMessage(sender, text) {
  messages.value.push({ sender, text })
  scrollToBottom()
}

function simulateBotResponse(promptText) {
  setTimeout(() => {
    addMessage('bot', `Ответ на: ${promptText}`)
  }, 1000)
}

function updateChatName(promptText) {
  const maxLength = 30
  const truncated = promptText.slice(0, maxLength)
  chatName.value = `Чат: ${truncated}${promptText.length > maxLength ? '...' : ''}`
}

function scrollToBottom() {
  nextTick(() => {
    const container = chatMessagesRef.value
    if (container) {
      container.scrollTop = container.scrollHeight
    }
  })
}
</script>

<style scoped>
.chat-name {
  font-size: 32px;
  font-weight: 500;
  line-height: 120%;
  text-align: center;
  color: var(--white-color);
  text-align: center;
  margin-bottom: 36px;
  margin-top: 36px;
  animation: fadeIn 0.5s ease-in forwards;
}
.chat-wrapper {
  display: flex;
  flex-direction: column;
  height: 90vh;
}

.chat-container {
  flex: 1;
  display: flex;
  align-items: center;
  flex-direction: column;
  overflow: hidden;
}

.chat-messages {
  flex: 1;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  width: 90%;
  max-width: 1130px;
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

.message-wrapper {
  display: flex;
  align-items: flex-start;
  gap: 24px;
}
.message-wrapper.user {
  flex-direction: row-reverse;
  justify-content: flex-end;
}
.message-wrapper.bot {
  flex-direction: row;
  justify-content: flex-start;
}

.message {
  display: flex;
  align-items: center;
  font-size: 12px;
  background-color: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(20px);
  max-width: 90%;
  word-break: break-word;
  white-space: pre-wrap;
  text-align: left;
  opacity: 0;
  animation: fadeIn 0.5s ease-in forwards;
  box-sizing: border-box;
  padding: 24px 48px;
  margin-bottom: 18px;
  max-width: 800px;
}

.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.user {
  border-radius: 60px 12px 60px 60px;
  align-self: flex-end;
}
.bot {
  border-radius: 12px 60px 60px 60px;
  align-self: flex-start;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
