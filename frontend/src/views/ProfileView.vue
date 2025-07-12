<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard
        ref="profileCard"
        :userInfo="userInfo"
        @open-modal="openModal"
        @update-user-field="updateUserField"
      />
      <PurchaseHistory />
      <PaymentMethod />
    </div>
    <ModalForm
      :isOpen="modal.isOpen"
      :title="modal.title"
      :inputs="modal.inputs"
      :field="modal.field"
      :onClose="closeModal"
      :onSubmit="handleSubmit"
    />
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/User/ProfileCard.vue'
import PurchaseHistory from '@/components/Profile/History/PurchaseHistory.vue'
import PaymentMethod from '@/components/Profile/Payment/PaymentMethod.vue'
import ModalForm from '@/components/Profile/Modals/ModalForm.vue'

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
      },
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
    handleSubmit(values) {
      if (this.modal.field === 'password') {
        const newPassword = values[0]
        this.updateUserField(this.modal.field, newPassword)
      } else {
        const newValue = values[0]
        this.updateUserField(this.modal.field, newValue)
      }
      this.closeModal()
    },
    updateUserField(field, value) {
      console.log('updateUserField called with:', { field, value })
      if (field !== 'password') {
        this.userInfo[field] = value
      }
      this.saveUserData(field, value)
    },
    async saveUserData(field, value) {
      try {
        console.log(`Сохранение поля ${field} со значением:`, value)
      } catch (error) {
        console.error('Ошибка при сохранении данных:', error)
        this.$toast?.error('Ошибка при сохранении данных')
      }
    },
  },
}
</script>

<style scoped>
.user-profile {
  max-width: 1483px;
  width: 100%;
  margin: 82px auto 90px;
  display: flex;
  box-sizing: border-box;
  padding: 0 80px;
  font-family: Montserrat;
  color: #fff;
  gap: 24px;
}
.top-block {
  display: grid;
  grid-template-columns: minmax(562px, 647px) minmax(518px, 652px);
  grid-template-rows: auto auto;
  gap: 24px;
  width: 100%;
}
</style>
