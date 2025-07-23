<template>
  <div class="chat-wrapper">
    <h1 class="chat-name">{{ chatName }}</h1>

    <div class="chat-container" ref="chatContainer">
      <ChatMessages
        :messages="messages"
        :userAvatarUrl="userAvatarUrl"
        :modelAvatarUrl="modelAvatarUrl"
      />
    </div>

    <InputPrompt :onSubmit="handlePromptSubmit" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import ChatMessages from '../Chat/ChatMessage.vue'
import InputPrompt from '../Generate/InputPrompt.vue'

// --- РЕАКТИВНЫЕ ПЕРЕМЕННЫЕ ---

const messages = ref([]) // История сообщений
const chatName = ref('Новый чат')

const route = useRoute()
const chatId = ref(route.params.chatId ? Number(route.params.chatId) : null)

//! Пока жестко заданный текущий пользователь (заменить на авторизацию)

const currentUserId = 9

//! Статичные аватарки

const userAvatarUrl = '/ChatPhoto/user_avatar.png'
const modelAvatarUrl = '/ChatPhoto/model_avatar.png'

// --- ФУНКЦИЯ ЗАГРУЗКИ СООБЩЕНИЙ С СЕРВЕРА ---
async function fetchMessages() {
  if (!chatId.value) return
  try {
    const res = await axios.get(`/api/messages/${chatId.value}`)
    messages.value = res.data.map((m) => ({
      sender: m.message_type === 'user' ? 'user' : m.message_type === 'ai' ? 'model' : 'system',
      text: m.message_text,
      id: m.id,
    }))
  } catch (error) {
    console.error('Ошибка загрузки сообщений:', error)
  }
}

// --- ФУНКЦИЯ ЗАГРУЗКИ ИМЕНИ ЧАТА ---
async function fetchChatName() {
  if (!chatId.value) return
  try {
    const res = await axios.get(`/api/chats/${chatId.value}`)
    chatName.value = res.data.chat_name || 'Без имени'
  } catch (e) {
    console.error('Ошибка загрузки имени чата:', e)
  }
}

// --- ФУНКЦИЯ ОТПРАВКИ СООБЩЕНИЯ НА БЭКЕНД ---
async function sendMessageToBackend(messageText) {
  if (!chatId.value) {
    console.warn('chatId не задан')
    return
  }

  try {
    await axios.post('/api/messages/with-ai', {
      id_chat: chatId.value,
      id_user: currentUserId,
      message_text: messageText,
    })
  } catch (error) {
    console.error('Ошибка при отправке сообщения на backend:', error)
  }
}

// --- ОБРАБОТЧИК ОТПРАВКИ СООБЩЕНИЯ ИЗ InputPrompt ---
async function handlePromptSubmit(messageText) {
  // Добавляем временное сообщение с отрицательным ID
  const tempId = Date.now() * -1
  messages.value.push({ sender: 'user', text: messageText, id: tempId })

  await sendMessageToBackend(messageText)
}

// --- ИНИЦИАЛИЗАЦИЯ ПРИ ЗАГРУЗКЕ КОМПОНЕНТА ---
onMounted(async () => {
  if (!chatId.value) return

  fetchChatName()
  await fetchMessages()

  window.Echo.channel(`chat.${chatId.value}`).listen('MessageSent', (e) => {
    const m = e.message

    const newMsg = {
      sender: m.message_type === 'user' ? 'user' : m.message_type === 'ai' ? 'model' : 'system',
      text: m.message_text,
      id: m.id,
    }

    messages.value.push(newMsg)
  })
})
</script>

<style scoped>
@import url('../../assets/styles/Chat/ChatBlock.css');
</style>
