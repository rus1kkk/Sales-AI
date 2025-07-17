<template>
  <div class="photo">
    <div class="photo-wrapper" :class="{ 'is-loading': isSaving }">
      <img
        :src="previewUrl || photoUrl"
        class="user-pic"
        alt="User Profile Photo"
        @error="handleImageError"
      />
      <div v-if="isSaving" class="loading-spinner"></div>
    </div>
    <input
      type="file"
      ref="fileInput"
      accept="image/*"
      style="display: none"
      @change="handleFileChange"
    />
    <CustomButton
      type="text"
      label="Изменить фото"
      @click="triggerFileInput"
      :disabled="isSaving"
    />
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'

export default {
  name: 'UserPhoto',
  components: { CustomButton },
  props: {
    photoUrl: {
      type: String,
      default: '',
    },
    isSaving: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      previewUrl: null,
    }
  },
  methods: {
    triggerFileInput() {
      this.$refs.fileInput.click()
    },
    handleFileChange(event) {
      const file = event.target.files[0]
      if (file) {
        if (!file.type.match('image.*')) {
          alert('Пожалуйста, выберите изображение')
          return
        }
        if (file.size > 5 * 1024 * 1024) {
          alert('Размер файла не должен превышать 5MB')
          return
        }

        const reader = new FileReader()
        reader.onload = (e) => {
          this.previewUrl = e.target.result
          this.$emit('photo-changed', {
            file,
            url: e.target.result,
          })
        }
        reader.onerror = () => {
          alert('Ошибка при чтении файла')
          this.resetPhoto()
        }
        reader.readAsDataURL(file)
      }
    },
    handleImageError() {
      this.previewUrl = null
    },
    resetPhoto() {
      this.previewUrl = null
      this.$refs.fileInput.value = ''
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.photo {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}
.photo-wrapper {
  position: relative;
  width: 100%;
  max-width: 250px;
  max-height: 250px;
}
.user-pic {
  max-width: 250px;
  width: 100%;
  height: 100%;
  aspect-ratio: 1/1;
  border-radius: 10px;
  object-fit: cover;
}

.photo-wrapper.is-loading::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 2, 11, 0.6);
  z-index: 1;
  border-radius: 10px;
}

.loading-spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 56px;
  height: 56px;
  border: 5px solid rgba(255, 255, 255, 0.3); /* Полупрозрачная дуга (оставшаяся часть) */
  border-top: 5px solid var(--white-color); /* Основная видимая часть дуги */
  border-radius: 50%;
  animation: spin 1s linear infinite;
  z-index: 2;
}

@keyframes spin {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

.text-btn {
  background: none;
  border: none;
  color: var(--standart-color);
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
</style>
