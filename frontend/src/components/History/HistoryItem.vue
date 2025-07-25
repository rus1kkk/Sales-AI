<template>
  <div class="history-item">
    <div class="left-section">
      <p class="const-p" id="date">{{ item.date }}</p>
      <div class="name-container">
        <div class="name-section">
          <p class="const-p name">Название:</p>
          <!-- to="/generate/{id_chat}" -->
          <router-link to="/generate" class="link margin-l-r">{{ item.name }}</router-link>
        </div>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="19"
          height="19"
          viewBox="0 0 19 19"
          fill="none"
          style="min-height: 19px; min-width: 19px"
          @click="openModalUpdate(item)"
        >
          <path
            d="M14.0283 1.76204L17.4051 5.14024L17.9676 4.57676C18.1894 4.355 18.3652 4.09174 18.4852 3.802C18.6052 3.51226 18.667 3.20172 18.667 2.88811C18.667 2.5745 18.6052 2.26396 18.4852 1.97422C18.3652 1.68448 18.1894 1.42122 17.9676 1.19946C17.7459 0.977704 17.4827 0.801798 17.193 0.681784C16.9033 0.56177 16.5928 0.5 16.2792 0.5C15.646 0.5 15.0386 0.751604 14.5908 1.19946L14.0283 1.76204ZM15.8544 6.68757L12.4777 3.30937L1.76319 14.0263L0.666992 18.5L5.13998 17.4045L15.8544 6.68757Z"
            fill="#A8A9AF"
          />
        </svg>
      </div>
    </div>
    <div class="right-section">
      <div class="status-container">
        <p class="const-p">Статус:</p>
        <p class="status">{{ item.status }}</p>
      </div>
      <svg
        class="info-icon"
        xmlns="http://www.w3.org/2000/svg"
        width="21"
        height="20"
        viewBox="0 0 21 20"
        fill="none"
        @click="openModalInfo(item)"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M20.833 10C20.833 15.5228 16.3558 20 10.833 20C5.31016 20 0.833008 15.5228 0.833008 10C0.833008 4.47715 5.31016 0 10.833 0C16.3558 0 20.833 4.47715 20.833 10ZM10.833 5.75C10.2117 5.75 9.70801 6.25368 9.70801 6.875C9.70801 7.28921 9.37221 7.625 8.95801 7.625C8.5438 7.625 8.20801 7.28921 8.20801 6.875C8.20801 5.42525 9.38331 4.25 10.833 4.25C12.2827 4.25 13.458 5.42525 13.458 6.875C13.458 7.58584 13.1745 8.232 12.716 8.704C12.6237 8.7989 12.5357 8.8869 12.4517 8.9708C12.2359 9.1864 12.0468 9.3753 11.8809 9.5885C11.6619 9.8699 11.583 10.0768 11.583 10.25V11C11.583 11.4142 11.2472 11.75 10.833 11.75C10.4188 11.75 10.083 11.4142 10.083 11V10.25C10.083 9.5948 10.388 9.0644 10.6972 8.6672C10.9259 8.3733 11.2134 8.0863 11.4468 7.85346C11.5172 7.78321 11.5826 7.71789 11.64 7.65877C11.8376 7.45543 11.958 7.18004 11.958 6.875C11.958 6.25368 11.4543 5.75 10.833 5.75ZM10.833 15C11.3853 15 11.833 14.5523 11.833 14C11.833 13.4477 11.3853 13 10.833 13C10.2807 13 9.83301 13.4477 9.83301 14C9.83301 14.5523 10.2807 15 10.833 15Z"
          fill="#A8A9AF"
        />
      </svg>
      <svg
        class="trash"
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="25"
        viewBox="0 0 20 25"
        fill="none"
        @click="openModalDelete(item)"
      >
        <path
          d="M18.1651 7.59227H1.83486C1.59021 7.59227 1.37615 7.68204 1.19266 7.8616C1.00917 8.04115 0.917431 8.25062 0.917431 8.49002L2.07951 23.6022C2.0999 23.8616 2.22222 24.0761 2.44648 24.2456C2.67074 24.4152 2.97655 24.5 3.36391 24.5H16.6361C17.0031 24.5 17.2987 24.4152 17.5229 24.2456C17.7472 24.0761 17.8797 23.8616 17.9205 23.6022L19.0826 8.49002C19.0826 8.25062 18.9908 8.04115 18.8073 7.8616C18.6239 7.68204 18.4098 7.59227 18.1651 7.59227ZM5.22936 22.7045C5.02548 22.7045 4.842 22.6147 4.6789 22.4352C4.5158 22.2556 4.43425 22.0461 4.43425 21.8067L3.63914 10.2556C3.63914 10.0162 3.73089 9.81172 3.91437 9.64214C4.09786 9.47257 4.31193 9.38778 4.55657 9.38778C4.80122 9.38778 5.01529 9.47257 5.19878 9.64214C5.38226 9.81172 5.47401 10.0162 5.47401 10.2556L6.02447 21.8067C6.02447 22.0461 5.94801 22.2556 5.79511 22.4352C5.6422 22.6147 5.45362 22.7045 5.22936 22.7045ZM10.7951 21.7768C10.7951 22.0362 10.7187 22.2556 10.5657 22.4352C10.4128 22.6147 10.2243 22.7045 10 22.7045C9.77574 22.7045 9.58716 22.6147 9.43425 22.4352C9.28135 22.2556 9.20489 22.0362 9.20489 21.7768L9.08257 10.2556C9.08257 10.0162 9.17431 9.81172 9.3578 9.64214C9.54128 9.47257 9.75535 9.38778 10 9.38778C10.2446 9.38778 10.4587 9.47257 10.6422 9.64214C10.8257 9.81172 10.9174 10.0162 10.9174 10.2556L10.7951 21.7768ZM15.5657 21.8067C15.5657 22.0461 15.4842 22.2556 15.3211 22.4352C15.158 22.6147 14.9745 22.7045 14.7706 22.7045C14.5464 22.7045 14.3578 22.6147 14.2049 22.4352C14.052 22.2556 13.9755 22.0461 13.9755 21.8067L14.526 10.2556C14.526 10.0162 14.6177 9.81172 14.8012 9.64214C14.9847 9.47257 15.1988 9.38778 15.4434 9.38778C15.6881 9.38778 15.9021 9.47257 16.0856 9.64214C16.2691 9.81172 16.3609 10.0162 16.3609 10.2556L15.5657 21.8067ZM18.6544 3.70199L13.1804 2.80424C12.9358 2.76434 12.7829 2.61471 12.7217 2.35536L12.4771 1.36783C12.3955 0.968828 12.2528 0.709476 12.0489 0.589776C11.9266 0.529925 11.7023 0.5 11.3761 0.5H8.62385C8.29766 0.5 8.0632 0.529925 7.92049 0.589776C7.71662 0.709476 7.5841 0.968828 7.52294 1.36783L7.27829 2.35536C7.23751 2.61471 7.08461 2.76434 6.81957 2.80424L1.34557 3.70199C0.958206 3.76185 0.637105 3.90648 0.382263 4.13591C0.127421 4.36534 0 4.64963 0 4.98878V5.82668C0 6.00623 0.0662589 6.15586 0.198777 6.27556C0.331295 6.39526 0.489297 6.45511 0.672783 6.45511H19.3272C19.5107 6.45511 19.6687 6.39526 19.8012 6.27556C19.9337 6.15586 20 6.00623 20 5.82668V4.98878C20 4.64963 19.8726 4.36534 19.6177 4.13591C19.3629 3.90648 19.0418 3.76185 18.6544 3.70199Z"
          fill="#A8A9AF"
        />
      </svg>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
})

