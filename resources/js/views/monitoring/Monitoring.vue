<template>
  <div class="container mx-auto p-[15px] mb-[100px]">

    <app-page-title
      title="Моніторинг автомобілів"
    ></app-page-title>

    <div>
      <form @submit.prevent="search">
        <label class="block mt-3.5">
        <span class="form-label">Для пошуку введіть номер автомобіля без пробілів та тире. Регистр значення не має. Наприклад ВІ1234ВІ, 12345ВІ, по1234по.
        Або залиште пустим, якщо хочете переглянути інформацію по всім автомобілям</span>
          <app-input
            type="text"
            name="carMonitoringNumber"
            :errors="errors"
            v-model="carNumber"
            placeholder="Введіть номер автомобіля"
          ></app-input>
          <span class="form-error" v-if="errors.carMonitoringNumber">{{ errors.carMonitoringNumber }}</span>
        </label>
        <div class="mt-[20px]">
          <span class="form-label">Виберіть кінцевий та початковий період, або залиште пустим, якщо хочете переглянути інформацію за весь наявний період</span>
          <Datepicker class="mt-[10px]" v-model="date" inline autoApply range placeholder="Виберіть період"></Datepicker>
        </div>
        <div class="mt-[20px]">
          <div class="form-label">Виберіть пост, за яким Ви хочете отримати інформацію, або залиште пустим, якщо хочете
            переглянути інформацію по всім постам
          </div>
          <select class="form-input" name="postNumber" v-model="carMonitoringPost">
            <option :value="null">Виберіть номер посту</option>
            <option
              v-for="p in posts"
              :key="p.id"
              :value="p.number"
            >Пост № {{ p.number }}
            </option>
          </select>

        </div>


        <app-button
          type="submit"
          title="Переглянути"
        ></app-button>
      </form>
    </div>
  </div>
</template>

<script>
import AppInput from "../../components/app/AppInput";
import AppButton from "../../components/app/AppButton";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import axios from "axios";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js'
import AppPageTitle from "../../components/app/AppPageTitle";

export default {
  name: "Monitoring",
  data() {
    return {
      carMonitoringNumber: null,
      carMonitoringStartDate: null,
      carMonitoringEndDate: null,
      carMonitoringPost: null,

      errors: {},
      carNumber: null,
      date: null,
      posts: [],
    }
  },
  methods: {
    search() {
      if (!this.carNumber) {

        this.carMonitoringNumber = null
      }
      if (this.carNumber) {
        let p = /[^a-zA-Zа-яієїґА-ЯІЄЇ0-9]+/g;
        this.carMonitoringNumber = this.carNumber.toUpperCase().replace(/\s/g, "").replace(p, "")
      }

      localStorage.setItem("carMonitoringNumber", JSON.stringify(this.carMonitoringNumber));
      localStorage.setItem("carMonitoringStartDate", JSON.stringify(this.carMonitoringStartDate));
      localStorage.setItem("carMonitoringEndDate", JSON.stringify(this.carMonitoringEndDate));
      localStorage.setItem("carMonitoringPost", JSON.stringify(this.carMonitoringPost));
      document.location.href = '/monitoring/search'
    },

    getDate() {
      let startDate = this.date[0].toLocaleString()
      let startDay = startDate.split('.')[0]
      let startMonth = startDate.split('.')[1]
      let withoutMonthStartDate = startDate.split('.')[2]
      let startYear = withoutMonthStartDate.split(',')[0]
      let withoutYearStartDate = withoutMonthStartDate.split(',')[1]
      this.carMonitoringStartDate = startYear + '-' + startMonth + '-' + startDay + '' + withoutYearStartDate

      let endDate = this.date[1].toLocaleString()
      let endDay = endDate.split('.')[0]
      let endMonth = endDate.split('.')[1]
      let withoutMonthEndDate = endDate.split('.')[2]
      let endYear = withoutMonthEndDate.split(',')[0]
      let withoutYearEndDate = withoutMonthEndDate.split(',')[1]
      this.carMonitoringEndDate = endYear + '-' + endMonth + '-' + endDay + '' + withoutYearEndDate
    },

    getPosts() {
      return new Promise((res, rej) => {
        axios.get('/admin/get-posts')
          .then(response => {
            this.posts = response.data.posts;
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.messageError = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },
  },
  mounted() {
    this.getPosts()
  },
  watch: {
    date() {
      this.getDate()
    }
  },
  components: {
    AppInput,
    AppButton,
    Datepicker,
    MoonLoader,
    AppPageTitle
  }
}

</script>

<style scoped>

</style>