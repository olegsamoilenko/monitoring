<template>
  <div class="max-w-[425px] mx-auto px-[20px] mt-[80px] mb-[100px]">
    <form class="mt-5" @submit.prevent="change">
      <span class="form-error" v-if="errors.error">{{ errors.error }}</span>
      <label class="block mt-3.5">
        <span class="form-label">Адрес електронної пошти</span>
        <app-input
          type="email"
          name="email"
          :errors="errors"
          v-model="email"
          placeholder="email"
        ></app-input>
        <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
      </label>

      <label class="block mt-3.5 relative">
        <span class="form-label">Новий пароль</span>
        <app-input
          v-if="!showPassword"
          type="password"
          name="password"
          :errors="errors"
          v-model="password"
          placeholder="Введіть пароль"
        ></app-input>
        <app-input
          v-else
          type="text"
          name="password"
          :errors="errors"
          v-model="password"
          placeholder="Введіть пароль"
        ></app-input>
        <a class="absolute top-[42px] right-[28px] text-[12px] cursor-pointer"
           @click="showPassword = !showPassword">{{ !showPassword ? 'Show' : 'Hide' }}</a>
        <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
      </label>


      <label class="block mt-3.5 relative">
        <span class="form-label">Підтвердьте пароль</span>
        <app-input
          v-if="!showPasswordConfirmation"
          type="password"
          name="password_confirmation"
          :errors="errors"
          v-model="passwordConfirmation"
          placeholder="Підтвердьте пароль"
        ></app-input>

        <app-input
          v-else
          type="text"
          name="password_confirmation"
          :errors="errors"
          v-model="passwordConfirmation"
          placeholder="Підтвердьте пароль"
        ></app-input>

        <a class="absolute top-[42px] right-[28px] text-[12px] cursor-pointer"
           @click="showPasswordConfirmation = !showPasswordConfirmation">
          {{ !showPasswordConfirmation ? 'Show' : 'Hide' }}
        </a>
      </label>
      <app-button
        type="submit"
        :disabled="changePassword"
        title="Змінити пароль"
      ></app-button>
    </form>

    <teleport to="#modal">
      <confirmation-modal
        v-if="showConfirmationModal"
        confirmationTitle="Ви успішно змінили пароль"
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
  name: "ResetPassword",
  data() {
    return {
      token: document.location.pathname.split('/')[2],
      email: document.location.search.split('%40')[0].split('=')[1] + '@' + document.location.search.split('%40')[1],
      password: null,
      passwordConfirmation: null,

      errors: {},
      changePassword: false,

      showPassword: false,
      showPasswordConfirmation: false,
      showConfirmationModal: false,
    }
  },
  methods: {
    change() {
      this.changePassword = true
      let formData = {
        token: this.token,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      }
      return new Promise((res,rej)=>{
        axios.post('/reset-password', formData)
          .then(response => {
            this.changePassword = false
            this.showConfirmationModal = true
          })
          .catch(err => {
            this.changePassword = false
            this.errors = err.response.data.errors
            console.log('err', err.response.data.errors)
          })
      })
    },

    close() {
      this.showConfirmationModal = false
      document.location.href = '/login'
    }
  },
  mounted() {
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