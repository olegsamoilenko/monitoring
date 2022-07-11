<template>
  <div class="container mx-auto px-[15px] mb-[100px]">

    <app-page-title
      title="Користувачі"
    ></app-page-title>

    <div v-if="loader" class="flex items-center justify-center mt-10">
      <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
    </div>

    <div v-else class="text-gray-700">
      <div class="mb-[10px] flex flex-col sm:flex-row">
        <div class="flex">
          <div class="mt-[10px] mr-[20px]">
            <div class="form-label">Сортування:</div>
            <select class="form-input" name="sortingBy" v-model="userSortBy">
              <option class="pl-[20px] relative" value="createdAt">Дата реєстрації</option>
              <option value="surnameAsc">Прізвище, А-Я</option>
              <option value="surnameDesc">Прізвище, Я-А</option>
            </select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <div class="form-label">Активація:</div>
            <select class="form-input" name="userActivationStatus" v-model="userActivationStatus">
              <option :value="null">Всі</option>
              <option :value="1">Активовані</option>
              <option :value="false">Не Активовані</option>
            </select>
          </div>
        </div>

        <div class="flex">
          <div class="mt-[10px] mr-[20px]">
            <div class="form-label">Роль:</div>
            <select class="form-input" name="userRole" v-model="userRole">
              <option :value="null">Всі</option>
              <option value="user">Користувач</option>
              <option value="admin">Адміністратор</option>
            </select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <div class="form-label">На сторінці</div>
            <select class="form-input" name="sortingBy" v-model="userPerPage">
              <option class="pl-[20px] relative" value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
          </div>

        </div>
      </div>

      <table class="min-w-full leading-normal">
        <thead>
        <tr>
          <th
            class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase relative">
            Користувачі
          </th>
          <th
            class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
            Редагувати
          </th>
        </tr>
        </thead>
        <tbody class="bg-white">
        <tr v-for="u in loadedUsers" :key="u.id">
          <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
            <div class="sm:flex">
              <div class="text-center mr-[10px]">
                <p class="text-gray-900 whitespace-no-wrap">{{ u.name }}</p>
              </div>
              <div class="text-center mr-[10px]">
                <p class="text-gray-900 whitespace-no-wrap">{{ u.surname }}</p>
              </div>
              <div class="text-center">
                <p class="text-gray-900 whitespace-no-wrap">Тел.: {{ u.phone }}</p>
              </div>
            </div>
          </td>

          <td
            class="flex-col flex sm:flex-row items-center justify-end px-5 py-2 border-b border-gray-200 bg-white text-center text-[14px]">
            <div class="mr-[0px] sm:mr-[30px] mb-[10px]">
              <div v-if="u.activated == 1" class="mr-[10px] btn-admin bg-inherit text-black">Активовано</div>
              <button v-if="u.activated == 0" class="btn-admin" @click="confirmActivate(u)">Активувати</button>
            </div>
            <div>
              <button class="mr-[10px]" @click="editUser(u.id)">
                <unicon name="eye" fill="#7DC273" width="20" height="20"/> /
                <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>

              </button>
              <button @click="del(u)">
                <unicon name="trash-alt" fill="red" width="20" height="20"/>
              </button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>

      <teleport to="#modal">
        <modal-loader
          v-if="showModalLoader"
          :loader="showModalLoader"
          @close="close"
        ></modal-loader>
      </teleport>

      <teleport to="#modal">
        <user-pre-activate-confirmation-modal
          v-if="showUserPreActivateConfirmationModal"
          title="Ви бажаете активувати користувача "
          :user="activeUser"
          @close="close"
          @activate="activate"
        ></user-pre-activate-confirmation-modal>
      </teleport>


      <teleport to="#modal">
        <confirmation-modal
          v-if="showUserActivateConfirmationModal"
          confirmationTitle="Ви успішно активували користувача"
          buttonTitle="Ок"
          @close="close"
        ></confirmation-modal>
      </teleport>

      <teleport to="#modal">
        <user-pre-delete-confirmation-modal
          v-if="showUserPreDeleteConfirmationModal"
          title="Ви бажаете видалили користувача "
          :user="activeUser"
          @close="close"
          @no="notDel"
          @del="delUser"
        ></user-pre-delete-confirmation-modal>
      </teleport>

      <teleport to="#modal">
        <confirmation-modal
          v-if="showUserDeleteConfirmationModal"
          confirmationTitle="Ви успішно видалили користувача"
          buttonTitle="Ок"
          @close="close"
        ></confirmation-modal>
      </teleport>

      <div>
        <app-pagination
          v-if="paginateData.total > userPerPage"
          :paginateData="paginateData"
          :links="links"
          :pageSelectionLinks="pageSelectionLinks"
          :pageSelectionLinkActive="pageSelectionLinkActive"
        ></app-pagination>
      </div>

    </div>
  </div>
</template>

<script>
import axios from "axios";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import AppPagination from "../../../components/app/AppPagination";
import UserPreActivateConfirmationModal from "../../../components/modals/UserPreActivateConfirmationModal";
import UserPreDeleteConfirmationModal from "../../../components/modals/UserPreDeleteConfirmationModal";
import AppPageTitle from "../../../components/app/AppPageTitle";
import ConfirmationModal from "../../../components/modals/ConfirmationModal";
import ModalLoader from "../../../components/modals/ModalLoader";

