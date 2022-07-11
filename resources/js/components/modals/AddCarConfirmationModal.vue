<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>Ви успішно додали автомобіль</h1>
      <div class="sm:flex justify-between center py-3">
        <div class="text-center mb-[10px]">
          <a href="/" class="btn-admin mr-[10px] cursor-pointer">На головну</a>
        </div>
        <div class="text-center mb-[10px]">
          <a href="/monitoring" class="btn-admin mr-[10px] cursor-pointer">До Моніторінгу</a>
        </div>
        <div class="text-center mb-[10px]">
          <a @click="$emit('close')" type="submit" class="btn-admin mr-[10px] cursor-pointer">Додати наступну</a>
        </div>


      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";

export default {
  name: "AddCarConfirmationModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
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