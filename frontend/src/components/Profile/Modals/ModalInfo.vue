<template>
  <div v-if="isOpen" class="modal-overlay">
    <div class="modal">
      <div class="modal-info">
        <div class="title-row">
          <div class="title">Информация</div>
          <CustomButton type="icon" @click="onClose">
            <template #icon>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="21"
                viewBox="0 0 20 21"
                fill="none"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M0.418415 0.918415C0.976316 0.360528 1.88083 0.360528 2.43873 0.918415L10 8.47973L17.5613 0.918415C18.1192 0.360528 19.0237 0.360528 19.5816 0.918415C20.1395 1.47632 20.1395 2.38083 19.5816 2.93873L12.0203 10.5L19.5816 18.0613C20.1395 18.6192 20.1395 19.5237 19.5816 20.0816C19.0237 20.6395 18.1192 20.6395 17.5613 20.0816L10 12.5203L2.43873 20.0816C1.88083 20.6395 0.976316 20.6395 0.418415 20.0816C-0.139472 19.5237 -0.139472 18.6192 0.418415 18.0613L7.97973 10.5L0.418415 2.93873C-0.139472 2.38083 -0.139472 1.47632 0.418415 0.918415Z"
                  fill="#A8A9AF"
                />
              </svg>
            </template>
          </CustomButton>
        </div>
        <div class="purchase-info">
          <div class="data-row">
            <p class="property">Дата покупки</p>
            <p class="value">{{ purchase.date }}</p>
          </div>
          <div class="data-row">
            <p class="property">Название тарифа</p>
            <p class="value">{{ purchase.title }}</p>
          </div>
          <div class="data-row">
            <p class="property">Количество</p>
            <p class="value">{{ purchase.quantity }} шт</p>
          </div>
          <div class="data-row">
            <p class="property">Действителен до</p>
            <p class="value">{{ purchase.expiryDate }}</p>
          </div>
        </div>
      </div>
      <div class="button-row">
        <CustomButton type="text-blue" label="Отменить" @click="onClose" />
      </div>
    </div>
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'

export default {
  name: 'ModalInfo',
  components: { CustomButton },
  props: {
    isOpen: { type: Boolean, required: true },
    onClose: { type: Function, required: true },
    purchase: { type: Object, required: true },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/Profile/ModalInfo.css';
</style>
