<template>
  <button :class="['custom-btn', `btn-${type}`]" :type="buttonType">
    <slot name="icon" v-if="type === 'icon' || 'icon-line'"></slot>
    <span v-if="type !== 'icon'">{{ label }}</span>
  </button>
</template>

<script>
export default {
  name: 'CustomButton',
  props: {
    type: {
      type: String,
      default: 'default',
      validator: (value) => ['default', 'text', 'text-blue', 'icon', 'icon-line'].includes(value),
    },
    buttonType: {
      type: String,
      default: 'button',
      validator: (value) => ['button', 'submit', 'reset'].includes(value),
    },
    label: {
      type: String,
      default: '',
    },
  },
}
</script>

<style scoped>
@import '../../assets/styles/Profile/CustomButton.css';
</style>
