<template>
  <div class="modal-backdrop" @click.self="close">
    <div class="modal-window">
      <button class="close-button" @click="close">×</button>
      <h2>Оплата провалена!</h2>
      <p>Попробуйте еще раз или обратитесь в поддержку платежной системы.</p>
      <button class="action-button" @click="close">Закрыть</button>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits(['close'])
function close() {
  emit('close')
}
</script>

<style scoped>
.modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}
.modal-window {
  background: rgba(208, 72, 72, 0.9);
  color: white;
  padding: 2rem;
  border-radius: 1.5rem;
  text-align: center;
  max-width: 480px;
  width: 90%;
  position: relative;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
}
.modal-window h2 {
  margin: 0 0 0.5rem;
}
.modal-window p {
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
}
.action-button {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  border: none;
  padding: 0.5rem 1.2rem;
  border-radius: 0.5rem;
  cursor: pointer;
  font-weight: bold;
}
.action-button:hover {
  background: rgba(255, 255, 255, 0.25);
}
.close-button {
  position: absolute;
  right: 1rem;
  top: 1rem;
  background: transparent;
  border: none;
  font-size: 1.5rem;
  color: white;
  cursor: pointer;
}
</style>
