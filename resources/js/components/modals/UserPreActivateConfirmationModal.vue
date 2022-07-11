<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
        <h1>{{ title }}{{ user.name }} {{ user.surname }}?</h1>
        <div class="flex justify-between items-center py-3">
          <a @click="$emit('close')" type="submit" class="btn-admin mr-[10px] cursor-pointer cursor-pointer">Ні</a>
          <a @click="$emit('activate', user.id)" type="submit" class="btn-admin cursor-pointer cursor-pointer">Так</a>
        </div>

    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";

export default {
  name: "UserPreActivateConfirmationModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    title: {
      type: String,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
  },
  emits: ['close', 'activate'],

  components: {
    BaseModal,
  }
}
</script>

<style scoped>

</style>