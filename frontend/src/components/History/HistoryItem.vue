<template>
    <div class="history-item">
        <div class="left-section">
            <p class="const-p" id="date">{{ item.date }}</p>
            <div>
                <div class="name-section">
                    <p class="const-p name">Название:</p>
                    <!-- to="/generate/{id_chat}" -->
                    <router-link to="/generate" class="link margin-l-r">{{ item.name }}</router-link>
                    <img :src="changeNameIcon" alt="change" @click="openModalUpdate(item)"/>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div>
                <p class="const-p">Статус:</p>
                <p class="status">{{ item.status }}</p>
            </div>
            <img class="trash" :src="trashIcon" alt="delete" @click="openModalDelete(item)"/>
        </div>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import changeNameIcon from '@/assets/images/pencil.svg'
import trashIcon from '@/assets/images/trash.svg'

const props = defineProps({
  item: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['edit, delete'])

const openModalDelete = () => {
  emit('delete', props.item)
}

const openModalUpdate = () => {
  emit('edit', props.item)
}

</script>

<style scoped>
    .history-item{
        display: flex;
        justify-content: space-between;
        height: 74px;
        align-items: center;
        padding: 0px 48px;
    }

    .history-item:not(:last-child){
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .history-item div{
        display: flex;
    }

    .left-section{
        align-items: center;
        min-width: 0; 
        gap: 48px;
    }

    .right-section{
        width: 348px;
        justify-content: space-between;
        align-items: center;
        justify-self: end;
    }

    .const-p{
        color: var(--muted-color);
    }

    .history-item .link{
        color: var(--white-color);
        margin-left: 24px;
        margin-right: 16px;
    }

    .history-item img{
        cursor: pointer;
    }
    
    .status{
        white-space: nowrap;
        margin-left: 24px;
    }

    .name-section{
        flex: 1;
        min-width: 0;
    }

    .trash{
        align-self: flex-end;
    }
</style>
