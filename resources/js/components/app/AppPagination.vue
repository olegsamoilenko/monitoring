<template>
  <div class="bg-white py-3 flex items-center justify-between border-t border-gray-200">
    <div class="flex-1 flex flex-col  justify-center sm:hidden">
      <div class="">
        <p class="text-sm text-gray-700">
          Показано з
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.from }}</span>
          {{ ' ' }}
          по
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.to }}</span>
          {{ ' ' }}
          із
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.total }}</span>
          {{ ' ' }}
          результатів
        </p>
      </div>
      <div class="flex items-center justify-between mt-[10px]">
        <div>
          <a :href="paginateData.prev_page_url"
             class="btn-admin">
            Попередня </a>
        </div>

<!--        <div class="mt-[5px]">-->
          <select class="form-input" name="currentPage" @change="goToLink" v-model="pageSelectionLinkActive">
            <option
              v-for="p in pageSelectionLinks"
              :key="p.label"
              :value="p.url"
              class="h-[20px]"
            >{{ p.label }}
            </option>
          </select>
<!--        </div>-->

        <div>
          <a :href="paginateData.next_page_url"
             class="btn-admin">
            Наступна </a>
        </div>
      </div>

    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Показано з
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.from }}</span>
          {{ ' ' }}
          по
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.to }}</span>
          {{ ' ' }}
          із
          {{ ' ' }}
          <span class="font-medium">{{ paginateData.total }}</span>
          {{ ' ' }}
          постів
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a :href="paginateData.first_page_url"
             class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">&lt;&lt;
          </a>
          <a :href="paginateData.prev_page_url"
             class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">&lt;
            <!--                        <span class="sr-only">Previous</span>-->
            <!--                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />-->
          </a>
          <a v-for="l in links" :key="l.url" :href="l.url"
             class="relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-pointer"
             :class="[l.active ? 'paginate-active' : '', 'paginate-base']">{{ l.label }}</a>

          <a :href="paginateData.next_page_url"
             class="relative inline-flex items-center px-2 py-2  border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">>
            <!--                        <span class="sr-only">Next</span>-->
            <!--                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />-->
          </a>
          <a :href="paginateData.last_page_url"
             class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">>>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
// import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'

export default {
  props: {
    paginateData: {
      type: Object,
      required: true
    },
    links: {
      type: Array,
      required: true
    },
    pageSelectionLinks: {
      type: Array,
      required: true
    },
    pageSelectionLinkActive: {
      type: String,

    }
  },
  data() {
    return {
    }
  },

  methods: {
    goToLink() {
      document.location.href = this.pageSelectionLinkActive
    }
  },

  mounted() {

  },

  components: {
    // ChevronLeftIcon,
    // ChevronRightIcon,
  },
}
</script>