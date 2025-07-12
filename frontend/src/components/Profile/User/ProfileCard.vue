<template>
  <div class="profile-card">
    <div class="left-part">
      <UserPhoto />
      <button class="default-btn">Выход</button>
    </div>
    <UserInfo :userInfo="userInfo" @open-modal="$emit('open-modal', $event)" />
  </div>
</template>

<script>
import UserPhoto from './UserPhoto.vue'
import UserInfo from './UserInfo.vue'

export default {
  name: 'ProfileCard',
  props: {
    userInfo: {
      type: Object,
      required: true,
    },
  },
  components: { UserPhoto, UserInfo },
}
</script>

<style scoped>
.profile-card {
  max-width: 647px;
  min-width: 562px;
  width: 100%;
  display: flex;
  padding: 36px;
  justify-content: center;
  align-items: center;
  gap: 48px;
  border-radius: 60px;
  background:
    linear-gradient(0deg, rgba(14, 0, 0, 0.2) 0%, rgba(14, 0, 0, 0.2) 100%),
    rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(7.5px);
}
.left-part {
  max-width: 250px;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 24px;
}
</style>
