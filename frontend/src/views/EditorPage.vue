<template>
  <div class="editor">
    <div class="switch">
      <div class="switch-buttons">
        <button class="tz-button" :disabled="mode === 'tz'" @click="mode = 'tz'">ТЗ</button>
        <button
          class="presentation-button"
          :disabled="mode === 'presentation'"
          @click="mode = 'presentation'"
        >
          ПРЕЗЕНТАЦИЯ
        </button>
      </div>
    </div>

    <div v-if="mode === 'tz'" class="tz-content">
      <div class="placeholder">
        <h2>Техническое задание</h2>
      </div>
    </div>

    <div v-if="mode === 'presentation'" class="edited">
      <EditedPresintation :data="Data" @update:data="handleDataUpdate" />
      <div class="check-res">
        <CustomButton type="default" label="Просмотреть результат" @click="logChangedData" />
      </div>
    </div>
  </div>
</template>

<script>
import EditedPresintation from '@/components/Editor/EditedPresintation.vue'
import CustomButton from '@/components/Profile/CustomButton.vue'
import { reactive, ref } from 'vue'

export default {
  name: 'EditorPage',
  components: { EditedPresintation, CustomButton },
  setup() {
    const mode = ref('tz')

    //  Централизация мокдаты
    const Data = reactive({
      cover: {
        title: 'Разработка сайта для магазина спортивной обуви',
        date: 'Июль 2025',
        fromSomeone: 'Русские сайты',
        toSomeone: 'Лучшая обувь РФ',
        images: ['presentation/photo1.png', 'presentation/photo2.png', 'presentation/photo3.png'],
      },
      problem: {
        title: 'Проблема',
        description:
          'Сейчас многие покупают обувь через интернет — особенно молодёжь. Если у магазина нет нормального сайта, он теряет часть клиентов.',
        subtitle: 'Основные проблемы без сайта:',
        items: [
          'Зависимость от Avito маркетплейсов или Instagram',
          'Сложно рассказать про ассортимент',
          'Нет возможности отслеживать заказы и анализировать продажи',
        ],
        caption: 'Мы предлагаем решение, которое уберёт эти ограничения.',
      },
      solution: {
        title: 'Решение',
        description: 'Мы сделаем сайт, с которым вам будет удобно продавать:',
        items: [
          'Каталог с фильтрами (размер, бренд, цена)',
          'Удобная корзина и оформление заказа',
          'Мобильная версия — всё работает на телефонах',
          'Быстрая работа и понятный дизайн',
          'Готов к подключению онлайн-оплаты и CRM',
        ],
        caption: 'Всё просто: зашёл, нашёл, купил. И вам удобно управлять.',
      },
      product: {
        title: 'Что дает такой продукт?',
        items: [
          'Помогает продавать в любое время, даже ночью',
          'Доверие выше, чем к аккаунтам в соцсетях',
          'Можно запускать рекламу и отслеживать, что работает',
          'Готов к подключению онлайн-оплаты и CRM',
          'Экономит время — меньше ручной обработки заказов',
        ],
        caption: 'Это уже не просто сайт — это полноценный инструмент продаж.',
      },
      stages: {
        title: 'Этапы работы',
        items: [
          'Обсудим ваши задачи и товары',
          'Удобная корзина и оформление заказа',
          'Мобильная версия — всё работает на телефонах',
          'Быстрая работа и понятный дизайн',
          'Готов к подключению онлайн-оплаты и CRM',
        ],
        caption: 'Всё просто: зашёл, нашёл, купил. И вам удобно управлять.',
      },
      price: {
        title: 'Стоимость',
        description:
          'Стоимость зависит от объёма каталога и нужных функций. Примерная цена: от 120 000 до 180 000 ₽',
        subtitle: 'В стоимость входит:',
        items: [
          'Дизайн',
          'Адаптация под телефон',
          'Установка и базовая настройка',
          'Подключение корзины, фильтров, доставки',
        ],
        caption: 'Оплата поэтапно, договор и всё официально.',
      },
      team: {
        title: 'Кто будет делать?',
        subtitle: 'Над проектом будут работать:',
        items: [
          'Дизайнер',
          'Frontend и backend-разработчик',
          'Cпециалист по UX',
          'Mенеджер, который всегда на связи',
          'Экономит время — меньше ручной обработки заказов',
        ],
        images: [
          { src: 'presentation/avatar2.png', alt: 'Фото команды' },
          { src: 'presentation/avatar1.png', alt: 'Дизайнер' },
          { src: 'presentation/avatar3.png', alt: 'Разработчик' },
          { src: 'presentation/avatar4.png', alt: 'Разработчик' },
          { src: 'presentation/avatar5.png', alt: 'Разработчик' },
        ],
        caption:
          'Мы работали с интернет-магазинами и знаем, как сделать так, чтобы сайт приносил продажи.',
      },
      cases: {
        items: [
          {
            src: 'presentation/case_1.png',
            alt: 'Кейс интернет-магазина обуви',
            title: 'Проект для обувного магазина',
          },
          'presentation/case_2.png',
          'presentation/case_3.png',
        ],
      },
      nextSteps: {
        title: 'Следующие шаги',
        items: [
          'Свяжитесь с нами удобным способом',
          'Обсудим детали проекта',
          'Подпишем договор и начинаем работу',
        ],
        caption:
          'Мы объясним каждый этап, покажем макет, поможем после запуска. Всё будет понятно, без сложных слов — просто нормальный рабочий сайт под ваш магазин.',
      },
    })

    const initialData = ref(JSON.parse(JSON.stringify(Data)))

    const changedFields = ref({})

    // Функция проверки изменений в полях
    const detectChanges = (original, current, path = '') => {
      const changes = {}
      for (const key in current) {
        const newPath = path ? `${path}.${key}` : key
        if (Array.isArray(current[key]) && Array.isArray(original[key])) {
          if (JSON.stringify(current[key]) !== JSON.stringify(original[key])) {
            changes[newPath] = current[key]
          }
        } else if (typeof current[key] === 'object' && current[key] !== null && original[key]) {
          const nestedChanges = detectChanges(original[key], current[key], newPath)
          if (Object.keys(nestedChanges).length > 0) {
            Object.assign(changes, nestedChanges)
          }
        } else if (current[key] !== original[key]) {
          changes[newPath] = current[key]
        }
      }
      return changes
    }

    // Обработка обновлений данных в дочерних компонентах
    const handleDataUpdate = (newData) => {
      Object.assign(Data, newData)
      changedFields.value = detectChanges(initialData.value, Data)
    }

    // Выводим измененные поля
    const logChangedData = () => {
      if (Object.keys(changedFields.value).length > 0) {
        console.log('Измененные поля:', changedFields.value)
      } else {
        console.log('Нет измененных полей, текущие данные:', Data)
      }
    }

    return {
      mode,
      Data,
      handleDataUpdate,
      logChangedData,
    }
  },
}
</script>

