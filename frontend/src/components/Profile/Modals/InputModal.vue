<template>
  <input
    class="input"
    :class="{ 'input-error': hasError }"
    :type="type"
    :placeholder="placeholder"
    :value="value"
    @input="$emit('update:value', $event.target.value)"
    @blur="$emit('blur')"
  />
</template>

<script>
export default {
  name: 'InputModal',
  props: {
    placeholder: {
      type: String,
      default: 'Введите текст',
    },
    type: {
      type: String,
      default: 'text',
    },
    value: {
      type: String,
      default: '',
    },
    hasError: {
      type: Boolean,
      default: false,
    },
  },
  emits: ['update:value', 'blur'],
}
</script>

<style scoped>
@import '../../../assets/styles/Profile/InputForm.css';
</style>
