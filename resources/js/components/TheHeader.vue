<template>
  <header class="container mx-auto p-[15px] border-b border-gray-100">
    <div v-if="user" class="relative">
      <div class="flex justify-between items-center mb-[10px]">
        <div class="md:invisible flex flex-col items-start" @click="showMainMenu = !showMainMenu">
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
        </div>
        <div>
          <div class="" v-if="post && direction && !address">
            <span class="">Пост № {{ post }}</span> |
            <span>{{ direction }}</span>
            <div class="text-center"><a class="border-b border-blue text-blue" href="/select-post">Змінити</a></div>
          </div>
          <div class="text-center px-[10px]" v-else-if="!post && !direction && address">
            <span class="">{{address}}</span>
            <div class="text-center"><a class="border-b border-blue text-blue" href="/select-post">Змінити</a></div>
          </div>
          <div v-else class="text-center px-[10px]">
            <span class="">Виберіть пост та напрямок, або введіть адресу</span>
            <div class="text-center"><a class="border-b border-blue text-blue" href="/select-post">Вибрати</a></div>
          </div>


        </div>
        <div><a class="cursor-pointer" @click="logout">Вийти</a></div>
      </div>
      <ul class="main-menu z-10 absolute top-[50px] md:relative md:top-[0px] bg-white"
          :class="{'hidden': !showMainMenu , 'md:flex': !showMainMenu}">
        <li class="my-[10px]">
          <a href="/" class="py-[10px] block" @click="showMainMenu = false">Головна</a>
        </li>
        <li class="my-[10px]">
          <a href="/add-car" class="py-[10px] block" @click="showMainMenu = false">Додати авто</a>
        </li>
        <li class="my-[10px]">
          <a href="/monitoring" class="py-[10px] block" @click="showMainMenu = false">Моніторинг</a>
        </li>
        <li v-if="userIsAdmin" class="my-[10px]">
          <a href="/admin/posts" class="py-[10px] block" @click="showMainMenu = false">Адмін</a>
        </li>
      </ul>
    </div>

    <div v-else>
      <div class="text-lg text-center mt-4">
        <a class="inline-block pr-[10px]" :class="{'text-gray-400': url === '/login'}" href="/login">Логін</a> |
        <a class="inline-block pl-[10px]" :class="{'text-gray-400': url === '/register'}"
           href="/register">Реєстрація</a>
      </div>

    </div>
  </header>
</template>

<script>
import axios from "axios";

export default {
  name: "TheHeader",
  props: {
    user: {
      type: Object,
      required: false
    },

  },
  data() {
    return {
      url: document.location.pathname,
      showMainMenu: false,
      post: null,
      direction: null,
      address: null,
    }
  },
  methods: {
    logout() {
      return new Promise((res, rej) => {
        axios.post('/logout')
          .then(response => {
            console.log(response)
            document.location.href = '/'
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
  },
  computed: {
    userIsAdmin() {
      if (this.user) {
        let check = this.user.roles.find(role => role.slug === 'admin')
        if (check) {
          return true
        }
      return false
      }
    },
  },
  mounted() {
    if (localStorage.getItem("postAndDirection")) {
      this.post = JSON.parse(localStorage.getItem("postAndDirection")).post;
      this.direction = JSON.parse(localStorage.getItem("postAndDirection")).direction;
    }
    if (localStorage.getItem("address")) {
      this.address = JSON.parse(localStorage.getItem("address")).address;
    }
  }
}
</script>

<style scoped>

</style>