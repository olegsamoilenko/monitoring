<template>
  <div class="container px-[15px] mx-auto mb-[100px]">

    <app-page-title
      title="Повна інформация / Редагувати користувача"
    ></app-page-title>

    <div v-if="loader" class="flex items-center justify-center mt-10">
      <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
    </div>

    <div v-else class="text-gray-700">

      <form class="relative" @submit.prevent="updateUser">
        <table class="leading-normal">
          <tbody class="bg-white">
          <tr>
            <td class="py-2 pr-[15px]">
              <div class="text-left">
                <p class="text-gray-900 whitespace-no-wrap">Ім'я:</p>
              </div>
            </td>
            <td class="px-1 py-2">
              {{ user.name }}
            </td>
          </tr>
          <tr>
            <td class="py-2 pr-[15px]">
              <div class="text-left">
                <p class="text-gray-900 whitespace-no-wrap">Прізвище:</p>
              </div>
            </td>
            <td class="px-1 py-2">
              {{ user.surname }}
            </td>
          </tr>
          <tr>
            <td class="py-2 pr-[15px]">
              <div class="text-left">
                <p class="text-gray-900 whitespace-no-wrap">Телефон:</p>
              </div>
            </td>
            <td class="px-1 py-2">
              {{ user.phone }}
            </td>
          </tr>
          <tr>
            <td class="py-2 pr-[15px]">
              <div class="text-left">
                <p class="text-gray-900 whitespace-no-wrap">Email:</p>
              </div>
            </td>
            <td class="px-1 py-2 text-[14px]">
              {{ user.email }}
            </td>
          </tr>
          </tbody>
        </table>

        <div class="mt-[10px] mr-[20px]">
          <div class="form-label">Активація:</div>
          <select class="form-input" name="activationStatus" v-model="user.activated">
            <option :value="1">Активований</option>
            <option :value="0">Не Активований</option>
          </select>
        </div>

        <div class="mt-[10px] mr-[20px]">
          <div class="form-label">Роль:</div>
          <select class="form-input" name="userRoles" v-model="userRoles" multiple>
            <option value="0">Немає ролі</option>
            <option v-for="r in roles" :key="r.id" :value="r.id">{{ r.name }}</option>
          </select>
        </div>


        <div class="flex justify-between items-center py-3">
          <button type="submit" class="btn-admin">
            Оновити користувача
          </button>
        </div>
      </form>

      <teleport to="#modal">
        <modal-loader
          v-if="showModalLoader"
          :loader="showModalLoader"
          @close="redirectToUsers"
        ></modal-loader>
      </teleport>

      <teleport to="#modal">
        <confirmation-modal
          v-if="showUserUpdateConfirmationModal"
          confirmationTitle="Ви успішно відредагували користувача"
          buttonTitle="Ок"
          @close="redirectToUsers"
        ></confirmation-modal>
      </teleport>

    </div>
  </div>
</template>

<script>
import AppInput from "../../../components/app/AppInput";
import axios from "axios";
import AppPageTitle from "../../../components/app/AppPageTitle";
import ConfirmationModal from "../../../components/modals/ConfirmationModal";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';

import ModalLoader from "../../../components/modals/ModalLoader";

export default {
  name: "EditUserAdmin",
  props: {
    user: {
      type: Object,
    }
  },
  data() {
    return {
      loader: false,
      showModalLoader: false,

      showUserUpdateConfirmationModal: false,
      roles: [],
      userRoles: [],
    }
  },
  methods: {
    updateUser() {
      this.showModalLoader = true
      const formData = {
        '_method': 'put',
        'activated': this.user.activated,
        'userRoles': this.userRoles
      }

      return new Promise((res, rej) => {
        axios.post(`/admin/users/${this.user.id}`, formData)
          .then(response => {
            this.showModalLoader = false
            this.showUserUpdateConfirmationModal = true
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },
    getRoles() {
      this.loader = true
      return new Promise((res, rej) => {
        axios.get('/admin/get-roles')
          .then(response => {
            this.roles = response.data.roles;
            this.loader = false
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
    getUserRoles() {
      if (this.user.roles.length) {
        this.user.roles.forEach(r => {
          this.userRoles.push(r.id)
        })
      } else {
        this.userRoles = [0]
      }
    },
    redirectToUsers() {
      document.location.href = '/admin/users'
    }
  },
  watch: {},
  created() {
    this.getRoles()
  },
  mounted() {
    this.getUserRoles()
  },
  components: {
    AppInput,
    AppPageTitle,
    ConfirmationModal,
    MoonLoader,
    ModalLoader
  }
}
</script>

<style scoped>

</style>