export default {
  name: "UsersAdmin",
  data() {
    return {
      loader: false,
      showModalLoader: false,

      userActivationStatus: null,
      userRole: null,

      userSortBy: 'createdAt',
      userOrderBy: 'created_at',
      userDirection: 'ASC',

      userPerPage: 10,

      loadedUsers: [],
      paginateData: {},
      links: [],
      pageSelectionLinks: [],
      pageSelectionLinkActive: null,
      activeUser: null,

      showUserPreActivateConfirmationModal: false,
      showUserActivateConfirmationModal: false,
      showUserPreDeleteConfirmationModal: false,
      showUserDeleteConfirmationModal: false,

    }
  },
  methods: {
    loadUsers() {
      this.loader = true
      let page = location.search.split('page=')[1]
      let params = {
        userOrderBy: this.userOrderBy,
        userDirection: this.userDirection,
        userActivationStatus: this.userActivationStatus,
        userRole: this.userRole,
        userPerPage: this.userPerPage,
      }

      return new Promise((res, rej) => {
        axios.get(`/admin/users/p?page=${page}`, {params})
          .then(response => {
            this.loadedUsers = response.data.users.data
            this.paginateData = response.data.users
            this.pageSelectionLinks = response.data.users.links.slice(1, -1)
            this.pageSelectionLinkActive = this.pageSelectionLinks.find(p => p.active === true).url

            if (response.data.users.links.length <= 6) {
              this.links = response.data.users.links.slice(1, -1)
            } else if (response.data.users.current_page < 4) {
              this.links = response.data.users.links.slice(1, -1).slice(0, 5)
            } else {
              if (response.data.users.last_page - response.data.users.current_page <= 2) {
                this.links = response.data.users.links.slice(1, -1).slice(response.data.users.last_page - 5, response.data.users.last_page)
              } else {
                this.links = response.data.users.links.slice(1, -1).slice(response.data.users.current_page - 2, response.data.users.current_page + 3)
              }

            }
            this.loader = false

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    confirmActivate(user) {
      this.activeUser = user
      this.showUserPreActivateConfirmationModal = true
    },

    activate(id) {
      this.showUserPreActivateConfirmationModal = false
      this.showModalLoader = true
      const formData = {'_method': 'put', 'activated': 1, 'userRoles': [1]}
      return new Promise((res, rej) => {
        axios.post(`/admin/users/${id}`, formData)
          .then(response => {
            this.showModalLoader = false
            this.showUserActivateConfirmationModal = true
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

    del(u) {
      this.activeUser = u
      this.showUserPreDeleteConfirmationModal = true
    },

    delUser(id) {
      return new Promise((res, rej) => {
        axios.delete(`/admin/users/${id}`)
          .then(response => {
            this.showUserDeleteConfirmationModal = true

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    editUser(id) {
      document.location.href = '/admin/users/' + id + '/edit'
    },

    notDel() {
      this.showUserPreDeleteConfirmationModal = false
    },

    close() {
      this.showUserPreActivateConfirmationModal = false
      this.showUserActivateConfirmationModal = false
      this.showUserPreDeleteConfirmationModal = false
      this.showUserDeleteConfirmationModal = false
      this.loadUsers()
    },

  },
  watch: {
    userActivationStatus() {
      this.loadUsers()
      localStorage.setItem("userActivationStatus", JSON.stringify(this.userActivationStatus));
    },
    userRole() {
      this.loadUsers()
      localStorage.setItem("userRole", JSON.stringify(this.userRole));
    },
    userPerPage() {
      this.loadUsers()
      localStorage.setItem("userPerPage", JSON.stringify(this.userPerPage));
    },

    userSortBy() {
      if (this.userSortBy === 'createdAt') {
        this.userOrderBy = 'created_at'
        this.userDirection = 'ASC'
      }
      if (this.userSortBy === 'surnameAsc') {
        this.userOrderBy = 'surname'
        this.userDirection = 'ASC'
      }
      if (this.userSortBy === 'surnameDesc') {
        this.userOrderBy = 'surname'
        this.userDirection = 'DESC'
      }
      localStorage.setItem("userSortBy", JSON.stringify(this.userSortBy));
      localStorage.setItem("userOrderBy", JSON.stringify(this.userOrderBy));
      localStorage.setItem("userDirection", JSON.stringify(this.userDirection));
      this.loadUsers()
    },


  },
  created() {
    if (localStorage.getItem("userActivationStatus")) {
      this.userActivationStatus = JSON.parse(localStorage.getItem("userActivationStatus"))
    }
    if (localStorage.getItem("userRole")) {
      this.userRole = JSON.parse(localStorage.getItem("userRole"))
    }
    if (localStorage.getItem("userPerPage")) {
      this.userPerPage = JSON.parse(localStorage.getItem("userPerPage"))
    }
    if (localStorage.getItem("userSortBy")) {
      this.userSortBy = JSON.parse(localStorage.getItem("userSortBy"))
    }
    if (localStorage.getItem("userOrderBy")) {
      this.userOrderBy = JSON.parse(localStorage.getItem("userOrderBy"))
    }
    if (localStorage.getItem("userDirection")) {
      this.userDirection = JSON.parse(localStorage.getItem("userDirection"))
    }

  },
  mounted() {
    this.loadUsers()
  },
  components: {
    MoonLoader,
    AppPagination,
    UserPreActivateConfirmationModal,
    UserPreDeleteConfirmationModal,
    AppPageTitle,
    ConfirmationModal,
    ModalLoader
  }
}
</script>

<style scoped>

</style>