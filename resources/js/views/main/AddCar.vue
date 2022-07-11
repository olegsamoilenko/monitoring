<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
    <span class="form-error" v-if="err.post">{{err.post}}</span>
    <app-page-title
      title="Додати автомобіль"
    ></app-page-title>
    <div>
        <form @submit.prevent="addCar">
        <label class="block mt-3.5">

          <span v-if="!errors.number" class="form-label">Введіть номер автомобіля українськими літерами без пробілів та інших знаків. Регистр значення не має. Наприклад ВІ1234ВІ, 12345ВІ, по1234по</span>
          <span class="form-error" v-if="errors.number">{{ errors.number[0] }}</span>
          <app-input
            type="text"
            name="number"
            :error="errors.number"
            v-model="formData.number"
            placeholder="Введіть номер автомобіля"
          ></app-input>
        </label>
        <div class="prod_checbox mt-4">
          <span v-if="!errors.type" class="form-label">Виберіть тип автомобіля</span>
          <span class="form-error" v-if="errors.type">{{ errors.type[0] }}</span>
          <div class="radio-toolbar mt-[15px]">
            <input v-model="formData.type" type="radio" id="moto" name="car_type" value="moto">
            <label for="moto"><img class="w-[70px]" src="../../../images/moto.png" alt="moto"></label>

            <input v-model="formData.type" type="radio" id="micro" name="car_type" value="micro">
            <label for="micro"><img class="w-[60px]" src="../../../images/micro.png" alt="micro"></label>

            <input v-model="formData.type" type="radio" id="sedan" name="car_type" value="sedan">
            <label for="sedan"><img class="w-[80px]" src="../../../images/sedan.png" alt="sedan"></label>

            <input v-model="formData.type" type="radio" id="hatchback" name="car_type" value="hatchback">
            <label for="hatchback"><img class="w-[70px]" src="../../../images/hatchback.png" alt="hatchback"></label>

            <input v-model="formData.type" type="radio" id="coupe" name="car_type" value="coupe">
            <label for="coupe"><img class="w-[70px]" src="../../../images/coupe.png" alt="coupe"></label>

            <input v-model="formData.type" type="radio" id="wagon" name="car_type" value="wagon">
            <label for="wagon"><img class="w-[70px]" src="../../../images/wagon.png" alt="wagon"></label>

            <input v-model="formData.type" type="radio" id="cuv" name="car_type" value="cuv">
            <label for="cuv"><img class="w-[70px]" src="../../../images/cuv.png" alt="cuv"></label>

            <input v-model="formData.type" type="radio" id="suv" name="car_type" value="suv">
            <label for="suv"><img class="w-[70px]" src="../../../images/suv.png" alt="suv"></label>

            <input v-model="formData.type" type="radio" id="pickup" name="car_type" value="pickup">
            <label for="pickup"><img class="w-[70px]" src="../../../images/pickup.png" alt="pickup"></label>

            <input v-model="formData.type" type="radio" id="minivan" name="car_type" value="minivan">
            <label for="minivan"><img class="w-[70px]" src="../../../images/minivan.png" alt="minivan"></label>

            <input v-model="formData.type" type="radio" id="van_1" name="car_type" value="van_1">
            <label for="van_1"><img class="w-[70px]" src="../../../images/van_1.png" alt="van_1"></label>

            <input v-model="formData.type" type="radio" id="van_2" name="car_type" value="van_2">
            <label for="van_2"><img class="w-[70px]" src="../../../images/van_2.png" alt="van_2"></label>

            <input v-model="formData.type" type="radio" id="bus" name="car_type" value="bus">
            <label for="bus"><img class="w-[70px]" src="../../../images/bus.png" alt="bus"></label>

            <input v-model="formData.type" type="radio" id="mini_truck" name="car_type" value="mini_truck">
            <label for="mini_truck"><img class="w-[70px]" src="../../../images/mini_truck.png" alt="mini_truck"></label>

            <input v-model="formData.type" type="radio" id="truck" name="car_type" value="truck">
            <label for="truck"><img class="w-[70px]" src="../../../images/truck.png" alt="truck"></label>

            <input v-model="formData.type" type="radio" id="cabriolet" name="car_type" value="cabriolet">
            <label for="cabriolet"><img class="w-[70px]" src="../../../images/cabriolet.png" alt="cabriolet"></label>

            <input v-model="formData.type" type="radio" id="sport" name="car_type" value="sport">
            <label for="sport"><img class="w-[70px]" src="../../../images/sport.png" alt="sport"></label>

            <input v-model="formData.type" type="radio" id="taxi" name="car_type" value="taxi">
            <label for="taxi"><img class="w-[70px]" src="../../../images/taxi.png" alt="taxi"></label>
          </div>
        </div>

        <div class="mt-[10px]">
          <div v-if="!errors.brand" class="form-label">Виберіть марку автомобіля</div>
          <span class="form-error block" v-if="errors.brand">{{ errors.brand[0] }}</span>
          <select class="form-input" :class="{ 'border-red-500': errors.brand }" name="carBrands" v-model="formData.brand">
            <option class="text-gray-700 text-14" :value="null">Виберіть марку автомобіля</option>
            <option
              v-for="c in carBrands"
              :key="c.id"
              :value="c.title"
            >{{ c.title }}
            </option>
          </select>
        </div>
        <label class="block mt-3.5">
          <span class="form-label">Введіть модель автомобіля</span>
          <app-input
            type="text"
            name="carModel"
            v-model="formData.model"
            placeholder="Введіть модель автомобіля"
          ></app-input>
        </label>
        <div class="prod_checbox mt-4">
          <span v-if="!errors.color" class="form-label">Виберіть колір автомобіля</span>
          <span class="form-error block" v-if="errors.color">{{ errors.color[0] }}</span>
          <div class="radio-toolbar mt-[15px]">
            <input v-model="formData.color" type="radio" id="white" name="car_color" value="white">
            <label for="white"><img class="w-[70px]" src="../../../images/color/white.png" alt="white"></label>

            <input v-model="formData.color" type="radio" id="silver" name="car_color" value="silver">
            <label for="silver"><img class="w-[70px]" src="../../../images/color/silver.png" alt="silver"></label>

            <input v-model="formData.color" type="radio" id="gray" name="car_color" value="gray">
            <label for="gray"><img class="w-[70px]" src="../../../images/color/gray.png" alt="gray"></label>

            <input v-model="formData.color" type="radio" id="beige" name="car_color" value="beige">
            <label for="beige"><img class="w-[70px]" src="../../../images/color/beige.png" alt="beige"></label>

            <input v-model="formData.color" type="radio" id="olive" name="car_color" value="olive">
            <label for="olive"><img class="w-[70px]" src="../../../images/color/olive.png" alt="olive"></label>

            <input v-model="formData.color" type="radio" id="green" name="car_color" value="green">
            <label for="green"><img class="w-[70px]" src="../../../images/color/green.png" alt="green"></label>

            <input v-model="formData.color" type="radio" id="dark_green" name="car_color" value="dark_green">
            <label for="dark_green"><img class="w-[70px]" src="../../../images/color/dark_green.png" alt="dark_green"></label>

            <input v-model="formData.color" type="radio" id="light_blue" name="car_color" value="light_blue">
            <label for="light_blue"><img class="w-[70px]" src="../../../images/color/light_blue.png" alt="light_blue"></label>

            <input v-model="formData.color" type="radio" id="blue" name="car_color" value="blue">
            <label for="blue"><img class="w-[70px]" src="../../../images/color/blue.png" alt="blue"></label>

            <input v-model="formData.color" type="radio" id="dark_blue" name="car_color" value="dark_blue">
            <label for="dark_blue"><img class="w-[70px]" src="../../../images/color/dark_blue.png" alt="dark_blue"></label>

            <input v-model="formData.color" type="radio" id="red" name="car_color" value="red">
            <label for="red"><img class="w-[70px]" src="../../../images/color/red.png" alt="red"></label>

            <input v-model="formData.color" type="radio" id="cherry" name="car_color" value="cherry">
            <label for="cherry"><img class="w-[70px]" src="../../../images/color/cherry.png" alt="cherry"></label>

            <input v-model="formData.color" type="radio" id="dark_gray" name="car_color" value="dark_gray">
            <label for="dark_gray"><img class="w-[70px]" src="../../../images/color/dark_gray.png" alt="dark_gray"></label>

            <input v-model="formData.color" type="radio" id="black" name="car_color" value="black">
            <label for="black"><img class="w-[70px]" src="../../../images/color/black.png" alt="black"></label>

          </div>
        </div>
        <div class="mt-[10px]">
          <div class="form-label">Додайте свій коментар</div>
          <textarea class="form-input w-full mb-[10px]" name="orderComment" v-model="formData.comment" id="" cols="25" rows="3" placeholder="Додайте свій коментар"></textarea>
        </div>

        <span class="form-error" v-if="!isEmptyObject(errors) || !isEmptyObject(err)">Заповніть корректно форму</span>

        <app-button
          type="submit"
          title="Додати авто"
        ></app-button>
      </form>

