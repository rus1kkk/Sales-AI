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

    <InputPrompt :onSubmit="handlePrompt" />
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import ChatMessages from '../Chat/ChatMessage.vue'
import InputPrompt from '../Generate/InputPrompt.vue'

const messages = ref([]) // история сообщений
const chatName = ref('Новый чат')
const answers = ref([]) // ответы пользователя
const route = useRoute()

// пока статические аватарки
const userAvatarUrl = '/ChatPhoto/user_avatar.png'
const modelAvatarUrl = '/ChatPhoto/model_avatar.png'

const router = useRouter()

const chatId = ref(route.params.chatId || null)
const initialPrompt = ref(route.query.prompt || null)

const SpecificationsDocument = ref(null) // id ТЗ
const sectionQueue = ref([]) // секции брифинга
const currentSectionIndex = ref(0)
const currentQuestionIndex = ref(0)

onMounted(async () => {
  if (!chatId.value && initialPrompt.value) {
    await handlePrompt(initialPrompt.value)
  } else if (chatId.value) {
    // тут логика для загрузки чата из истории
    addMessage('model', 'Загрузка сохранённого чата...')
  }
})

onBeforeUnmount(() => {
  window.removeEventListener('beforeunload', sendChatDataToServer)
})

async function handlePrompt(promptText) {
  addMessage('user', promptText)

  // заглушка для названия чата
  if (messages.value.length === 1) {
    chatName.value = `Чат: ${promptText.slice(0, 30)}${promptText.length > 30 ? '...' : ''}`
    await startChat(promptText)
    return
  }

  // текущая секция и вопрос из этой секции
  const section = sectionQueue.value[currentSectionIndex.value]
  const question = section?.questions[currentQuestionIndex.value]

  // добавление ответа
  if (question) {
    answers.value.push({
      sectionId: section.id,
      sectionTitle: section.title,
      questionId: question.id,
      questionText: question.text,
      answer: promptText,
      answer_formatted: null,
      initialPrompt: initialPrompt.value,
    })
  }

  await advanceToNextQuestion()
}

function addMessage(sender, text) {
  messages.value.push({ sender, text })
}

async function startChat() {
  // произвольные айдшники заглушки
  chatId.value = 'chat_' + Math.random().toString(36).substring(2, 10)
  SpecificationsDocument.value = 'doc_' + Math.random().toString(36).substring(2, 10)

  // url по айдишнику чата
  await router.replace({ name: 'ChatPage', params: { chatId: chatId.value }, query: {} })

  // статический список секций
  sectionQueue.value = [
    {
      id: 's1',
      title: 'Целевая аудитория',
      questions: [{ id: 'q1', text: 'Кто ваши клиенты?' }],
    },
    {
      id: 's2',
      title: 'Функциональность',
      questions: [{ id: 'q2', text: 'Какие функции важны в продукте?' }],
    },
  ]

  await modelSay(`Начнём брифинг! Первая секция: "${sectionQueue.value[0].title}"`)
  await modelSay(sectionQueue.value[0].questions[0].text)
}

async function advanceToNextQuestion() {
  const section = sectionQueue.value[currentSectionIndex.value]
  if (!section) return

  currentQuestionIndex.value++

  if (currentQuestionIndex.value >= section.questions.length) {
    currentSectionIndex.value++
    currentQuestionIndex.value = 0

    const nextSection = sectionQueue.value[currentSectionIndex.value]
    if (nextSection) await modelSay(`Следующая секция: "${nextSection.title}"`)
  }

  const nextQuestion = getCurrentQuestion()
  nextQuestion ? await modelSay(nextQuestion.text) : await finishBriefing()
}

function getCurrentQuestion() {
  return (
    sectionQueue.value[currentSectionIndex.value]?.questions[currentQuestionIndex.value] || null
  )
}

async function finishBriefing() {
  await modelSay(`Все вопросы завершены. ТЗ: ${JSON.stringify(answers.value)}`)
}

// для задержки
async function modelSay(text) {
  await new Promise((resolve) => setTimeout(resolve, 600))
  addMessage('model', text)
}

async function sendChatDataToServer() {
  const chatData = {
    chatId: chatId.value,
    chatName: chatName.value,
    messages: messages.value,
    answers: answers.value,
  }

  // отправка на сервер
  console.log(chatData)
}
</script>

<style scoped>
.chat-name {
  font-size: 32px;
  font-weight: 500;
  line-height: 120%;
  text-align: center;
  color: var(--white-color);
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
