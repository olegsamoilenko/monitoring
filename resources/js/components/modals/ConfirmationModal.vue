<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>{{confirmationTitle}}</h1>
      <div class="flex justify-end center py-3">
        <a @click="$emit('close')" type="submit" class="btn-admin mr-[10px] cursor-pointer">{{buttonTitle}}</a>
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";

export default {
  name: "ConfirmationModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    confirmationTitle: {
      type: String,
      required: true,
    },
    buttonTitle: {
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