<!-- <template>
    <section class="tz-table-container">
        <table>
            <tr class="table-name">
                <th :colspan="maxColumns">
                    <input :readonly="isReadOnly" placeholder="Введите название таблицы" :value="tableName">
                </th>
            </tr>
            <tr v-for="(tr, trIndex) in rows" :key="trIndex" class="tr-body">
                <th scope="row" class="title-th">
                    <input 
                        :readonly="isReadOnly && !tr.newRow" 
                        placeholder="Введите заголовок" 
                        :value="tr.th"
                        @input="handleInput(trIndex, 'th', $event)"
                    >
                </th>
                <td v-for="(td, tdIndex) in tr.td" :key="tdIndex">
                    <input 
                        placeholder="Введите значение" 
                        :value="td"
                        @input="handleInput(trIndex, 'td', $event, tdIndex)"
                    >
                    <img style="width: 20px;" class="trash" :src="trashIcon" alt="delete" @click="delCell(trIndex, tdIndex)" />
                </td>
                <td class="add-cell" @click="addCell(trIndex)">
                    Добавить столбец
                </td>
            </tr>
            <tr>
                <th class="add-tr" @click="addRow()" :colspan="maxColumns">Добавить строку</th>
            </tr>
            <tr v-if="rows.length>0">
                <th class="delete-table" :colspan="maxColumns">Удалить таблицу</th>
            </tr>
        </table>
    </section>
</template>

<script setup>
import { ref, watch } from 'vue';
import { computed } from 'vue';
import trashIcon from '@/assets/images/trash.svg'
import { readonly } from 'zod';

const props = defineProps({
  rows: {
    type: Array,
    required: true,
  },
  tableName: String,
  isReadOnly: Boolean
});

// Локальная копия rows с реактивностью
const localRows = ref([...props.rows.map(row => ({
  ...row,
  newRow: false // Добавляем флаг для новых строк
}))]);

const rows = ref([...props.rows]);


const handleInput = (trIndex, field, event, tdIndex = null) => {
  if (cellIndex !== null) {
    // Для ячеек данных
    rows.value[trIndex].td[tdIndex] = event.target.value;
  } else {
    // Для заголовка
    rows.value[trIndex].th = event.target.value;
  }
  rows.value = [...rows.value];
};

watch(() => props.rows, (newRows) => {
  localRows.value = [...newRows.map(row => ({
    ...row,
    newRow: false
  }))];
}, { deep: true });

const addRow = () => {
  rows.value.push({ th: '', td: [], newRow: true });
  rows.value = [...rows.value];
};



const addCell = (trIndex) => {
  if (!rows.value[trIndex].td) {
    rows.value[trIndex].td = [''];
  } else {
    rows.value[trIndex].td.push('');
  }
  rows.value = [...rows.value];
};

const delCell = (trIndex, tdIndex) => {
  rows.value[trIndex].td.splice(tdIndex, 1);
  rows.value = [...rows.value];
};

const maxColumns = computed(() => {
  if (!props.rows.length) return 1;
  
  // Находим строку с максимальным количеством ячеек
  const maxTd = Math.max(
    ...props.rows.map(row => (row.td ? row.td.length : 0))
  );
  
  // +1 потому что есть еще column с th и добавить столбец
  return maxTd + 2;
});

</script> -->



<template>
    <section class="tz-table-container">
        <table v-if="showTable">
            <tr class="table-name">
                <th :colspan="maxColumns">
                    <input :readonly="isReadOnly" placeholder="Введите название таблицы" v-model="localTableName">
                </th>
            </tr>
            <tr v-for="(tr, trIndex) in localRows" :key="'row-'+trIndex" class="tr-body">
                <th scope="row" class="title-th">
                    <input 
                        :readonly="isReadOnly && !tr.isNew" 
                        placeholder="Введите заголовок" 
                        v-model="tr.th"
                    >
                </th>
                
                <template v-for="(td, tdIndex) in tr.td" :key="'cell-'+trIndex+'-'+tdIndex">
                    <td v-if="tr.td.length === 1" :colspan="maxTd">
                        <input 
                            placeholder="Введите значение" 
                            v-model="tr.td[tdIndex]"
                        >
                        <img style="width: 20px;" class="trash" :src="trashIcon" alt="delete" @click="delCell(trIndex, tdIndex)" />
                    </td>
                    <td v-else-if="tdIndex < tr.td.length - 1 || tr.td.length === maxTd" :colspan=1>
                        <input 
                            placeholder="Введите значение" 
                            v-model="tr.td[tdIndex]"
                        >
                        <img style="width: 20px;" class="trash" :src="trashIcon" alt="delete" @click="delCell(trIndex, tdIndex)" />
                    </td>
                    <td v-else :colspan="maxTd-tr.td.length+1">
                        <input 
                            placeholder="Введите значение" 
                            v-model="tr.td[tdIndex]"
                        >
                        <img style="width: 20px;" class="trash" :src="trashIcon" alt="delete" @click="delCell(trIndex, tdIndex)" />
                    </td>
                </template>
                
                <td class="add-cell" @click="addCell(trIndex)">
                    Добавить столбец
                </td>
            </tr>
            <tr>
                <th class="add-tr" @click="addRow()" :colspan="maxColumns">Добавить строку</th>
            </tr>
            <tr v-if="localRows.length>0">
                <th class="delete-table" :colspan="maxColumns" @click="deleteTable">Удалить таблицу</th>
            </tr>
        </table>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import trashIcon from '@/assets/images/trash.svg';

