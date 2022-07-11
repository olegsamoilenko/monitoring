<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <div class="flex justify-between bg-gray-100 mt-[20px]">
        <div class="text-center mr-[20px] bg-gray-100">
          <p class="text-gray-900 font-semibold whitespace-no-wrap pl-[10px]">{{ car.number }}</p>
        </div>
        <div class="text-center mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ car.brand }}</p>
        </div>
      </div>
      <div v-if="errors">
        <div class="form-error" v-if="errors.number">{{ errors.number[0] }}</div>
      </div>

      <div class="flex justify-between items-center mt-[10px] mb-[20px]">
                <div class="text-center mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ car.model }}</p>
        </div>

        <div class="text-center  mr-[10px]">
          <img class="h-[45px] w-[80px] mx-auto" :src="'../../../images/' + car.type + '.png'" alt="">
          <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.type }}</p>-->
        </div>

        <div class="text-center mr-[10px]">
          <img class="h-[45px] w-[45px] mx-auto" :src="'../../../images/color/' + car.color + '.png'" alt="">
          <!--              <p class="text-gray-900 whitespace-no-wrap">{{ c.color }}</p>-->
        </div>
      </div>

        <div class="form-label">Додати коментар</div>
      <textarea class="w-full" name="comment" id="comment" rows="4" v-model="comment"></textarea>
      <div v-if="errors">
              <div class="form-error" v-if="errors.comment">{{ errors.comment[0] }}</div>
      </div>


      <div class="flex justify-between items-center py-3">
        <a @click="$emit('close')" type="submit" class="btn-admin mr-[10px] cursor-pointer">Відміна</a>
        <a @click="add" type="submit" class="btn-admin cursor-pointer">Додати</a>
      </div>

    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppInput from "../app/AppInput";
export default {
  name: "AddCarToDailySummaryModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    car: {
      type: Object,
      required: true,
    },
    errors: {
      type: Object,
      default: {}
    }
  },
  emits: ['close', 'add'],
  data() {
    return {
      comment: null
    }
  },
  methods: {
    add() {
      let carData = {
        number: this.car.number,
        type: this.car.type,
        brand: this.car.brand,
        model: this.car.model,
        color: this.car.color,
        comment: this.comment
      }
      this.$emit('add', carData)
    }
  },
  components: {
    BaseModal,
    AppInput
  }
}
</script>

<style scoped>

</style>