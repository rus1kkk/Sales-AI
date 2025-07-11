<template>
  <div class="right-part">
    <div class="rate-container">
      <div class="rate">
        <p class="rate-title">Тариф:</p>
        <p class="rate-type">PRO</p>
      </div>
      <p class="term">Действителен до: <strong>23.09.2025</strong></p>
    </div>
    <div class="info-row">
      <p class="property">Имя</p>
      <p class="value">Денис</p>
      <button>Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Номер</p>
      <p class="value">+79783405384</p>
      <button>Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Почта:</p>
      <p class="value">lol.ogo@mail.ru</p>
      <button>Правка</button>
    </div>
    <div class="info-row">
      <p class="property">Пароль:</p>
      <p class="value">********</p>
      <button>Правка</button>
    </div>
  </div>
</template>

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
  line-height: 120%; /* 19.2px */
}
.rate-title,
.term {
  color: #a8a9af;
}
strong {
  color: #fff;
}
</style>
