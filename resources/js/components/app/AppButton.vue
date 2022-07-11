<template>
  <button :class="btnStyle" type="submit" :disabled="disabled">{{title}}</button>
</template>

<script>
export default {
  name: "AppButton",
  props: {
    type: {
      type: String,
      required: true
    },
    disabled: {
      type: Boolean,
      required: false
    },
    title: {
      type: String,
      required: true
    },
    btnStyle: {
      type: String,
      default: 'btn'
    }
  }
}
</script>

<style scoped>

</style>