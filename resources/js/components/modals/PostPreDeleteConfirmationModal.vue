<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>{{title}}{{post.number}}?</h1>
      <div class="flex justify-between items-center py-3">
        <a @click="$emit('no')" type="submit" class="btn-admin mr-[10px] cursor-pointer">Ні</a>
        <a @click="$emit('del', post.id)" type="submit" class="btn-admin cursor-pointer">Так</a>
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";

export default {
  name: "PostPreDeleteConfirmationModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    title: {
      type: String,
      required: true,
    },
    post: {
      type: Object,
      required: true,
    }
  },
  emits: ['close', 'del', 'no'],

  components: {
    BaseModal
  }
}
</script>

<style scoped>

</style>