<template>
  <div class="max-w-[425px] mx-auto px-[20px] mt-[80px] mb-[100px]">
    <div>
      <div class="border-b">
        <h3 class="font-inter  text-20">Логін</h3>
        <p class="font-inter font-light text-14 text-[#8692A6] mt-2 mb-3">Введіть свої облікові дані</p>
        <span></span>
      </div>
      <form class="mt-5" @submit.prevent="login">
        <span class="form-error" v-if="errors.error">{{ errors.error }}</span>
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
          <span class="form-error" v-if="errors.activated">{{ errors.activated[0] }}</span>
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

        <div class="mt-4 font-semibold font-inter text-14 text-[#1565D8]">
          <a href="/forgot-password">Забули свій пароль?</a>
        </div>
        <app-button
          type="submit"
          :disabled="loadingLogin"
          title="Увійти"
        ></app-button>
      </form>
    </div>
  </div>
</template>

<script>
import AppInput from "../../components/app/AppInput";
import AppButton from "../../components/app/AppButton";
import axios from "axios";
export default {
  name: "login",
  data() {
    return {
      formData: {
        email: '',
        password: ''
      },
      error: null,
      showPassword: false,
      errors: {},
      loadingLogin: false
    }
  },
  methods: {
    login() {
      this.loadingLogin = true
      return new Promise((res,rej)=>{
        axios.post('/login', this.formData)
          .then(response => {
            this.loadingLogin = false
            document.location.href = '/'
          })
          .catch(err => {
            this.loadingLogin = false
            this.errors = err.response.data.errors
            console.log('err', err.response.data.errors)
          })
      })
    }
  },
  components: {
    AppInput,
    AppButton
  }
}
</script>

<style scoped>

</style>