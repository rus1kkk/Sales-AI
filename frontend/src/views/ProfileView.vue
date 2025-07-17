<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard
        class="fade-up"
        style="animation-delay: 0.2s"
        ref="profileCard"
        :userInfo="userInfo"
        :isSaving="isSaving"
        @open-modal="openModal"
        @update-user-field="updateUserField"
        @photo-changed="handlePhotoChange"
        @logout="logout"
      />
      <PurchaseHistory class="fade-up" style="animation-delay: 0.3s" :purchases="purchases" />
    </div>
    <transition name="modal-fade">
      <ModalForm
        v-if="modal.isOpen"
        :isOpen="modal.isOpen"
        :title="modal.title"
        :inputs="modal.inputs"
        :field="modal.field"
        :onClose="closeModal"
        :onSubmit="handleSubmit"
      />
    </transition>
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/User/ProfileCard.vue'
import PurchaseHistory from '@/components/Profile/History/PurchaseHistory.vue'
import ModalForm from '@/components/Profile/Modals/ModalForm.vue'
import userPhoto from '@/assets/images/user-photo.png'

export default {
  name: 'ProfileView',
  components: { ProfileCard, PurchaseHistory, ModalForm },
  data() {
    return {
      userInfo: {
        name: 'Денис',
        phone: '+79783405384',
        email: 'lol.ogo@mail.ru',
        plan: 'PRO',
        validUntil: '23.09.2025',
        photoUrl: userPhoto,
      },
      isSaving: false, // Состояние сохранения изображения
      isAddingCard: false, // Состояние показа формы добавления карты
      pendingRemovals: [], // Очередь для удаления карт (хранит объекты { card, index })
      mockServerError: false, // true - для имитации ошибки
      purchases: [
        {
          id: 1,
          date: '12.04.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.05.2025',
        },
        {
          id: 2,
          date: '12.03.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.04.2025',
        },
        {
          id: 3,
          date: '12.02.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.03.2025',
        },
        {
          id: 4,
          date: '12.12.2024',
          title: 'Тариф “Pro”',
          quantity: '2',
          expiryDate: '12.02.2025',
        },
      ],
      modal: {
        isOpen: false,
        title: '',
        inputs: [],
        field: '',
      },
    }
  },
  computed: {
    modalOpen() {
      return this.modal.isOpen
    },
    modalData() {
      return {
        title: this.modal.title,
        inputs: this.modal.inputs,
        field: this.modal.field,
      }
    },
  },
  methods: {
    openModal({ field, title, inputs }) {
      this.modal = {
        isOpen: true,
        title,
        inputs,
        field,
      }
    },
    closeModal() {
      this.modal.isOpen = false
    },
    async handleSubmit(values) {
      const value = this.modal.field === 'password' ? values[0] : values[0]
      await this.updateUserField(this.modal.field, value)
      this.closeModal()
    },
    async updateUserField(field, value) {
      // обновление userInfo
      await this.saveUserData(field, value)
      if (field !== 'password') {
        this.userInfo[field] = value
      }
    },
    async handlePhotoChange({ file, url }) {
      //Cмена фотографии
      console.log('Выбранное фото:', { file, url })
      this.isSaving = true // Устанавливаем isSaving перед серверной обработкой
      try {
        await this.saveUserData('photoUrl', url)
        this.userInfo.photoUrl = url
      } catch (error) {
        alert('Ошибка загрузки фотографии')
        if (this.$refs.profileCard && this.$refs.profileCard.$refs.userPhoto) {
          this.$refs.profileCard.$refs.userPhoto.resetPhoto()
        } else {
          console.error('Фото не найдено')
        }
        throw error
      } finally {
        this.isSaving = false // Сбрасываем isSaving после завершения
      }
    },
    async saveUserData(field, value) {
      //Сохранение данных профиля
      //метод заглушка
      console.log(`Сохранение поля ${field} со значением:`, value)
      if (this.mockServerError) {
        await new Promise((resolve) => setTimeout(resolve, 2000))
        throw new Error('Произошла ошибка при сохранении данных')
      }
      // Имитация серверной задержки
      await new Promise((resolve) => setTimeout(resolve, 2000))
    },
    async logout() {
      //выход из профиля
      //метод заглушка
      try {
        if (this.mockServerError) {
          await new Promise((resolve) => setTimeout(resolve, 2000))
          throw new Error('Произошла ошибка при выходе из профиля')
        }
        this.$router.push('/')
      } catch (error) {
        alert(error.message)
      }
    },
  },
}
</script>

<style scoped>
@import '../assets/styles/main.css';

.user-profile {
  max-width: 1483px;
  width: 100%;
  margin: 82px auto 90px;
  display: flex;
  box-sizing: border-box;
  padding: 0 80px;
  color: var(--white-color);
  gap: 24px;
}
.top-block {
  display: grid;
  grid-template-columns: minmax(562px, 647px) minmax(518px, 652px);
  grid-template-rows: auto auto;
  gap: 24px;
  width: 100%;
}

.fade-up {
  opacity: 0;
  transform: translateY(-30px);
  animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.4s ease;
}
.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

@media (max-width: 1280px) {
  .top-block {
    grid-template-columns: minmax(562px, 647px);
    grid-template-rows: auto;
    gap: 24px;
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .top-block {
    grid-template-columns: minmax(80vw, 95vw);
    grid-template-rows: auto;
    gap: 24px;
    width: 100%;
    justify-content: center;
  }
  .user-profile {
    padding: 0px 60.5px;
  }
}
@media (max-width: 600px) {
  .user-profile {
    padding: 0px 32px;
  }
}
@media (max-width: 480px) {
  .user-profile {
    padding: 0px 12px;
  }
}

@media (max-width: 360px) {
  .user-profile {
    padding: 0px 5.5px;
  }
}
</style>
