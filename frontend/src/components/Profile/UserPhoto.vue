<template>
  <div class="photo">
    <div class="user-pic"></div>
    <button class="text-btn">Изменить фото</button>
  </div>
</template>

<script>
export default {
  name: 'UserPhoto',
}
</script>

<style scoped>
.photo {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}
.user-pic {
  max-width: 250px;
  width: 100%;
  height: 100%;
  aspect-ratio: 1/1;
  border-radius: 10px;
  background-color: rgb(37, 37, 37);
}
</style>