<style scoped>
@import '../assets/styles/main.css';

.editor {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.switch {
  margin: 139px 120px 120px;
  padding: 0px 160px;
  display: flex;
  justify-content: center;
}

.check-res {
  margin: 0px 120px 120px;
  padding: 0px 160px;
  display: flex;
  justify-content: center;
}

.check-res button {
  width: 100%;
}

.switch-buttons {
  display: flex;
  width: 100%;
  box-sizing: border-box;
  border-radius: 60px;
  overflow: hidden;
  border: 3px solid var(--actient-color);
}

.switch-buttons > button {
  all: unset;
  flex: 1;
  padding: 23px 0;
  background: transparent;
  transition: background-color 0.5s ease;
  cursor: pointer;
  font-weight: 500;
  font-size: 20px;
  text-align: center;
  color: var(--actient-color);
}

.switch-buttons > button:disabled {
  background-color: var(--actient-color);
  color: white;
  cursor: default;
}

.switch-buttons > button:not(:disabled):hover {
  background-color: rgba(var(--actient-color-rgb), 0.1);
}

.tz-content {
  margin: 40px 120px;
  padding: 40px;
}

.placeholder {
  text-align: center;
  padding: 60px 40px;
  border-radius: 12px;
}

.placeholder h2 {
  margin: 0 0 16px 0;
  color: #666;
  font-size: 24px;
  font-weight: 600;
}
</style>
