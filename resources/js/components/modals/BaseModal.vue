<template>
  <div class="modal-backdrop" @click="close"></div>
  <div class="modal relative w-[80vw]">
    <div class="mb-2 pl-[30px]">
      <h3 class="font-gilroy-400 text-16">{{ modalTitle }}</h3>
    </div>

    <slot></slot>


<!--    <button v-if="visibleCloseButton" dusk="modal-button-close" class="absolute top-[4px] right-[11px]" @click="$emit('close')">X</button>-->
  </div>
</template>

<script>
export default {
  name: "BaseModal",
  props: {
    modalTitle: {
      type: String,
      required: false
    },
    // visibleCloseButton: {
    //   type: Boolean,
    //   default: true
    // }

  },
  emits: ['close'],
  methods: {
    close() {
      this.$emit('close')
    },
  },
}
</script>

<style scoped>

</style>