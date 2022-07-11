<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <div class="flex items-center justify-center">
        <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
      </div>
    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
export default {
  name: "ModalLoader",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    loader: {
      type: Boolean,
      required: true,
    }
  },
  emits: ['close'],

  components: {
    BaseModal,
    MoonLoader
  }
}
</script>

<style scoped>

</style>