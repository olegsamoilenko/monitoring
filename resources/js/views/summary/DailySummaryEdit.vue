<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
    <h1>Оновлення оперативної ситуації</h1>
    <form @submit.prevent="updateDailySummary">

      <QuillEditor theme="snow" toolbar="essential" v-model:content="value" contentType="html" />


      <div class="flex justify-between items-center py-3">
        <button type="submit" class="btn-admin">
          Оновити
        </button>
      </div>
    </form>


<!--    <button @click="updateDailySummary">btn</button>-->

  </div>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from "axios";

export default {
  name: "DailySummaryEdit",
  props: {
    dailySummary: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      value: this.dailySummary.text,
    }
  },
  methods: {

    updateDailySummary() {
      const formData = {
        '_method': 'put',
        'id': this.dailySummary.id,
        'text': this.value
      }
      console.log(formData);

      return new Promise((res, rej) => {
        axios.post(`/operational-situation/update`, formData)
          .then(response => {
            document.location.href = '/'
            console.log(response)
            // this.showUserUpdateConfirmationModal = true
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },
  },
  mounted() {
    console.log(this.dailySummary)
  },
  components: {
    QuillEditor,
  }
}
</script>

<style scoped>

</style>