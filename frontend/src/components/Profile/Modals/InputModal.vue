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
@import '../../../assets/styles/main.css';

.input {
  width: 100%;
  max-width: 705px;
  padding: 25px 36px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(7.5px);
  border: none;
  color: var(--muted-color);
  font-size: 16px;
  outline: none;
  font-family: Montserrat;
  transition: background 0.5s ease;
  will-change: background;
}

.input::placeholder {
  font-family: Montserrat;
  color:var(--muted-color);
}

.input-error {
  background: rgba(252, 134, 134, 0.5);
}
</style>
