<template>
  <section class="input-prompt-section">
    <h1 class="fade-up" style="animation-delay: 0.2s">Какая задача будет сегодня?</h1>
    <div class="input-prompt-block fade-up" style="animation-delay: 0.4s">
      <div class="input-prompt-block-text">
        <textarea
          ref="textarea"
          id="prompt-input"
          placeholder="Введите ваш запрос"
          rows="1"
          wrap="soft"
          @input="autoResize"
        ></textarea>
        <div class="name-model-block">Название модели</div>
      </div>
      <button>
        <img :src="promptSendingIcon" alt="./img/Pr" />
      </button>
    </div>
    <div class="input-prompt-block-info fade-up" style="animation-delay: 0.6s">
      <h3>
        <span>Sales AI</span> может допускать ошибки. Проверьте и отредактируйте презентацию или
        купите подписку.
      </h3>
      <a href="#"> См. подписки.</a>
    </div>
  </section>
</template>

<script setup>
import promptSendingIcon from '@/assets/images/prompt_sending_icon.svg'

import { ref, onMounted, onUnmounted } from 'vue'

const textarea = ref(null)

const autoResize = () => {
  if (textarea.value) {
    textarea.value.rows = 1
    const lineHeight = parseFloat(getComputedStyle(textarea.value).lineHeight) || 24
    const lines = Math.min(Math.ceil(textarea.value.scrollHeight / lineHeight), 15)
    textarea.value.rows = lines
  }
}

onMounted(() => {
  autoResize()

  const observer = new ResizeObserver(() => {
    autoResize()
  })

  if (textarea.value) {
    observer.observe(textarea.value)
  }

  onUnmounted(() => {
    observer.disconnect()
  })
})
</script>

<style scoped>
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

.fade-up {
  opacity: 0;
  animation: fadeUp 0.8s ease-out forwards;
}

.input-prompt-block > button {
  all: unset;
  cursor: pointer;
}

.input-prompt-block > button > img {
  height: auto;
}

.input-prompt-block-text {
  display: flex;
  width: 100%;
  flex-direction: column;
  gap: 24px;
}

.input-prompt-section > h1 {
  font-size: 38px;
  font-weight: 400;
  line-height: 120%;
  text-align: center;
  color: var(--white-color);
}

.input-prompt-section {
  position: absolute;
  z-index: 3;
  display: flex;
  flex-direction: column;
  gap: 24px;
  justify-content: center;
  align-items: center;
  height: 90vh;
  width: 100vw;
}

.name-model-block {
  display: inline-block;
  align-self: flex-start;
  color: #1a1c2c;
  background-color: rgba(255, 255, 255, 0.32);
  padding: 8px 16px 8px 16px;
  border-radius: 60px;
  font-size: 14px;
  font-weight: 500;
  line-height: 120%;
}

.input-prompt-block {
  background-color: rgba(255, 255, 255, 0.2);
  padding: 36px;
  display: flex;
  gap: 34px;
  border-radius: 60px;
  width: 60vw;
  max-width: 1130px;
  backdrop-filter: blur(20px);
}

textarea {
  all: unset;
  padding-right: 10px;
  width: 100%;
  resize: none;
  overflow: auto;
  white-space: pre-wrap;
  word-wrap: break-word;
  line-height: 1.5;
}

textarea::-webkit-scrollbar {
  width: 8px;
  height: 8px;
  background: transparent;
}

textarea::-webkit-scrollbar-track {
  background: transparent;
}

textarea::-webkit-scrollbar-thumb {
  background-color: rgba(255, 255, 255, 0.32);
  border-radius: 4px;
}

textarea::placeholder {
  color: rgb(168, 169, 175);
  font-weight: 500;
  font-size: 16px;
  line-height: 120%;
}

input-prompt-block > img {
  position: absolute;
}

.input-prompt-block-info {
  text-align: center;
  padding-top: 24px;
  border-top: solid 0.5px rgba(255, 255, 255, 0.38);
  width: 55vw;
  max-width: 922px;
}

.input-prompt-block-info > a {
  all: unset;
  cursor: pointer;
  text-decoration: underline;
}

.input-prompt-block-info h3,
.input-prompt-block-info a {
  font-size: 12px;
  font-weight: 300;
  line-height: 150%;
  font-family: Montserrat;
  letter-spacing: 0%;
}

.input-prompt-block-info h3 span {
  color: var(--actient-color);
}
</style>
