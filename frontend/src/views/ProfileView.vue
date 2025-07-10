<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard />
      <PurchaseHistory />
    </div>
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/ProfileCard.vue'
import PurchaseHistory from '@/components/Profile/PurchaseHistory.vue'

export default {
  name: 'ProfileView',
  components: { ProfileCard, PurchaseHistory },
}
</script>

<style scoped>
.user-profile {
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  font-family: Montserrat;
  color: #fff;
  gap: 24px;
}
.top-block {
  display: inline-flex;
  align-items: flex-start;
  gap: 24px;
}
</style>
