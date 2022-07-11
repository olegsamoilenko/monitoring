<template>
  <div class="container px-[15px] mx-auto mb-[100px] text-gray-700 text-16 font-montserrat">
    <h3 class="mt-[20px]">Редагувати пост № {{ post.number }}</h3>
    <form @submit.prevent="updatePost">

      <div class="form-label mt-3.5">Введіть напрямки. Наприклад: напрямок 1 - В Лубни, напрямок 2 - Із Лубнів.</div>
      <label class="block mt-2.5">
        <span class="form-label ">Введіть напрямок 1</span>
        <app-input
          type="text"
          name="direction_1"
          :error="errors.direction_1"
          v-model="post.direction_1"
          placeholder="Введіть напрямок 1"
        ></app-input>
        <span class="form-error" v-if="errors.direction_1">{{ errors.direction_1[0] }}</span>
      </label>

      <label class="block mt-3.5">
        <span class="form-label">Введіть напрямок 2</span>
        <app-input
          type="text"
          name="direction_2"
          :error="errors.direction_2"
          v-model="post.direction_2"
          placeholder="Введіть напрямок 2"
        ></app-input>
        <span class="form-error" v-if="errors.direction_2">{{ errors.direction_2[0] }}</span>
      </label>

      <label v-if="post.direction_3 ? direction3 = true : false" class="block mt-3.5">
        <span class="form-label">Введіть напрямок 3</span>
        <app-input
          type="text"
          name="direction_3"
          :error="errors.direction_3"
          v-model="post.direction_3"
          placeholder="Введіть напрямок 3"
        ></app-input>
        <span class="form-error" v-if="errors.direction_3">{{ errors.direction_3[0] }}</span>
      </label>

      <div v-if="!post.direction_3" class="mt-[10px]">
        <a class="text-[#2C31C2] text-14 cursor-pointer" v-if="!direction3" @click="addDirection3">+ Дотати ще
          напрямок</a>
        <label class="block mt-3.5" v-if="direction3">
          <span class="form-label">Введіть напрямок 3</span>
          <app-input
            type="text"
            name="direction_3"
            :error="errors.direction_3"
            v-model="post.direction_3"
            placeholder="Введіть напрямок 3"
          ></app-input>
          <span class="form-error" v-if="errors.direction_3">{{ errors.direction_3[0] }}</span>
        </label>
      </div>

      <label v-if="post.direction_4 ? direction4 = true : false" class="block mt-3.5">
        <span class="form-label">Введіть напрямок 4</span>
        <app-input
          type="text"
          name="direction_4"
          :error="errors.direction_4"
          v-model="post.direction_4"
          placeholder="Введіть напрямок 4"
        ></app-input>
        <span class="form-error" v-if="errors.direction_4">{{ errors.direction_4[0] }}</span>
      </label>

      <div v-if="!post.direction_4" class="mt-[10px]">
        <a class="text-[#2C31C2] text-14 cursor-pointer" v-if="direction3 && !direction4" @click="addDirection4">+
          Дотати ще напрямок</a>
        <label class="block mt-3.5" v-if="direction4">
          <span class="form-label">Введіть напрямок 4</span>
          <app-input
            type="text"
            name="direction_4"
            :error="errors.direction_4"
            v-model="post.direction_4"
            placeholder="Введіть напрямок 4"
          ></app-input>
          <span class="form-error" v-if="errors.direction_4">{{ errors.direction_4[0] }}</span>
        </label>
      </div>

      <label v-if="post.direction_5 ? direction5 = true : false" class="block mt-3.5">
        <span class="form-label">Введіть напрямок 5</span>
        <app-input
          type="text"
          name="direction_5"
          :error="errors.direction_5"
          v-model="post.direction_5"
          placeholder="Введіть напрямок 5"
        ></app-input>
        <span class="form-error" v-if="errors.direction_5">{{ errors.direction_5[0] }}</span>
      </label>

      <div v-if="!post.direction_5" class="mt-[10px]">
        <a class="text-[#2C31C2] text-14 cursor-pointer" v-if="direction4 && !direction5" @click="addDirection5">+
          Дотати ще напрямок</a>
        <label class="block mt-3.5" v-if="direction5">
          <span class="form-label">Введіть напрямок 5</span>
          <app-input
            type="text"
            name="direction_5"
            :error="errors.direction_5"
            v-model="post.direction_5"
            placeholder="Введіть напрямок 5"
          ></app-input>
          <span class="form-error" v-if="errors.direction_5">{{ errors.direction_5[0] }}</span>
        </label>
      </div>

      <div class="flex justify-between items-center py-3">
        <button type="submit" class="btn-admin">
          Оновити пост
        </button>
      </div>
    </form>

    <teleport to="#modal">
      <modal-loader
        v-if="showModalLoader"
        :loader="showModalLoader"
      ></modal-loader>
    </teleport>

    <teleport to="#modal">
      <confirmation-modal
        v-if="showConfirmationModal"
        confirmationTitle="Ви успішно відредагували пост"
        buttonTitle="Ок"
        @close="redirectToPosts"
      ></confirmation-modal>
    </teleport>

  </div>
</template>

<script>
import AppInput from "../../../components/app/AppInput";
import axios from "axios";
import ConfirmationModal from "../../../components/modals/ConfirmationModal";
import ModalLoader from "../../../components/modals/ModalLoader";
export default {
  name: "EditPostAdmin",
  data() {
    return {
      showModalLoader: false,
      direction3: false,
      direction4: false,
      direction5: false,
      errors: {},
      showConfirmationModal: false,
    }
  },
  props: {
    post: {
      type: Object,
    }
  },

  methods: {
    updatePost() {
      this.showModalLoader = true
      const formData = {'_method': 'put', ...this.post}

      return new Promise((res, rej) => {
        axios.post(`/admin/posts/${this.post.id}`, formData)
          .then(response => {
            this.showModalLoader = false
            this.showConfirmationModal = true
          })
          .catch(err => {
            if  (err.response.status === 422) {
              this.errors = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },
    redirectToPosts() {
      document.location.href = '/admin/posts'
    },
    addDirection3() {
      this.direction3 = true
    },

    addDirection4() {
      this.direction4 = true
    },

    addDirection5() {
      this.direction5 = true
    },
  },
  mounted() {
  },
  components: {
    AppInput,
    ConfirmationModal,
    ModalLoader
  }
}
</script>

<style scoped>

</style>