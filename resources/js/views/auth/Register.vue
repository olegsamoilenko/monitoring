<template>
  <div class="max-w-[425px] px-[20px] mx-auto mt-[80px] mb-[100px]">

    <div>
      <div class="border-b">
        <h3 class="font-inter text-20">Реєстрація</h3>
        <p class="font-inter font-light text-14 text-[#8692A6] mt-2 mb-3">Введіть свої облікові дані</p>
      </div>
      <form class="mt-5 relative" @submit.prevent="register">
        <label class="block mt-3.5">
          <span class="form-label">Ім'я</span>
          <app-input
            type="text"
            name="name"
            :errors="errors"
            v-model="formData.name"
            placeholder="Введіть ім'я"
          ></app-input>
          <span class="form-error" v-if="errors.name">{{ errors.name[0] }}</span>
        </label>
        <label class="block mt-3.5">
          <span class="form-label">Прізвище</span>
          <app-input
            type="text"
            name="surname"
            :errors="errors"
            v-model="formData.surname"
            placeholder="Введіть Прізвище"
          ></app-input>
          <span class="form-error" v-if="errors.surname">{{ errors.surname[0] }}</span>
        </label>

        <div v-if="loadingRegister" class="absolute top-[25%] left-[33%] flex items-center justify-center mt-10">
          <moon-loader :loading="loadingRegister" color="green" size="120px"></moon-loader>
        </div>
<!--          <vue-tel-input v-model="formData.phone"></vue-tel-input>-->


        <label class="block mt-3.5">
          <span class="form-label">Телефон в форматі "0501234567"</span>
          <app-input
            type="text"
            name="phone"
            :errors="errors"
            v-model="formData.phone"
            placeholder="Введіть телефон"
          ></app-input>
          <span class="form-error" v-if="errors.phone">{{ errors.phone[0] }}</span>
        </label>
        <label class="block mt-3.5">
          <span class="form-label">Електронна пошта</span>
          <app-input
            type="email"
            name="email"
            :errors="errors"
            v-model="formData.email"
            placeholder="Введіть адресу електронної пошти"
          ></app-input>
          <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
        </label>

        <label class="block mt-3.5 relative">
          <span class="form-label">Пароль</span>
          <app-input
            v-if="!showPassword"
            type="password"
            name="password"
            :errors="errors"
            v-model="formData.password"
            placeholder="Введіть пароль"
          ></app-input>
          <app-input
            v-else
            type="text"
            name="password"
            :errors="errors"
            v-model="formData.password"
            placeholder="Введіть пароль"
          ></app-input>
          <a class="absolute top-[42px] right-[28px] text-[12px] cursor-pointer"
             @click="showPassword = !showPassword">{{ !showPassword ? 'Show' : 'Hide' }}</a>
          <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
        </label>


        <label class="block mt-3.5 relative">
          <span class="form-label">Підтвердьте пароль</span>
          <app-input
            v-if="!showPassword_confirmation"
            type="password"
            name="password_confirmation"
            :errors="errors"
            v-model="formData.password_confirmation"
            placeholder="Підтвердьте пароль"
          ></app-input>

          <app-input
            v-else
            type="text"
            name="password_confirmation"
            :errors="errors"
            v-model="formData.password_confirmation"
            placeholder="Підтвердьте пароль"
          ></app-input>

          <a class="absolute top-[42px] right-[28px] text-[12px] cursor-pointer"
             @click="showPassword_confirmation = !showPassword_confirmation">
            {{ !showPassword_confirmation ? 'Show' : 'Hide' }}
          </a>
        </label>

        <app-button
          type="submit"
          :disabled="loadingRegister"
          title="Зареєструватися"
        ></app-button>
      </form>
    </div>
  </div>
</template>

<script>
import AppInput from "../../components/app/AppInput";
import AppButton from "../../components/app/AppButton";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js'
import axios from "axios";
export default {
  name: "Register",
  data: () => ({
    formData: {
      name: '',
      surname: '',
      phone: '',
      email: '',
      password: '',
      password_confirmation: '',
    },
    error: null,
    showPassword: false,
    showPassword_confirmation: false,
    errors: {},
    loadingRegister: false
  }),
  methods: {
    register() {
      // console.log(this.formData)
      this.loadingRegister = true
      return new Promise((res,rej)=>{
        axios.post('/register', this.formData)
          .then(response => {
            this.loadingRegister = false
            console.log(res(response.data));
            document.location.href = '/confirm-register'
          })
          .catch(err => {
            this.loadingRegister = false
            this.errors = err.response.data.errors
            console.log('err', err.response.data.errors)
          })
      })
    },
  },
  components: {
    AppInput,
    AppButton,
    MoonLoader
  }
}
</script>

<style scoped>

</style>