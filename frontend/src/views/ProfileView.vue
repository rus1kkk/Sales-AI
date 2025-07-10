<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard />
    </div>
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/ProfileCard.vue'

export default {
  name: 'ProfileView',
  components: { ProfileCard },
}
</script>

<style scoped>
.user-profile {
  margin: 0 auto;
  display: flex;
  font-family: Montserrat;
  color: #fff;
  background-color: rgb(34, 33, 36);
}
.top-block {
  display: inline-flex;
  align-items: flex-start;
  gap: 24px;
}
</style>
