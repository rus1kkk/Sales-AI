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
@import url('../../assets/styles/Chat/ChatMessage.css');
</style>
