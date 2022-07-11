<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>{{title}}</h1>
      <div class="flex justify-between items-center py-3">
        <a href="/admin/posts" type="submit" class="btn-admin mr-[10px]">Перейти до Всі Пости</a>
        <a href="/admin/posts/create" type="submit" class="btn-admin">Додати ще один пост</a>
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
export default {
  name: "PostConfirmationModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    title: {
      type: String,
      required: true,
    },
  },
  emits: ['close'],

  components: {
    BaseModal
  }
}
</script>

<style scoped>

</style>