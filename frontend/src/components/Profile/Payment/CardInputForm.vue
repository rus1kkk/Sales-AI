<template>
  <div class="card-input">
    <p class="form-title">Добавление карты</p>
    <div class="card-input-form">
      <p>Здесь будет форма для ввода данных карты</p>
      <div class="form-content">
        <p v-if="serverError" class="error-message">{{ serverError }}</p>
        <CustomButton type="text-blue" label="Сохранить" :disabled="isSaving" @click="handleSave" />
        <CustomButton type="text" label="Отмена" @click="handleCancel" />
      </div>
    </div>
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'

export default {
  name: 'CardInputForm',
  components: { CustomButton },
  data() {
    return {
      isSaving: false, // Флаг для предотвращения множественных кликов
      serverError: '',
    }
  },
  methods: {
    async handleSave() {
      if (this.isSaving) {
        return
      }
      this.isSaving = true
      try {
        // Заглушка с созданием карты
        const newCardTitle = '**' + Math.floor(1000 + Math.random() * 9000)
        // Ждём завершения обработки в ProfileView.vue
        await new Promise((resolve, reject) => {
          this.$emit('add-card', newCardTitle, { resolve, reject })
        })
      } catch (error) {
        this.serverError = error.message || 'Произошла ошибка при сохранении данных карты'
      } finally {
        this.isSaving = false
      }
    },
    handleCancel() {
      this.$emit('cancel')
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.card-input {
  max-width: 647px;
  min-width: 562px;
  width: 100%;
  display: inline-flex;
  padding-top: 24px;
  flex-direction: column;
  align-items: center;
  gap: 24px;
}

.card-input-form {
  display: flex;
  width: 100%;
  flex-direction: column;
  align-items: center;
  padding: 36px;
  gap: 24px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(7.5px);
}

.form-title {
  color: var(--white-color);
  text-align: center;
  font-family: Montserrat;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 28.8px */
}

.form-content {
  display: flex;
  flex-direction: column;
  gap: 16px;
  align-items: center;
}

.error-message {
  color: #ff9999;
  text-align: center;
  font-family: Montserrat;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 19.2px */
}
</style>
