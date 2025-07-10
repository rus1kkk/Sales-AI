<template>
  <div class="card">
    <div class="card-icon" :style="{ backgroundImage: `url(${card.icon})` }"></div>
    <p class="card-title">{{ card.title }}</p>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: {
    card: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
  },
};
</script>

<style scoped>
.card {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 24px;
}

.card-icon {
  width: 24px;
  height: 24px;
  border-radius: 50px;
  background-size: contain;
  background-repeat: no-repeat;
  background-position-y: center;
}

.card-title {
  color: #e6e9ed;
  font-family: Montserrat;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 19.2px */
}
</style>