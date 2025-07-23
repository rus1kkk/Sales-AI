<template>
  <div class="editor">
    <div class="switch">переключатель</div>
    <div class="edited">
      <EditedPresintation></EditedPresintation>
    </div>
  </div>
</template>

<script>
import EditedPresintation from '@/components/Editor/EditedPresintation.vue'

export default {
  name: 'EditorPage',
  components: { EditedPresintation },
}
</script>

<style>
.editor {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.switch {
  text-align: center;
}
</style>
