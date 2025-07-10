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
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}
.user-pic {
  width: 250px;
  height: 250px;
  aspect-ratio: 1/1;
  border-radius: 10px;
  background-color: rgb(37, 37, 37);
}
</style>
