<template>
  <div class="right-part">
    <div class="rate-container">
      <div class="rate">
        <p class="rate-title">Тариф:</p>
        <p class="rate-type">{{ userInfo.plan }}</p>
      </div>
      <p class="term">
        Действителен до: <span>{{ userInfo.validUntil }}</span>
      </p>
    </div>
    <div class="info-row fade-up" style="animation-delay: 0.5s">
      <p class="property">Имя</p>
      <p class="value">{{ userInfo.name }}</p>
      <CustomButton type="icon" @click="openModal('name')">
        <template #icon>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="19"
            viewBox="0 0 18 19"
            fill="none"
          >
            <path
              d="M13.3614 1.76204L16.7381 5.14024L17.3006 4.57676C17.5224 4.355 17.6982 4.09174 17.8182 3.802C17.9382 3.51226 18 3.20172 18 2.88811C18 2.5745 17.9382 2.26396 17.8182 1.97422C17.6982 1.68448 17.5224 1.42122 17.3006 1.19946C17.0789 0.977704 16.8157 0.801798 16.526 0.681784C16.2363 0.56177 15.9258 0.5 15.6122 0.5C14.979 0.5 14.3716 0.751604 13.9239 1.19946L13.3614 1.76204ZM15.1875 6.68757L11.8107 3.30937L1.0962 14.0263L0 18.5L4.47299 17.4045L15.1875 6.68757Z"
              fill="#A8A9AF"
            />
          </svg>
        </template>
      </CustomButton>
    </div>
    <div class="info-row fade-up" style="animation-delay: 0.6s">
      <p class="property">Номер</p>
      <p class="value">{{ userInfo.phone }}</p>
      <CustomButton type="icon" @click="openModal('phone')">
        <template #icon>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="19"
            viewBox="0 0 18 19"
            fill="none"
          >
            <path
              d="M13.3614 1.76204L16.7381 5.14024L17.3006 4.57676C17.5224 4.355 17.6982 4.09174 17.8182 3.802C17.9382 3.51226 18 3.20172 18 2.88811C18 2.5745 17.9382 2.26396 17.8182 1.97422C17.6982 1.68448 17.5224 1.42122 17.3006 1.19946C17.0789 0.977704 16.8157 0.801798 16.526 0.681784C16.2363 0.56177 15.9258 0.5 15.6122 0.5C14.979 0.5 14.3716 0.751604 13.9239 1.19946L13.3614 1.76204ZM15.1875 6.68757L11.8107 3.30937L1.0962 14.0263L0 18.5L4.47299 17.4045L15.1875 6.68757Z"
              fill="#A8A9AF"
            />
          </svg>
        </template>
      </CustomButton>
    </div>
    <div class="info-row fade-up" style="animation-delay: 0.7s">
      <p class="property">Почта:</p>
      <p class="value">{{ userInfo.email }}</p>
      <CustomButton type="icon" @click="openModal('email')">
        <template #icon>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="19"
            viewBox="0 0 18 19"
            fill="none"
          >
            <path
              d="M13.3614 1.76204L16.7381 5.14024L17.3006 4.57676C17.5224 4.355 17.6982 4.09174 17.8182 3.802C17.9382 3.51226 18 3.20172 18 2.88811C18 2.5745 17.9382 2.26396 17.8182 1.97422C17.6982 1.68448 17.5224 1.42122 17.3006 1.19946C17.0789 0.977704 16.8157 0.801798 16.526 0.681784C16.2363 0.56177 15.9258 0.5 15.6122 0.5C14.979 0.5 14.3716 0.751604 13.9239 1.19946L13.3614 1.76204ZM15.1875 6.68757L11.8107 3.30937L1.0962 14.0263L0 18.5L4.47299 17.4045L15.1875 6.68757Z"
              fill="#A8A9AF"
            />
          </svg>
        </template>
      </CustomButton>
    </div>
    <div class="info-row fade-up" style="animation-delay: 0.8s">
      <p class="property">Пароль:</p>
      <p class="value">********</p>
      <CustomButton type="icon" @click="openModal('password')">
        <template #icon>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="19"
            viewBox="0 0 18 19"
            fill="none"
          >
            <path
              d="M13.3614 1.76204L16.7381 5.14024L17.3006 4.57676C17.5224 4.355 17.6982 4.09174 17.8182 3.802C17.9382 3.51226 18 3.20172 18 2.88811C18 2.5745 17.9382 2.26396 17.8182 1.97422C17.6982 1.68448 17.5224 1.42122 17.3006 1.19946C17.0789 0.977704 16.8157 0.801798 16.526 0.681784C16.2363 0.56177 15.9258 0.5 15.6122 0.5C14.979 0.5 14.3716 0.751604 13.9239 1.19946L13.3614 1.76204ZM15.1875 6.68757L11.8107 3.30937L1.0962 14.0263L0 18.5L4.47299 17.4045L15.1875 6.68757Z"
              fill="#A8A9AF"
            />
          </svg>
        </template>
      </CustomButton>
    </div>
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'

export default {
  name: 'UserInfo',
  components: { CustomButton },
  props: {
    userInfo: {
      type: Object,
      required: true,
    },
  },
  methods: {
    openModal(field) {
      let title = ''
      let inputs = []

      switch (field) {
        case 'name':
          title = 'Изменение имени'
          inputs = [{ placeholder: 'Новое имя', type: 'text', value: this.userInfo[field] }]
          break
        case 'phone':
          title = 'Изменение номера'
          inputs = [{ placeholder: 'Новый номер', type: 'tel', value: this.userInfo[field] }]
          break
        case 'email':
          title = 'Изменение почты'
          inputs = [{ placeholder: 'Новая почта', type: 'email', value: this.userInfo[field] }]
          break
        case 'password':
          title = 'Изменение пароля'
          inputs = [
            { placeholder: 'Новый пароль', type: 'password', value: '' },
            { placeholder: 'Повторите пароль', type: 'password', value: '' },
          ]
          break
      }

      this.$emit('open-modal', { field, title, inputs })
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.right-part {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 16px;
  align-self: stretch;
}
.rate-container {
  display: flex;
  padding-bottom: 8px;
  flex-direction: column;
  align-items: flex-start;
  gap: 8px;
}
.rate {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 24px;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
.info-row {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 24px;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
.rate-title,
.term {
  color:var(--muted-color);
}
span {
  color:var(--white-color);
}

.fade-up {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeUp 0.8s ease forwards;
}

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