<!--      <teleport to="#modal">-->
<!--        <confirmation-modal-->
<!--          v-if="showConfirmationModal"-->
<!--          confirmationTitle="Ви успішно додали автомобіль"-->
<!--          buttonTitle="Додати наступну"-->
<!--          @close="nextCar"-->
<!--        ></confirmation-modal>-->
<!--      </teleport>-->

      <teleport to="#modal">
        <modal-loader
          v-if="showModalLoader"
          :loader="showModalLoader"
        ></modal-loader>
      </teleport>

      <teleport to="#modal">
        <add-car-confirmation-modal
          v-if="showConfirmationModal"
          @close="nextCar"
        ></add-car-confirmation-modal>
      </teleport>

    </div>

  </div>
</template>

<script>
import ConfirmationModal from "../../components/modals/ConfirmationModal";
import AddCarConfirmationModal from "../../components/modals/AddCarConfirmationModal";
import AppInput from "../../components/app/AppInput";
import AppButton from "../../components/app/AppButton";
import carBrands from "../../partials/carBrands";
import axios from "axios";
import AppPageTitle from "../../components/app/AppPageTitle";
import ModalLoader from "../../components/modals/ModalLoader";
export default {
  name: "AddCar",
  props: {
    user_id: {
      type: Number,
      required: false
    }
  },
  data() {
    return {
      formData: {
        post: null,
        direction: null,
        address: null,
        number: null,
        type: null,
        brand: null,
        model: null,
        color: null,
        comment: null,
        user_id: this.user_id,
        created: new Date(),
      },
      showModalLoader: false,
      err: {},
      errors: {},
      showConfirmationModal: false,
    }
  },
  mounted() {
    if ( JSON.parse(localStorage.getItem("postAndDirection"))) {
      this.formData.post = JSON.parse(localStorage.getItem("postAndDirection")).post;
      this.formData.direction = JSON.parse(localStorage.getItem("postAndDirection")).direction;
    }
    if ( JSON.parse(localStorage.getItem("address"))) {
      this.formData.address = JSON.parse(localStorage.getItem("address")).address;
    }

  },
  methods: {
    addCar() {
      this.err = {}
      this.showModalLoader = true
      if (!this.formData.post && !this.formData.address) {
        this.showModalLoader = false
        this.err.post = 'Виберіть спочатку зверху номер посту та напрямок або введіть адресу'
        document.body.scrollTop = document.documentElement.scrollTop = 0;
      }
      if (this.isEmptyObject(this.err)) {
        let p = /[^a-zA-Zа-яієїґА-ЯІЄЇ0-9]+/g;
        if (this.formData.number) {
          this.formData.number = this.formData.number.toUpperCase().replace( /\s/g, "").replace( p, "")
        }

        return new Promise((res, rej) => {
          axios.post('/add-car', this.formData)
            .then(response => {
              this.showModalLoader = false
              this.showConfirmationModal = true
              this.carNumber = null
              this.formData.number = null
              this.formData.type = null
              this.formData.brand = null
              this.formData.model = null
              this.formData.color = null
              this.formData.comment = null
              this.formData.comment = null
              this.errors = {}
            })
            .catch(err => {
              this.showModalLoader = false
              if (err.response.status === 422) {
                this.errors = err.response.data.errors
              } else {
                console.log(rej(err))
              }
            })
        })
      }

    },
    nextCar() {
      this.showConfirmationModal = false
      document.body.scrollTop = document.documentElement.scrollTop = 0;
    },

    isEmptyObject(obj) {
      for (let i in obj) {
        if (obj.hasOwnProperty(i)) {
          return false;
        }
      }
      return true;
    },
  },

  computed: {
  },
  components: {
    AppInput,
    AppButton,
    ConfirmationModal,
    AppPageTitle,
    AddCarConfirmationModal,
    ModalLoader
  },
  mixins: [carBrands]
}
</script>

<style scoped>

</style>