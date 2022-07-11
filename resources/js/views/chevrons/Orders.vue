<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
<!--    <button class="btn-admin mb-[20px]" @click="all = !all">Все</button>-->
<!--    <div v-if="all" class="">-->
<!--      <div class="mt-[10px] mr-[20px] mb-[20px]">-->
<!--        <div class="form-label">Сортування:</div>-->
<!--        <select class="form-input" name="sortingBy" v-model="chevronOrdersSortBy">-->
<!--          <option class="pl-[20px] relative" :value="null">Немає</option>-->
<!--          <option class="pl-[20px] relative" value="chevron">За шевроном</option>-->
<!--          <option value="surnameAsc">За прізвищем, А-Я</option>-->
<!--          <option value="surnameDesc">За прізвищем, Я-А</option>-->
<!--        </select>-->
<!--      </div>-->
<!--      <div class="relative mb-[10px] flex" v-for="c in chevronOrders">-->
<!--        <span class="mr-[20px] mb-[10px]"><img class=" w-[145px] h-[145px]" :src="'../../../images/chevron/' + c.chevron_id + '.jpg'" alt=""></span>-->

<!--        <span class="mr-[20px]">{{c.amount}}</span>-->
<!--        <span>{{c.surname}}</span>-->
<!--        <hr>-->
<!--      </div>-->
<!--    </div>-->

    <button class="btn-admin mb-[20px]" @click="chevrons = !chevrons">Шеврони</button>
    <div v-if="chevrons">
      <div class="relative mb-[10px] flex" v-for="c in sortedChevronsByAmount">
        <span class="mr-[20px] mb-[10px]"><img class=" w-[145px] h-[145px]" :src="'../../../images/chevron/' + c.chevron_id + '.jpg'" alt=""></span>

        <span class="mr-[20px]">{{c.total_amount}}</span>
        <hr>
      </div>
    </div>

    <button class="btn-admin mb-[20px]" @click="bySurname = !bySurname">За Прізвищем</button>
    <div v-if="bySurname">
      <div class="relative mb-[10px] flex" v-for="c in orders">
        <span class="mr-[20px] mb-[10px]"><img class=" w-[145px] h-[145px]" :src="'../../../images/chevron/' + c.chevron_id + '.jpg'" alt=""></span>

        <span class="mr-[20px]">{{c.amount}}</span>
        <span>{{c.surname}}</span>
        <hr>
      </div>
    </div>


  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Orders",
  props: {
    chevronOrders: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      all: false,
      chevrons: false,
      bySurname: false,
      chevronOrdersSortBy: 'chevron',
      chevronOrdersOrderBy: 'number',
      chevronOrdersDirection: 'ASC',

      sortedChevronsByAmount: [],
      orders: [],
    }
  },
  methods: {
    getSortedChevronsByAmount() {
      return new Promise((res, rej) => {
        axios.get(`/get-sorted-chevrons-by-amount`)
          .then(response => {

            this.sortedChevronsByAmount = response.data.chevrons

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    getSortedChevronsBySurname() {
      return new Promise((res, rej) => {
        axios.get(`/get-sorted-chevrons-by-surname`)
          .then(response => {

            this.orders = response.data.orders

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    }

  },
  created() {

    if (JSON.parse(localStorage.getItem("chevronOrdersSortBy"))) {
      this.chevronOrdersSortBy = JSON.parse(localStorage.getItem("chevronOrdersSortBy"))
    }

    if (JSON.parse(localStorage.getItem("chevronOrdersOrderBy"))) {
      this.chevronOrdersOrderBy = JSON.parse(localStorage.getItem("chevronOrdersOrderBy"))
    }

    if (JSON.parse(localStorage.getItem("chevronOrdersDirection"))) {
      this.chevronOrdersDirection = JSON.parse(localStorage.getItem("chevronOrdersDirection"))
    }


  },
  mounted() {
    this.getSortedChevronsByAmount()
    this.getSortedChevronsBySurname()

  },
  watch: {
    chevronOrdersSortBy() {
      if (this.chevronOrdersSortBy === null) {
        this.chevronOrdersOrderBy = null
        this.chevronOrdersDirection = null
      }
      if (this.chevronOrdersSortBy === 'chevron') {
        this.chevronOrdersOrderBy = 'chevron_id'
        this.chevronOrdersDirection = 'ASC'
      }
      if (this.chevronOrdersSortBy === 'surnameAsc') {
        this.chevronOrdersOrderBy = 'surname'
        this.chevronOrdersDirection = 'ASC'
      }
      if (this.chevronOrdersSortBy === 'surnameDesc') {
        this.chevronOrdersOrderBy = 'surname'
        this.chevronOrdersDirection = 'DESC'
      }
      localStorage.setItem("chevronOrdersSortBy", JSON.stringify(this.chevronOrdersSortBy));
      localStorage.setItem("chevronOrdersOrderBy", JSON.stringify(this.chevronOrdersOrderBy));
      localStorage.setItem("chevronOrdersDirection", JSON.stringify(this.chevronOrdersDirection));

      // this.getMonitoringResult()

    },
  }
}
</script>

<style scoped>

</style>