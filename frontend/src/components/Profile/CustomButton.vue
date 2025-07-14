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
.custom-btn {
  font-family: Montserrat;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
  cursor: pointer;
  transition: background 0.2s ease-in;
}

/* Стили для default-btn */
.btn-default {
  display: flex;
  height: 67px;
  padding: 25px 36px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 34px;
  border: 3px solid #71abeb;
  background: #71abeb;
  color: #e6e9ed;
  font-size: 24px;
}
.btn-default:hover {
  background: #a8a9af;
}
.btn-default:active:hover {
  border: 3px solid #71abeb;
  background: #a8a9af;
}
.btn-default:active {
  border: 3px solid #a8a9af;
  background: #a8a9af;
}
.btn-default:disabled {
  border: 3px solid #a8a9af;
  background: #a8a9af;
}

/* Стили для text-btn */
.btn-text {
  background: none;
  border: none;
  color: #e6e9ed;
  font-size: 16px;
}
.btn-text:active {
  color: #a8a9af;
}
.btn-text:hover {
  color: #71abeb;
}
.btn-text:disabled {
  color: #a8a9af;
}

/* Стили для text-blue-btn */
.btn-text-blue {
  background: none;
  border: none;
  color: #71abeb;
  font-size: 16px;
}
.btn-text-blue:active {
  color: #e6e9ed;
}
.btn-text-blue:hover {
  color: #e6e9ed;
}
.btn-text-blue:disabled {
  color: #a8a9af;
}

/* Стили для btn-icon */
.btn-icon {
  width: 18px;
  height: 18px;
  aspect-ratio: 1/1;
  background: none;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-icon:active :deep(svg path) {
  fill: #71abeb;
}
.btn-icon:active:hover :deep(svg path) {
  fill: #71abeb;
}
.btn-icon:hover :deep(svg path) {
  fill: #71abeb;
}

/* Стили для btn-icon-line*/
.btn-icon-line {
  width: 18px;
  height: 18px;
  aspect-ratio: 1/1;
  background: none;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-icon-line:active :deep(svg path) {
  stroke: #71abeb;
}
.btn-icon-line:active:hover :deep(svg path) {
  stroke: #71abeb;
}
.btn-icon-line:hover :deep(svg path) {
  stroke: #71abeb;
}
</style>
