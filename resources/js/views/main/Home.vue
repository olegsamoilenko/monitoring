<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
    <div class="flex justify-between mb-[10px]">
      <h1><b>Оперативна ситуація</b> на {{ getDate(dailySummary.updated_at) }}</h1>
      <button v-if="userIsCounterIntelligence" class="mr-[10px]" @click="editDailySummary(dailySummary.id)">
        <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>
      </button>
    </div>
    <div class="mb-[10px]">
      <p class="whitespace-pre-line" v-html="dailySummary.text"></p>
    </div>
    <h1 class="mb-[20px]"><b>Відслідковувати переміщення:</b></h1>

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
        </th>

      </tr>
      </thead>
      <tbody v-for="c in dailySummaryCars" :key="c.id" class="bg-white">
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
        <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
          <div v-if="userIsCounterIntelligence" class="text-center">
            <button @click="del(c)">
              <unicon name="trash-alt" fill="red" width="20" height="20"/>
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

      </tbody>
    </table>

    <div class="lg:hidden min-w-full leading-normal">

      <div class="mb-[10px] text-[14px]" v-for="c in dailySummaryCars" :key="c.id">
        <div>
          <div class="flex justify-between bg-gray-100 mb-[10px]">
            <div class="text-center mr-[20px] bg-gray-100">
              <p class="text-gray-900 font-semibold whitespace-no-wrap pl-[10px]">{{ c.number }}</p>
            </div>
            <div v-if="userIsCounterIntelligence" class="mr-[20px]">
              <button @click="del(c)">
                <unicon name="trash-alt" fill="red" width="20" height="20"/>
              </button>
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


          <div v-if="c.comment">
            <div class="">
              <p class="text-gray-900 whitespace-no-wrap">{{ c.comment }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <teleport to="#modal">
      <car-pre-delete-confirmation-modal
        v-if="showCarPreDeleteConfirmationModal"
        title="Ви бажаете видалили автомобіль "
        :car="deleteCar"
        @close="closeModal"
        @del="delCar"
      ></car-pre-delete-confirmation-modal>
    </teleport>

  </div>


</template>

<script>
import getDate from "../../partials/getDate";
import axios from "axios";
import CarPreDeleteConfirmationModal from "../../components/modals/CarPreDeleteConfirmationModal";

export default {
  name: "home",
  props: {
    dailySummary: {
      type: Object,
      required: true
    },
    dailySummaryCars: {
      type: Array,
      required: false
    },
    user: {
      type: Object,
      required: false
    },
  },
  data() {
    return {
      showCarPreDeleteConfirmationModal: false,
      deleteCar: null,
    }
  },
  methods: {
    editDailySummary() {
      document.location.href = '/operational-situation/edit'
    },
    del(car) {
      this.deleteCar = car
      this.showCarPreDeleteConfirmationModal = true
    },
    closeModal() {
      this.showCarPreDeleteConfirmationModal = false
    },
    delCar(id) {
      return new Promise((res, rej) => {
        axios.delete(`/destroy-car-from-daily-summary/${id}`)
          .then(response => {
            this.showCarPreDeleteConfirmationModal = false
            location.reload();
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    }
  },
  mounted() {
    // console.log(this.dailySummaryCars)
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
  mixins: [getDate],
  components: {
    CarPreDeleteConfirmationModal
  }
}
</script>

<style scoped>

</style>