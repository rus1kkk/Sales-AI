<template>
  <div
    class="rounded-xl p-2 mb-1"
    :class="isOwn ? 'bg-blue-500 text-white ml-auto' : 'bg-gray-200 text-black mr-auto'"
    style="max-width: 75%"
  >
    <p class="text-sm whitespace-pre-wrap">{{ message.message_text }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  message: Object,
  currentUserId: Number,
})

const isOwn = props.message.id_user === props.currentUserId
</script>

<style scoped></style>
