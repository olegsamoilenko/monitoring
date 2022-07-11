<template>
  <div class="container mx-auto px-[15px] mb-[100px]">
    <app-page-title
      title="Автомобілі"
    ></app-page-title>

    <div v-if="loader" class="flex items-center justify-center mt-10">
      <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
    </div>

    <div v-else class="text-gray-700">
      <div v-if="loadedCars.length">
        <div class="mb-[10px] flex flex-col sm:flex-row">
          <div class="mt-[10px] mr-[20px]">
            <div class="form-label">Сортування:</div>
            <select class="form-input" name="sortingBy" v-model="carMonitoringSortBy">
              <option class="pl-[20px] relative" :value="null">Немає</option>
              <option class="pl-[20px] relative" value="number">За номером автомобіля</option>
              <option value="postAsc">За номером посту, 1-9</option>
              <option value="postDesc">За номером посту, 9-1</option>
            </select>
          </div>

          <div class="flex">
            <div class="mt-[10px] mr-[20px]">
              <div class="form-label">Час:</div>
              <select class="form-input" name="sortingBy" v-model="carMonitoringSortDate">
                <option value="ASC">За збільшенням</option>
                <option value="DESC">За зменшенням</option>
              </select>
            </div>

            <div class="mt-[10px] mr-[20px]">
              <div class="form-label">Кількість</div>
              <select class="form-input" name="sortingBy" v-model="carMonitoringPerPage" @change="changeCarMonitoringPerPage">
                <option class="pl-[20px] relative" value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
              </select>
            </div>
          </div>

        </div>


        <table class="hidden lg:table min-w-full leading-normal">
          <thead>
          <tr>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase relative">
              Номер
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Тип
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Марка
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Модель
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Колір
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Адреса
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Дата та час
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
            </th>

          </tr>
          </thead>
          <tbody v-for="(c, idx) in loadedCars" :key="c.id" class="bg-white">
          <tr>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.number }}</p>
                </div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="mx-auto h-[45px] w-[75px]">
                  <img class="h-[45px] w-[75px]" :src="'../../../images/' + c.type + '.png'" alt="">
                  <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.type }}</p>-->
                </div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.brand }}</p>
                </div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.model }}</p>
                </div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="mx-auto h-[45px] w-[45px]">
                  <img class="h-[45px] w-[45px]" :src="'../../../images/color/' + c.color + '.png'" alt="">
                  <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.color }}</p>-->
                </div>
            </td>
            <td  class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div v-if="c.post" class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">Пост №{{ c.post }}. {{c.direction}}</p>
                </div>
              <div v-if="c.address" class="text-center mr-[10px]">
                <p class="text-gray-900 whitespace-no-wrap">{{ c.address }}</p>
              </div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ getDate(c.created_at) }}</p>
                </div>
            </td>
            <td v-if="userIsCounterIntelligence" class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-center mr-[10px] flex justify-between">
                  <button class="mr-[20px]" @click="showAddCarToDailySummaryModal = true">
                    <unicon name="plus" fill="#7DC273" width="20" height="20"/>
                  </button>
                  <button class="mr-[10px]" @click="getUserWhoAddedCar(idx)">
                    <unicon name="user" fill="black" width="17" height="17"/>
                  </button>
                </div>
            </td>

          </tr>
          <tr v-if="c.comment">

            <td colspan="8" class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-left mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.comment }}</p>
                </div>
            </td>
          </tr>
          <tr v-if="showUser === idx">

            <td colspan="8" class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
                <div class="text-left mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.user.name }} {{ c.user.surname }} тел.: {{ c.user.phone }}</p>
                </div>
            </td>
          </tr>

          </tbody>
        </table>

        <div class="lg:hidden min-w-full leading-normal">

          <div class="mb-[10px] text-[14px]" v-for="(c, idx) in loadedCars" :key="c.id">
            <div>
              <div class="flex justify-between bg-gray-100">
                <div class="text-center mr-[20px] bg-gray-100">
                  <p class="text-gray-900 font-semibold whitespace-no-wrap pl-[10px]">{{ c.number }}</p>
                </div>

                <div v-if="userIsCounterIntelligence">
                  <button class="mr-[20px]" @click="showModal(c)">
                    <unicon name="plus" fill="#7DC273" width="20" height="20"/>
                  </button>
                  <button class="mr-[10px]" @click="getUserWhoAddedCar(idx)">
                    <unicon name="user" fill="black" width="17" height="17"/>
                  </button>
                </div>

                <div class="text-center mr-[10px] bg-gray-100">
                  <p class="text-gray-900 whitespace-no-wrap">{{ getDate(c.created_at) }}</p>
                </div>
              </div>

              <div class="flex justify-between items-center">

                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.brand }}</p>
                </div>

                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.model }}</p>
                </div>

                <div class="text-center mr-[10px]">
                  <img class="h-[45px] w-[80px]" :src="'../../../images/' + c.type + '.png'" alt="">
                  <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.type }}</p>-->
                </div>

                <div class="text-center mr-[10px]">
                  <img class="h-[45px] w-[45px]" :src="'../../../images/color/' + c.color + '.png'" alt="">
                  <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.color }}</p>-->
                </div>

              </div>


              <div v-if="c.post" class="flex my-[5px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">Пост №{{ c.post }}</p>
                </div>

                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.direction }}</p>
                </div>
              </div>
              <div v-if="c.address" class="flex my-[5px]">
                <div class="text-center mr-[10px]">
                  <p class="text-gray-900 whitespace-no-wrap">Адрес: {{ c.address }}</p>
                </div>
              </div>

              <div v-if="c.comment">
                <div class="">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.comment }}</p>
                </div>
              </div>
              <div v-if="showUser === idx">
                <div class="">
                  <p class="text-gray-900 whitespace-no-wrap">{{ c.user.name }} {{ c.user.surname }} тел.: {{ c.user.phone }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <app-pagination
            v-if="paginateData.total > carMonitoringPerPage"
            :paginateData="paginateData"
            :links="links"
            :pageSelectionLinks="pageSelectionLinks"
            :pageSelectionLinkActive="pageSelectionLinkActive"
          ></app-pagination>
        </div>
      </div>
      <div v-else class="mt-[10px]">
        <p>За данними параметрами пошуку не знайдено жодного автомобіля.</p>
      </div>
    </div>

    <teleport to="#modal">
      <add-car-to-daily-summary-modal
        v-if="showAddCarToDailySummaryModal"
        modalTitle="Додати автомобіль на головну?"
        :car="addedCar"
        :errors="errors"
        @close="closeModal"
        @add="addCarToDailySummary"

      ></add-car-to-daily-summary-modal>
    </teleport>

  </div>
</template>

<script>
import axios from "axios";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import AppPagination from "../../components/app/AppPagination";
import AppPageTitle from "../../components/app/AppPageTitle";
import getDate from "../../partials/getDate";
import AddCarToDailySummaryModal from "../../components/modals/AddCarToDailySummaryModal";

export default {
  name: "MonitoringResult",
  props: {
    user: {
      type: Object,
      required: false
    },
  },
  data() {
    return {
      loader: false,
      carMonitoringNumber: null,
      carMonitoringStartDate: null,
      carMonitoringEndDate: null,
      carMonitoringPost: null,

      carMonitoringOrderBy: null,
      carMonitoringDirection: null,
      carMonitoringSortBy: null,

      carMonitoringSortDate: 'DESC',
      carMonitoringPerPage: 10,

      loadedCars: [],
      paginateData: {},
      links: [],
      pageSelectionLinks: [],
      pageSelectionLinkActive: null,

      showUser: false,
      showAddCarToDailySummaryModal: false,
      addedCar: {},
      errors: null,
    }
  },
  methods: {
    getMonitoringResult() {
      this.loader = true

      let params = {
        carMonitoringNumber: this.carMonitoringNumber,
        carMonitoringStartDate: this.carMonitoringStartDate,
        carMonitoringEndDate: this.carMonitoringEndDate,
        carMonitoringPost: this.carMonitoringPost,
        carMonitoringOrderBy: this.carMonitoringOrderBy,
        carMonitoringDirection: this.carMonitoringDirection,
        carMonitoringPerPage: this.carMonitoringPerPage,
        carMonitoringSortDate: this.carMonitoringSortDate,
      }

      let page = location.search.split('page=')[1]
      return new Promise((res, rej) => {
        axios.get(`/monitoring/search/p?page=${page}`, {params})
          .then(response => {
            this.loadedCars = response.data.cars.data

            this.paginateData = response.data.cars
            this.pageSelectionLinks = response.data.cars.links.slice(1, -1)
            this.pageSelectionLinkActive = this.pageSelectionLinks.find(c => c.active === true).url

            if (response.data.cars.links.length <= 6) {
              this.links = response.data.cars.links.slice(1, -1)
            } else if (response.data.cars.current_page < 4) {
              this.links = response.data.cars.links.slice(1, -1).slice(0, 5)
            } else {
              if (response.data.cars.last_page - response.data.cars.current_page <= 2) {
                this.links = response.data.cars.links.slice(1, -1).slice(response.data.cars.last_page - 5, response.data.cars.last_page)
              } else {
                this.links = response.data.cars.links.slice(1, -1).slice(response.data.cars.current_page - 2, response.data.cars.current_page + 3)
              }

            }
            this.loader = false

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    showModal(car) {
      this.addedCar = car
      this.showAddCarToDailySummaryModal = true
    },
    addCarToDailySummary(car) {

      return new Promise((res, rej) => {
        axios.post('/add-car-to-daily-summary', car)
          .then(response => {
            this.showAddCarToDailySummaryModal = false
            console.log(response)
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors
              console.log(this.errors)
            } else {
              console.log(rej(err))
            }
          })
      })
    },
    closeModal() {
      this.showAddCarToDailySummaryModal = false
    },
    changeCarMonitoringPerPage() {
      localStorage.setItem("carMonitoringPerPage", JSON.stringify(this.carMonitoringPerPage));
      document.location.href = '/monitoring/search'
    },
    getUserWhoAddedCar(idx) {
      if (this.showUser === false) {
        this.showUser = idx
      } else {
        this.showUser = false
      }
    }

  },
  computed: {
    userIsCounterIntelligence() {
      if (this.user) {
        let check = this.user.roles.find(role => role.slug === 'counterIntelligence')
        if (check) {
          return true
        }
        return false
      }
    },
  },
  created() {

    if (JSON.parse(localStorage.getItem("carMonitoringNumber"))) {
      this.carMonitoringNumber = JSON.parse(localStorage.getItem("carMonitoringNumber"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringStartDate"))) {
      this.carMonitoringStartDate = JSON.parse(localStorage.getItem("carMonitoringStartDate"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringEndDate"))) {
      this.carMonitoringEndDate = JSON.parse(localStorage.getItem("carMonitoringEndDate"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringPost"))) {
      this.carMonitoringPost = JSON.parse(localStorage.getItem("carMonitoringPost"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringOrderBy"))) {
      this.carMonitoringOrderBy = JSON.parse(localStorage.getItem("carMonitoringOrderBy"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringDirection"))) {
      this.carMonitoringDirection = JSON.parse(localStorage.getItem("carMonitoringDirection"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringSortBy"))) {
      this.carMonitoringSortBy = JSON.parse(localStorage.getItem("carMonitoringSortBy"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringSortDate"))) {
      this.carMonitoringSortDate = JSON.parse(localStorage.getItem("carMonitoringSortDate"))
    }

    if (JSON.parse(localStorage.getItem("carMonitoringPerPage"))) {
      this.carMonitoringPerPage = JSON.parse(localStorage.getItem("carMonitoringPerPage"))
    }

  },
  mounted() {
    this.getMonitoringResult()
  },
  watch: {
    carMonitoringSortBy() {
      if (this.carMonitoringSortBy === null) {
        this.carMonitoringOrderBy = null
        this.carMonitoringDirection = null
      }
      if (this.carMonitoringSortBy === 'number') {
        this.carMonitoringOrderBy = 'number'
        this.carMonitoringDirection = 'ASC'
      }
      if (this.carMonitoringSortBy === 'postAsc') {
        this.carMonitoringOrderBy = 'post'
        this.carMonitoringDirection = 'ASC'
      }
      if (this.carMonitoringSortBy === 'postDesc') {
        this.carMonitoringOrderBy = 'post'
        this.carMonitoringDirection = 'DESC'
      }
      localStorage.setItem("carMonitoringOrderBy", JSON.stringify(this.carMonitoringOrderBy));
      localStorage.setItem("carMonitoringDirection", JSON.stringify(this.carMonitoringDirection));
      localStorage.setItem("carMonitoringSortBy", JSON.stringify(this.carMonitoringSortBy));
      this.getMonitoringResult()

    },
    carMonitoringSortDate() {
      localStorage.setItem("carMonitoringSortDate", JSON.stringify(this.carMonitoringSortDate));
      this.getMonitoringResult()
    }
  },
  components: {
    AppPagination,
    MoonLoader,
    AppPageTitle,
    AddCarToDailySummaryModal
  },
  mixins: [getDate]
}
</script>

<style scoped>

</style>