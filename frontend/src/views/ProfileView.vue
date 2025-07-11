<template>
  <div class="user-profile">
    <div class="top-block">
      <ProfileCard />
      <PurchaseHistory />
      <PaymentMethod />
    </div>
  </div>
</template>

<script>
import ProfileCard from '../components/Profile/User/ProfileCard.vue'
import PurchaseHistory from '@/components/Profile/History/PurchaseHistory.vue'
import PaymentMethod from '@/components/Profile/Payment/PaymentMethod.vue'

export default {
  name: 'ProfileView',
  components: { ProfileCard, PurchaseHistory, PaymentMethod },
}
</script>

<style scoped>
.user-profile {
  max-width: 1483px;
  width: 100%;
  margin: 82px auto 90px;
  display: flex;
  box-sizing: border-box;
  padding: 0 80px;
  font-family: Montserrat;
  color: #fff;
  gap: 24px;
}
.top-block {
  display: grid;
  grid-template-columns: minmax(562px, 647px) minmax(518px, 652px);
  grid-template-rows: auto auto;
  gap: 0px 0px;
  gap: 24px;
  width: 100%;
}
</style>
