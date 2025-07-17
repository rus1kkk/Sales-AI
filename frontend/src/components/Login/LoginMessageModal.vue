<template>
  <transition name="modal-fade">
    <div v-if="visible" class="modal-overlay">
      <div class="modal-content">
        <p class="modal-message" :class="{ error: isError }">
          {{ message }}
        </p>
      </div>
    </div>
  </transition>
</template>

<script setup>
defineProps({
  visible: Boolean,
  message: String,
  isError: Boolean,
})
</script>

<style scoped>
@import '../../assets/styles/Login/LoginMessageModal.css';
</style>
