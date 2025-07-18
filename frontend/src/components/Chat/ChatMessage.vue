<template>
  <section class="chat-messages" ref="chatMessagesRef">
    <div v-for="(msg, index) in messages" :key="index" :class="['message-wrapper', msg.sender]">
      <img
        :src="msg.sender === 'user' ? userAvatarUrl : modelAvatarUrl"
        alt="Avatar"
        class="avatar"
      />
      <div class="message" :class="msg.sender">
        <p>{{ msg.text }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, nextTick, watch } from 'vue'

const props = defineProps({
  messages: Array,
  userAvatarUrl: String,
  modelAvatarUrl: String,
})

const chatMessagesRef = ref(null)

watch(
  () => props.messages,
  () => {
    nextTick(() => {
      const container = chatMessagesRef.value
      if (!container) return
      container.scrollTop = container.scrollHeight
    })
  },
  { deep: true },
)
</script>

<style scoped>
.chat-messages {
  flex: 1;
  overflow-y: auto;
  scroll-behavior: smooth;
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
.message-wrapper.model {
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
.model {
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
