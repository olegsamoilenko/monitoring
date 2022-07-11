<template>
  <header class="container mx-auto border-b border-gray-100">
    <div v-if="user" class="relative">
      <div class="flex justify-between items-center mb-[10px] p-[15px]">
        <div class="md:invisible flex flex-col items-start" @click="showMainMenu = !showMainMenu">
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
          <div class="h-[1.5px] w-[20px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
        </div>
        <div>
          <div>{{user.name}} {{user.surname}}</div>
        </div>
        <div><a class="cursor-pointer" @click="logout">Вийти</a></div>
      </div>
      <ul class="px-[15px] main-menu z-10 absolute top-[50px] md:relative md:top-[0px] bg-white" :class="{'hidden': !showMainMenu , 'md:flex': !showMainMenu}">
        <li class="my-[10px]" v-for="link in mainMenu" :key="link.title">
          <a :href="link.url" class="py-[10px] block" @click="showMainMenu = false">{{ link.title }}</a>
        </li>
      </ul>
    </div>

    <div v-else>
      <div class="text-lg text-center mt-4">
        <a class="inline-block pr-[10px]" :class="{'text-gray-400': url === '/login'}" href="/login">Логін</a> |
        <a class="inline-block pl-[10px]" :class="{'text-gray-400': url === '/register'}" href="/register">Реєстрація</a>
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
    }
  },
  data() {
    return {
      url: document.location.pathname,
      showMainMenu: false,
      mainMenu: [
        {'title': 'Пости', 'url': '/admin/posts'},
        {'title': 'Користувачі', 'url': '/admin/users'},
        {'title': 'На сайт', 'url': '/'},
      ],
      post: null,
      direction: null
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
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>