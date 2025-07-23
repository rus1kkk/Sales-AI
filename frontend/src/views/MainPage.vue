<template>
  <div class="content-wrapper">
    <div class="main-banner">
      <h1>
        Начни Создавать Вместе с
        <span class="title-text"
          >{{ title }}
          <img src="@/assets/images/arrow.svg" class="arrow" alt="Arrow" />
        </span>
      </h1>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MainPage',
  props: {
    title: {
      type: String,
      default: 'Sales AI',
    },
  },
}
</script>

<style scoped>
@import '../assets/styles/MainPage.css';
</style>
