<template>
  <section class="input-prompt-section">
    <div class="input-prompt-block fade-up" style="animation-delay: 0.4s">
      <div class="input-prompt-block-text">
        <textarea
          ref="textarea"
          v-model="prompt"
          placeholder="Введите ваш запрос"
          rows="1"
          wrap="soft"
          @input="autoResize"
          @keydown="handleKey"
        />
        <div class="name-model-block">Название модели</div>
      </div>
      <button @click="submitPrompt">
        <img :src="promptSendingIcon" alt="Send" />
      </button>
    </div>

    <div class="input-prompt-block-info fade-up" style="animation-delay: 0.6s">
      <h3>
        <span>Sales AI</span> может допускать ошибки. Проверьте и отредактируйте презентацию или
        купите подписку.
      </h3>
      <a href="#">См. подписки.</a>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'
import { useRouter } from 'vue-router'
import promptSendingIcon from '@/assets/images/prompt_sending_icon.svg'

const props = defineProps({
  onSubmit: Function,
})

const prompt = ref('')
const textarea = ref(null)
const router = useRouter()

function submitPrompt() {
  const trimmed = prompt.value.trim()
  if (!trimmed) return

  if (props.onSubmit) {
    props.onSubmit(trimmed)
  } else {
    router.push({ name: 'ChatPage', query: { prompt: trimmed } })
  }

  prompt.value = ''
  nextTick(autoResize)
}

function handleKey(e) {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault()
    submitPrompt()
  }
}

function autoResize() {
  if (!textarea.value) return

  textarea.value.rows = 1
  const lineHeight = parseFloat(getComputedStyle(textarea.value).lineHeight) || 24
  const lines = Math.min(Math.ceil(textarea.value.scrollHeight / lineHeight), 15)
  textarea.value.rows = lines
}

onMounted(() => {
  autoResize()
  const observer = new ResizeObserver(autoResize)
  if (textarea.value) observer.observe(textarea.value)
  onUnmounted(() => observer.disconnect())
})
</script>

<style scoped>
@import url('../../assets/styles/Generate/InputPrompt.css');
</style>
