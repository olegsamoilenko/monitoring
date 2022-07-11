<template>
  <input
    :type="type"
    :name="name"
    class="form-input w-full block"
    :class="{'border-red-500': error}"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    :placeholder="placeholder"
    :disabled="disabled"
  />
</template>

<script>
export default {
  name: "AppInput",
  props: {
    type: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    error: {
      // type: String && Array,
      required: false
    },
    disabled: {
      type: Boolean,
      required: false
    },
    placeholder: {
      type: String,
      required: true
    },
    modelValue: {

    }

  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>