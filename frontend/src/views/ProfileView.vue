<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard
        class="fade-up"
        style="animation-delay: 0.2s"
        ref="profileCard"
        :userInfo="userInfo"
        @open-modal="openModal"
        @update-user-field="updateUserField"
        @photo-changed="handlePhotoChange"
        @logout="logout"
      />
      <PurchaseHistory class="fade-up" style="animation-delay: 0.3s" :purchases="purchases" />
      <PaymentMethod
        class="fade-up"
        style="animation-delay: 0.4s"
        :cards="cards"
        :inputCard="inputCard"
        :isAddingCard="isAddingCard"
        @add-card="addCard"
        @remove-card="removeCard"
        @start-adding-card="startAddingCard"
        @cancel-adding-card="cancelAddingCard"
      />
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
import PaymentMethod from '@/components/Profile/Payment/PaymentMethod.vue'
import ModalForm from '@/components/Profile/Modals/ModalForm.vue'
import tbankIcon from '@/assets/images/tbank-icon.png'
import sberIcon from '@/assets/images/sber-icon.png'
import alphaIcon from '@/assets/images/alpha-icon.png'
import mirIcon from '@/assets/images/mir-icon.png'
import userPhoto from '@/assets/images/user-photo.png'

export default {
  name: 'ProfileView',
  components: { ProfileCard, PurchaseHistory, PaymentMethod, ModalForm },
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
      isAddingCard: false, // Состояние показа формы добавления карты
      pendingRemovals: [], // Очередь для удаления карт (хранит объекты { card, index })
      mockServerError: true, // true - для имитации ошибки
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
      cards: [
        { title: '**5448', icon: tbankIcon },
        { title: '**4578', icon: sberIcon },
        { title: '**1770', icon: alphaIcon },
      ],
      inputCard: { title: 'Привязать карту', icon: mirIcon },
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
      await this.saveUserData(field, value)
      if (field !== 'password') {
        this.userInfo[field] = value
      }
    },
    async handlePhotoChange({ file, url }) {
      console.log('Выбранное фото:', { file, url })
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
      }
    },
    async saveUserData(field, value) {
      //метод заглушка
      console.log(`Сохранение поля ${field} со значением:`, value)
      if (this.mockServerError) {
        await new Promise((resolve) => setTimeout(resolve, 2000))
        throw new Error('Произошла ошибка при сохранении данных')
      }
    },
    startAddingCard() {
      this.isAddingCard = true
    },
    cancelAddingCard() {
      this.isAddingCard = false
    },
    async addCard(cardTitle, { resolve, reject } = {}) {
      const newCard = { title: cardTitle, icon: this.inputCard.icon }
      this.cards = [...this.cards, newCard]
      try {
        await this.saveCardData(newCard)
        this.isAddingCard = false
        resolve && resolve()
      } catch (error) {
        this.cards = this.cards.filter((card) => card.title !== cardTitle)
        reject && reject(error)
      }
    },
    removeCard(cardTitle) {
      const index = this.cards.findIndex((card) => card.title === cardTitle)
      if (index === -1 || this.pendingRemovals.some((c) => c.card.title === cardTitle)) {
        return
      }
      const cardToRemove = this.cards[index]
      this.pendingRemovals.push({ card: cardToRemove, index })
      this.cards = this.cards.filter(
        (card) => !this.pendingRemovals.some((c) => c.card.title === card.title),
      )
      this.processRemovalQueue()
    },
    async processRemovalQueue() {
      if (!this.pendingRemovals.length) {
        return
      }
      const removals = this.pendingRemovals.map(({ card }) => ({
        card,
        promise: this.saveCardData(card, true),
      }))
      const pendingRemovalsCopy = [...this.pendingRemovals]
      this.pendingRemovals = []
      try {
        const results = await Promise.allSettled(removals.map((r) => r.promise))
        results.forEach((result, index) => {
          const { card, index: originalIndex } = pendingRemovalsCopy[index]
          if (result.status !== 'fulfilled') {
            if (this.cards.every((c) => c.title !== card.title)) {
              this.cards.splice(originalIndex, 0, card)
            }
            alert(result.reason?.message || `Ошибка при удалении карты ${card.title}`)
          }
        })
      } catch (error) {
        console.error('Ошибка:', error)
      }
    },
    async saveCardData(card, isRemoval = false) {
      //метод заглушка
      console.log(`${isRemoval ? 'Удаление' : 'Добавление'} карты ${card.title}`)
      if (this.mockServerError) {
        await new Promise((resolve) => setTimeout(resolve, 2000))
        if (isRemoval) {
          throw new Error('Произошла ошибка при удалении карты')
        } else throw new Error('Произошла ошибка при добавлении карты')
      }
    },
    async logout() {
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

/* Анимация для модального окна */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.4s ease;
}
.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
</style>
