<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
    <div class="mb-[20px]">Виберіть необхідні Вам шеврони</div>

    <form @submit.prevent="add">
      <div class="relative mb-[10px]" v-for="c in choiceChevrons">

        <input class="absolute top-0 left-0 w-[40px] h-[40px] inline-block" type="checkbox" :id="choiceChevrons[c.id-1].number" :value="choiceChevrons[c.id-1].number" v-model="choiceChevrons[c.id-1].choice">
        <div class="ml-[60px] mb-[10px]"><img class=" w-[145px] h-[145px]" :src="'../../../images/chevron/' + choiceChevrons[c.id-1].number + '.jpg'" alt=""></div>
        <div>Кількість</div>
        <input class="mb-[10px]" type="number" v-model="choiceChevrons[c.id-1].amount">
        <hr>
      </div>

      <div>
        <div class="mb-[20px]">Введіть прізвище</div>
        <input type="text" v-model="surname">
        <span class="form-error block mt-[10px]" v-if="errors.surname">{{ errors.surname[0] }}</span>
      </div>


      <button class="btn" type="submit">Замовити</button>
    </form>


  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Chevrons",
  props: {
    chevrons: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      surname: null,
      selectedChevrons: [],
      choiceChevrons: [],
      errors: {},
    }
  },
  methods: {
    add() {
      this.selectedChevrons = []
      let selectedChevrons = this.choiceChevrons.filter(c => c.choice === true)
      for (let selectedChevron of selectedChevrons) {
        this.selectedChevrons.push({surname: this.surname, chevron_id: selectedChevron.id, amount: selectedChevron.amount})
      }
      this.selectedChevrons.forEach(chevron => {
        return new Promise((res, rej) => {
          axios.post('/add-chevron', chevron)
            .then(response => {
              console.log(response)
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
      })


    }
  },
  mounted() {
    for (let choiceChevron of this.chevrons) {
      this.choiceChevrons.push({amount: 1, ...choiceChevron})
    }
  },
}
</script>

<style scoped>

</style>