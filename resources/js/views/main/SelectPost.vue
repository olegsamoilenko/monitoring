<template>
  <div class="container mx-auto p-[15px] mb-[100px]">
    <form class="px-5 py-2 border-b" @submit.prevent="add">
      <div class="mb-4">* Для того, щоб додати інформацію, Ви маете вибрати номер посту та напрямок або ввести адрусу вручну.</div>
      <span class="form-error" v-if="error">{{ error }}</span>
      <div>
        <div class="form-label">Виберіть номер посту</div>
        <select class="form-input" name="postNumber" v-model="post">
          <option :value="null">Виберіть номер посту</option>
          <option
            v-for="p in posts"
            :key="p.id"
            :value="p.number"
          >Пост № {{ p.number }}
          </option>
        </select>

        <div class="mt-4 form-label">Виберіть напрямок</div>
        <select class="form-input" name="direction" v-model="direction">
          <option :value="null">Виберіть напрямок</option>
          <option v-if="selectedPost && selectedPost.direction_1" :value="selectedPost.direction_1">{{ selectedPost.direction_1 }}</option>
          <option v-if="selectedPost && selectedPost.direction_2" :value="selectedPost.direction_2">{{ selectedPost.direction_2 }}</option>
          <option v-if="selectedPost && selectedPost.direction_3" :value="selectedPost.direction_3">{{ selectedPost.direction_3 }}</option>
          <option v-if="selectedPost && selectedPost.direction_4" :value="selectedPost.direction_4">{{ selectedPost.direction_4 }}</option>
          <option v-if="selectedPost && selectedPost.direction_5" :value="selectedPost.direction_5">{{ selectedPost.direction_5 }}</option>
        </select>

        <!--        <div class="mt-4">Або введіть адресу</div>-->
        <!--        <textarea class="form-input w-full mb-[10px]" name="address" v-model="address" id="" cols="25" rows="2" placeholder="Введіть адресу" :disabled="postNumber"></textarea>-->

        <div class="form-label mt-[20px]">Або введіть адресу вручну</div>
        <app-input
          type="text"
          name="address"
          :errors="errors"
          v-model="address"
          placeholder="Введіть адресу"
        ></app-input>

      </div>
      <app-button
        type="submit"
        title="Зберегти"
      ></app-button>

    </form>
  </div>
</template>

<script>
import AppButton from "../../components/app/AppButton";
import AppInput from "../../components/app/AppInput";
import axios from "axios";
export default {
  name: "SelectPost",
  data() {
    return {
      posts: [],
      selectedPost: null,
      post: null,
      direction: null,
      error: null,
      errors: null,
      address: null
    }
  },
  methods: {
    add() {
      if (this.post && this.direction && this.address) {
        this.error = 'Ви маете вибрати або номер посту та напрямок, або ввести адресу вручну!'
      } else if (this.post && !this.direction && this.address) {
        this.error = 'Ви маете вибрати або номер посту та напрямок, або ввести адресу вручну!'
      } else if (this.post && this.direction && !this.address) {
        localStorage.setItem("postAndDirection", JSON.stringify(
          {
            'post': this.post,
            'direction': this.direction
          },
        ));
        localStorage.removeItem("address")

        // localStorage.setItem("selectedPost", JSON.stringify(
        //   {
        //     'selectedPost': this.posts.filter(p => p.number === this.post)[0],
        //   },
        //
        // ));

        document.location.href = '/add-car'
      } else if (!this.post && !this.direction && this.address) {
        localStorage.setItem("address", JSON.stringify(
          {
            'address': this.address,
          },
        ));
        localStorage.removeItem("postAndDirection")


        document.location.href = '/add-car'
      } else {
        this.error = 'Виберіть номер посту та напрямок, або введіть адресу вручну!'
      }
    },

    getPosts() {
      return new Promise((res, rej) => {
        axios.get('/admin/get-posts')
          .then(response => {
            this.posts = response.data.posts;
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

    choiceDirection() {
      this.selectedPost = this.posts.filter(p => p.number === this.post)[0]
    }
  },
  created() {
    this.getPosts()
  },
  mounted() {

  },
  watch: {
    post() {
      this.choiceDirection()
    },
  },
  components: {
    AppButton,
    AppInput
  }
}
</script>

<style scoped>

</style>