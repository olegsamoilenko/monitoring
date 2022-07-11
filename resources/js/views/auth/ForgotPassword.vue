<template>
  <div class="max-w-[425px] mx-auto px-[20px] mt-[80px] mb-[100px]">
    <form class="mt-5" @submit.prevent="send">
      <span class="form-error" v-if="errors.error">{{ errors.error }}</span>
      <label class="block mt-3.5">
        <span class="form-label">Для відновлення паролю введіть адрес електронної пошти</span>
        <app-input
          type="email"
          name="email"
          :errors="errors"
          v-model="email"
          placeholder="Введіть адресу електронної пошти"
        ></app-input>
        <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
      </label>
      <app-button
        type="submit"
        :disabled="sendRequest"
        title="Надіслати"
      ></app-button>
    </form>

    <teleport to="#modal">
      <confirmation-modal
        v-if="showConfirmationModal"
        confirmationTitle="Інструкції для зміни пароля Вам надіслано на електронну пошту"
        buttonTitle="Ок"
        @close="close"
      ></confirmation-modal>
    </teleport>

  </div>
</template>

<script>
import AppInput from "../../components/app/AppInput";
import AppButton from "../../components/app/AppButton";
import ConfirmationModal from "../../components/modals/ConfirmationModal";
import axios from "axios";
export default {
  name: "ForgotPassword",
  data() {
    return {
      email: null,
      errors: {},
      sendRequest: false,
      showConfirmationModal: false,
    }
  },
  methods: {
    send() {
      this.sendRequest = true
      return new Promise((res,rej)=>{
        axios.post('/forgot-password', {email: this.email})
          .then(response => {
            this.sendRequest = false
            this.showConfirmationModal = true
          })
          .catch(err => {
            this.sendRequest = false
            this.errors = err.response.data.errors
            console.log('err', err.response.data.errors)
          })
      })
    },
    close() {
      this.showConfirmationModal = false
      document.location.href = '/login'
    },
  },
  components: {
    AppInput,
    AppButton,
    ConfirmationModal
  }
}
</script>

<style scoped>

</style>