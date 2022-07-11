<template>
  <div class="container px-[15px] mx-auto mb-[100px] text-gray-700 text-16 font-montserrat">
    <h3 class="mt-[20px]">Додати новий пост</h3>
    <form @submit.prevent="addPost">
      <label class="block mt-3.5">
        <span class="form-label">Введіть номер посту</span>
        <app-input
          type="text"
          name="number"
          :error="errors.number"
          v-model="post.number"
          placeholder="Введіть номер посту"
        ></app-input>
        <span class="form-error" v-if="errors.number">{{ errors.number[0] }}</span>
      </label>
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

      <div class="mt-[10px]">
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

      <div class="mt-[10px]">
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

      <div class="mt-[10px]">
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
          Додати пост
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
      <post-create-confirmation-modal
        v-if="showPostCreateConfirmationModal"
        title="Ви успішно додали пост"
        @close="redirectToPosts"
      ></post-create-confirmation-modal>
    </teleport>

  </div>

</template>

<script>
import PostCreateConfirmationModal from "../../../components/modals/PostCreateConfirmationModal";
import AppInput from "../../../components/app/AppInput";
import axios from "axios";
import ModalLoader from "../../../components/modals/ModalLoader";

export default {
  name: "CreatePostAdmin",

  data() {
    return {
      post: {
        number: null,
        direction_1: null,
        direction_2: null,
        direction_3: null,
        direction_4: null,
        direction_5: null,
      },
      showModalLoader: false,
      errors: {},
      direction3: false,
      direction4: false,
      direction5: false,
      showPostCreateConfirmationModal: false
    }
  },
  methods: {
    addPost() {
      this.showModalLoader = true
      return new Promise((res, rej) => {
        axios.post('/admin/posts/store', this.post)
          .then(response => {
            this.showModalLoader = false
            this.showPostCreateConfirmationModal = true
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors
              console.log(err.response.data.errors)
            } else {
              console.log(rej(err))
            }
          })
      })
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

    redirectToPosts() {
      document.location.href = '/admin/posts'
    }
  },

  components: {
    AppInput,
    PostCreateConfirmationModal,
    ModalLoader
  }
}
</script>

<style scoped>

</style>