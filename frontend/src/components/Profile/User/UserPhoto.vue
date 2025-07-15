<template>
  <div class="photo">
    <div class="photo-wrapper" :class="{ 'is-loading': isSaving }">
      <img
        :src="previewUrl || photoUrl"
        class="user-pic"
        alt="User Profile Photo"
        @error="handleImageError"
      />
    </div>
    <input
      type="file"
      ref="fileInput"
      accept="image/*"
      style="display: none"
      @change="handleFileChange"
    />
    <CustomButton type="text" label="Изменить фото" @click="triggerFileInput" />
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
  },
  data() {
    return {
      previewUrl: null,
      isSaving: false,
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

        this.isSaving = true
        const reader = new FileReader()
        reader.onload = (e) => {
          this.previewUrl = e.target.result
          this.$emit('photo-changed', {
            file,
            url: e.target.result,
          })
        }
        reader.readAsDataURL(file)
      }
    },
    handleImageError() {
      this.previewUrl = null
      this.isSaving = false
    },
    resetPhoto() {
      this.previewUrl = null
      this.isSaving = false
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
}
.user-pic {
  max-width: 250px;
  width: 100%;
  height: 100%;
  aspect-ratio: 1/1;
  border-radius: 10px;
  object-fit: cover;
}

.text-btn {
  background: none;
  border: none;
  color:var(--standart-color);
  font-family: Montserrat;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
</style>