const emit = defineEmits(['edit', 'delete', 'info'])

const openModalDelete = () => {
  emit('delete', props.item)
}

const openModalUpdate = () => {
  emit('edit', props.item)
}

const openModalInfo = () => {
  emit('info', props.item)
}
</script>

<style scoped>
.history-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 27px 48px;
}

.history-item:not(:last-child) {
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}

.left-section {
  display: flex;
  align-items: center;
  min-width: 0;
  gap: 48px;
}

.right-section {
  display: flex;
  width: 348px;
  justify-content: space-between;
  align-items: center;
  justify-self: end;
}

.const-p {
  color: var(--muted-color);
}

.history-item .link {
  display: inline;
  color: var(--white-color);
}

.link {
  display: inline-block;
  max-width: 250px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.history-item img {
  cursor: pointer;
}

.name-container {
  display: flex;
  gap: 16px;
}

.status {
  white-space: nowrap;
}

.name-section {
  display: flex;
  gap: 24px;
}

.trash {
  display: flex;
  align-self: flex-end;
}

.status-container {
  display: flex;
  gap: 24px;
}

.info-icon {
  display: none;
}

path {
  transition: fill 0.3s ease-in-out;
}

path:hover {
  fill: var(--actient-color);
  cursor: pointer;
}

@media (max-width: 1060px) {
  .status-container {
    display: none;
  }

  .right-section {
    width: auto;
    gap: 13px;
  }

  .info-icon {
    display: inline;
  }

  .left-section {
    gap: 13px;
  }

  .link {
    max-width: 190px;
  }
}

@media (max-width: 768px) {
  #date {
    display: none;
  }
}

@media (max-width: 600px) {
  .link {
    max-width: 130px;
  }
}

@media (max-width: 480px) {
  .link {
    max-width: 130px;
  }
  .name {
    display: none;
  }
  .link {
    max-width: 100px;
  }
}
</style>
