<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard />
      <PurchaseHistory />
    </div>
    <PaymentMethod />
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/ProfileCard.vue'
import PurchaseHistory from '@/components/Profile/PurchaseHistory.vue'
import PaymentMethod from '@/components/Profile/PaymentMethod.vue';

export default {
  name: 'ProfileView',
  components: { ProfileCard, PurchaseHistory, PaymentMethod },
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
