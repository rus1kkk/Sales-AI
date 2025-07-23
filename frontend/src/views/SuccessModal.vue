<template>
  <div class="modal-backdrop" @click.self="close">
    <div class="modal-window">
      <h2>Спасибо за оплату!</h2>
      <p>Мы получили ваш платёж. Подтверждение отправлено на почту.</p>
      <button @click="close">Закрыть</button>
    </div>
  </div>
</template>

<script setup>
defineProps(['visible'])
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
  z-index: 50;
}
.modal-window {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  text-align: center;
  max-width: 400px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
.modal-window button {
  margin-top: 1rem;
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1.5rem;
  border-radius: 0.5rem;
  cursor: pointer;
}
</style>
