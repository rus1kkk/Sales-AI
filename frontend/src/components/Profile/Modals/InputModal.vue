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
.input {
  width: 100%;
  max-width: 705px;
  padding: 25px 36px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(7.5px);
  border: none;
  color: #a8a9af;
  font-size: 16px;
  outline: none;
  font-family: Montserrat;
}

.input::placeholder {
  font-family: Montserrat;
  color: #a8a9af;
}

.input-error {
  border-radius: 60px;
  background:
    linear-gradient(0deg, rgba(255, 0, 0, 0.2) 0%, rgba(255, 0, 0, 0.2) 100%),
    rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(7.5px);
}
</style>
