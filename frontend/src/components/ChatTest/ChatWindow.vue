<template>
  <div class="flex flex-col h-screen p-4 bg-white">
    <div class="flex-1 overflow-y-auto space-y-1">
      <ChatMessage
        v-for="msg in messages"
        :key="msg.id"
        :message="msg"
        :current-user-id="currentUserId"
      />
    </div>
    <form @submit.prevent="sendMessage" class="mt-2 flex gap-2">
      <input
        v-model="newMessage"
        placeholder="Введите сообщение..."
        class="flex-1 border p-2 rounded-xl"
      />
      <button class="bg-blue-500 text-white px-4 rounded-xl">Отправить</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ChatMessage from './ChatMessage.vue'
import { useRoute } from 'vue-router'

const messages = ref([])
const newMessage = ref('')

const route = useRoute()
const currentUserId = 9 // заменить на авторизованного
const chatId = Number(route.params.id)

const fetchMessages = async () => {
  const res = await axios.get(`/api/messages/${chatId}`)
  messages.value = res.data
}

const sendMessage = async () => {
  if (!newMessage.value.trim()) return

  await axios.post('/api/messages', {
    id_chat: chatId,
    id_user: currentUserId,
    message_text: newMessage.value,
  })

  newMessage.value = ''
}

onMounted(() => {
  fetchMessages()

  console.log('Подписываюсь на канал chat.' + chatId)

  window.Echo.channel(`chat.${chatId}`).listen('MessageSent', (e) => {
    console.log('🔥 Пришло событие MessageSent:', e)
    messages.value.push(e.message)
  })
})
</script>

<style scoped></style>
