<template>
  <div class="profile-card">
    <div class="left-part">
      <UserPhoto
        class="fade-up"
        style="animation-delay: 0.3s"
        ref="userPhoto"
        :photoUrl="userInfo.photoUrl"
        :isSaving="isSaving"
        @photo-changed="$emit('photo-changed', $event)"
      />
      <CustomButton
        class="fade-up"
        style="animation-delay: 0.6s"
        type="default"
        label="Выход"
        @click="$emit('logout')"
      />
    </div>
    <div class="right-part">
      <UserInfo
        class="fade-up"
        style="animation-delay: 0.4s"
        :userInfo="userInfo"
        @open-modal="$emit('open-modal', $event)"
      />
    </div>
  </div>
</template>

<script>
import UserPhoto from './UserPhoto.vue'
import UserInfo from './UserInfo.vue'
import CustomButton from '../CustomButton.vue'

export default {
  name: 'ProfileCard',
  props: {
    userInfo: {
      type: Object,
      required: true,
    },
    isSaving: {
      type: Boolean,
      default: false,
    },
  },
  components: { UserPhoto, UserInfo, CustomButton },
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

.right-part {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 16px;
  align-self: stretch;
}

.fade-up {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .profile-card {
    min-width: 0;
    max-width: 90vw;
  }
}

@media (max-width: 668px) {
  .profile-card {
    flex-direction: column;
    max-width: 410px;
    margin: 0 auto;
  }
}

@media (max-width: 480px) {
  .profile-card {
    flex-direction: column;
    max-width: 349px;
  }
}
</style>
