<template>
  <div class="content-banner">
    <h1>
      Начни Создавать Вместе с
      <span class="sales-ai-text">Sales AI</span>
    </h1>
    <div class="arrow">
      <img src="@/assets/images/arrow.svg" alt="Arrow" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'MainPage',
}
</script>

<style scoped>

.content-banner {
  margin: 140px 72px 660px 72px;
  max-width: 828px;
  position: relative;
}

h1 {
  font-weight: 500;
  font-size: 90px;
  color: var(--actient-color);
  margin: 0;
}

.sales-ai-text {
  font-family: 'Times New Roman', Times, serif;
  font-style: italic;
  font-size: 110px;
  font-weight: 400;
  color: var(--white-color);
}

.arrow {
  width: 124px;
  height: auto;
  margin-left: auto;
  margin-right: 21px;
}

</style>
