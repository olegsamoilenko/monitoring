<template>
  <div class="container mx-auto px-[15px] mb-[100px]">

    <app-page-title
      title="Пости"
    ></app-page-title>

    <div v-if="loader" class="flex items-center justify-center mt-10">
      <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
    </div>

    <div v-else class="text-gray-700">

      <div class="my-[15px]">
        <a href="posts/create" class="btn-admin inline-block">Додати новий пост</a>
      </div>

      <div v-if="loadedPosts.length">
        <table class="min-w-full leading-normal">
          <thead>
          <tr>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase relative">
              Пост №
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-left text-[14px] font-semibold text-gray-600 uppercase relative">
              Напрямки
            </th>
            <th
              class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase  relative">
              Ред
            </th>
          </tr>
          </thead>
          <tbody class="bg-white">
          <tr v-for="p in loadedPosts" :key="p.id">
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-[14px]">
              <div class="text-center">
                <p class="text-gray-900 whitespace-no-wrap">{{ p.number }}</p>
              </div>
            </td>
            <td class="px-1 py-2 border-b border-gray-200 bg-white text-[14px]">
              <div v-if="p.direction_1">1. {{ p.direction_1 }}</div>
              <div v-if="p.direction_2">2. {{ p.direction_2 }}</div>
              <div v-if="p.direction_3">3. {{ p.direction_3 }}</div>
              <div v-if="p.direction_4">4. {{ p.direction_4 }}</div>
              <div v-if="p.direction_5">5. {{ p.direction_5 }}</div>
            </td>
            <td class="px-5 py-2 border-b border-gray-200 bg-white text-center text-[14px]">
              <button class="mr-[10px]" @click="editPost(p.id)">
                <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>
              </button>
              <button @click="del(p)">
                <unicon name="trash-alt" fill="red" width="20" height="20"/>
              </button>
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
          <post-pre-delete-confirmation-modal
            v-if="showPostPreDeleteConfirmationModal"
            title="Ви бажаете видалили пост № "
            :post="deletePost"
            @close="close"
            @no="notDel"
            @del="delPost"
          ></post-pre-delete-confirmation-modal>
        </teleport>

        <teleport to="#modal">
          <confirmation-modal
            v-if="showConfirmationModal"
            confirmationTitle="Ви успішно видалили пост"
            buttonTitle="Ок"
            @close="close"
          ></confirmation-modal>
        </teleport>


        <div>
          <app-pagination
            v-if="this.paginateData.total > postPerPage"
            :paginateData="paginateData"
            :links="links"
            :pageSelectionLinks="pageSelectionLinks"
            :pageSelectionLinkActive="pageSelectionLinkActive"
          ></app-pagination>
        </div>
      </div>

      <div v-else class="">
        <p>Постів у базі немає.
          <a class="text-green-500" href="posts/create">Додати перший пост</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import AppPageTitle from "../../../components/app/AppPageTitle";
import axios from "axios";
import PostPreDeleteConfirmationModal from "../../../components/modals/PostPreDeleteConfirmationModal";
import AppPagination from "../../../components/app/AppPagination";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js'
import ConfirmationModal from "../../../components/modals/ConfirmationModal";
import ModalLoader from "../../../components/modals/ModalLoader";

export default {
  name: "PostsAdmin",
  data() {
    return {
      loader: false,
      showModalLoader: false,
      showConfirmationModal: false,
      showPostPreDeleteConfirmationModal: false,
      loadedPosts: [],
      paginateData: {},
      links: [],
      pageSelectionLinks: [],
      pageSelectionLinkActive: null,
      postPerPage: 20,
      postOrderBy: 'number',
      postDirection: 'ASC',
      deletePost: null
    }
  },
  methods: {
    editPost(id) {
      document.location.href = '/admin/posts/' + id + '/edit'
    },
    loadPosts() {
      this.loader = true
      let page = location.search.split('page=')[1]
      let params = {
        postPerPage: this.postPerPage,
        postOrderBy: this.postOrderBy,
        postDirection: this.postDirection

      }
      return new Promise((res, rej) => {
        axios.get(`posts/p?page=${page}`, {params})
          .then(response => {
            this.loadedPosts = response.data.posts.data
            this.paginateData = response.data.posts
            this.pageSelectionLinks = response.data.posts.links.slice(1, -1)
            this.pageSelectionLinkActive = this.pageSelectionLinks.find(p => p.active === true).url

            if (response.data.posts.links.length <= 6) {
              this.links = response.data.posts.links.slice(1, -1)
            } else if (response.data.posts.current_page < 4) {
              this.links = response.data.posts.links.slice(1, -1).slice(0, 5)
            } else {
              if (response.data.posts.last_page - response.data.posts.current_page <= 2) {
                this.links = response.data.posts.links.slice(1, -1).slice(response.data.posts.last_page - 5, response.data.posts.last_page)
              } else {
                this.links = response.data.posts.links.slice(1, -1).slice(response.data.posts.current_page - 2, response.data.posts.current_page + 3)
              }

            }
            this.loader = false

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    delPost(id) {
      this.showModalLoader = true
      this.showPostPreDeleteConfirmationModal = false
      return new Promise((res, rej) => {
        axios.delete(`/admin/posts/${id}`)
          .then(response => {
            this.showModalLoader = false
            this.showConfirmationModal = true

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    notDel() {
      this.showPostPreDeleteConfirmationModal = false
    },
    del(p) {
      this.deletePost = p
      this.showPostPreDeleteConfirmationModal = true
    },
    close() {
      this.showPostPreDeleteConfirmationModal = false
      this.showConfirmationModal = false
      this.loadPosts()
    }
  },
  mounted() {
    this.loadPosts()

  },
  components: {
    ConfirmationModal,
    AppPagination,
    PostPreDeleteConfirmationModal,
    MoonLoader,
    AppPageTitle,
    ModalLoader
  }
}
</script>

<style scoped>

</style>