const props = defineProps({
  rows: {
    type: Array,
    required: true,
  },
  tableName: String,
  isReadOnly: Boolean
});

const showTable = ref(true);
const localTableName = ref(props.tableName);
const localRows = ref(JSON.parse(JSON.stringify(props.rows.map(row => ({
  ...row,
  isNew: false,
  td: row.td ? [...row.td] : ['']
})))));

// Вычисляем максимальное количество ячеек в строках (без учета th и кнопки добавления)
const maxTd = computed(() => {
  if (!localRows.value.length) return 1;
  return Math.max(...localRows.value.map(row => (row.td ? row.td.length : 0)));
});

// Общее количество колонок (th + ячейки + кнопка добавления)
const maxColumns = computed(() => maxTd.value + 2);

const deleteTable = () => {
  showTable.value = false;
};

const addRow = () => {
  localRows.value.push({ 
    th: '', 
    td: [''],
    isNew: true
  });
};

const addCell = (trIndex) => {
  if (!localRows.value[trIndex].td) {
    localRows.value[trIndex].td = [''];
  } else {
    localRows.value[trIndex].td = [...localRows.value[trIndex].td, ''];
  }
};

const delCell = (trIndex, tdIndex) => {
  const newTd = [...localRows.value[trIndex].td];
  newTd.splice(tdIndex, 1);
  localRows.value[trIndex].td = newTd.length ? newTd : [''];
};
</script>


<style scoped>
    input, th{
        font-family: 'Montserrat', sans-serif;
        line-height: 120%;
        outline: none;
    }
    th input, th{
        font-size: 24px;
        font-weight: 400;
    }
    .tz-table-container{
        width: 90vw;
        max-width: 1601px;
        margin-top: 60px;
        border-radius: 60px;
        overflow: hidden;
        overflow-x: auto;
    }
    table{
        width: auto; 
        min-width: 1601px;
        border-collapse: collapse;
        border-spacing: 0;
        backdrop-filter: blur(50px);
    }
    tr{
        background-color: rgba(255,255,255,0.2);
        backdrop-filter: blur(50px);
    }
    .tr-body{
        border-bottom: 1px solid rgba(255, 255, 255, 0.4);
    }
    td{
        font-size: 16px;
        border: 10px solid var(--white);
        border-left: 1px solid rgba(255, 255, 255, 0.4);
        width: auto;
        min-width: 300px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    td input{
        font-size: 16px;
        background-color: inherit;
    }
    th, td{
        padding: 24px 36px; 
        margin: 0;
        background: inherit;
    }
    .table-name{
        background-color: var(--btn-text-color);
    }
    .table-name th{
        width: 100%;
        padding: 36px;
    }
    table input{
        width: 100%;
        color: var(--white);
        background: transparent;
        border: none;
    }
    .add-tr, .delete-table{
        padding: 43px;
        text-align: center;
        cursor: pointer;
        width: 100%;
    }
    .add-tr{
        background-color: var(--actient-color);
    }
    .delete-table{
        background-color: #C56B6B;
    }
    .add-cell, .trash{
        cursor: pointer;
    }
    .title-th{
        width: 300px;
        min-width: 300px;
    }
    .tz-table-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
        background: transparent;
    }
    .tz-table-container::-webkit-scrollbar-track {
        background: transparent;
        margin-top: 48px;
        margin-bottom: 48px;
    }
    .tz-table-container::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.32);
        border-radius: 4px;
    }
</style>

