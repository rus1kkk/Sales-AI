<template>
  <div class="right-part">
    <div class="rate-container">
      <div class="rate">
        <p class="rate-title">Тариф:</p>
        <p class="rate-type">{{ userInfo.plan }}</p>
      </div>
      <p class="term">
        Действителен до: <strong>{{ userInfo.validUntil }}</strong>
      </p>
    </div>
    <div class="info-row">
      <p class="property">Имя</p>
      <p class="value">{{ userInfo.name }}</p>
      <button @click="openModal('name')">Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Номер</p>
      <p class="value">{{ userInfo.phone }}</p>
      <button @click="openModal('phone')">Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Почта:</p>
      <p class="value">{{ userInfo.email }}</p>
      <button @click="openModal('email')">Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Пароль:</p>
      <p class="value">********</p>
      <button @click="openModal('password')">Правка</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserInfo',
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
  color: #a8a9af;
}
strong {
  color: #fff;
}
</style>
