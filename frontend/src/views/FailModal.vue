<template>
  <div class="modal-overlay">
    <div class="modal fail-modal">
      <button class="close-btn" @click="$emit('close')">×</button>
      <h2 class="modal-title">Оплата провалена!</h2>
      <p class="modal-text">
        Попробуйте еще раз или обратитесь в поддержку платежной системы.
      </p>
      <button class="close-link" @click="$emit('close')">Закрыть</button>
    </div>
  </div>
</template>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal {
  background: rgba(255, 0, 0, 0.4); /* Красный фон для ошибки */
  backdrop-filter: blur(20px);
  border-radius: 20px;
  padding: 24px 32px;
  max-width: 450px;
  width: 100%;
  text-align: center;
  color: #fff;
  position: relative;
}

.modal-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 8px;
}

.modal-text {
  font-size: 14px;
  margin-bottom: 16px;
}

.close-btn {
  position: absolute;
  top: 12px;
  right: 12px;
  background: none;
  border: none;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
}

.close-link {
  background: none;
  border: none;
  color: #fff;
  text-decoration: underline;
  font-weight: bold;
  cursor: pointer;
  font-size: 14px;
}
</style>
