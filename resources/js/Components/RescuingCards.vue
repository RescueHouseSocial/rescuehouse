<template>
  <div id="RescuingCards">
    <div v-for="post in posts" :key="post.id">
      <div class="w-full grid grid-cols-2 md:grid-cols-2 gap-4">
        <div v-for="item in post.posts" :key="post.id">
          <article class="p-6 my-4 bg-white rounded-lg border border-gray-200 shadow">
            <div class="flex justify-between items-center mb-5 text-gray-500">
              <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                <i class="fa-solid fa-heart fa-fw"></i>
                {{ item.type }}
              </span>
              <span class="text-sm">{{ formattedTime(item.datetime8601) }}</span>
            </div>
            <div class="w-50 h-50 inline-flex items-center justify-center rounded-full mb-5 flex-shrink-0">
              <img src="https://picsum.photos/id/11/520/480" class="rounded"/>
            </div>
            <p class="mb-5 font-light text-gray-500">{{ item.body }}</p>
            <div class="flex justify-between items-center">
              <div class="flex items-center space-x-4">
                <img :src="`/storage/avatars/medium/${item.path}`" class="h-8 w-8 rounded" alt="user avatar"/>
                <span class="font-medium">{{ item.name }}</span>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  import { DateTime } from "luxon";

  export default {
    name: "RescuingCards",
    data() {
      return {
        posts: [],
      };
    },
    computed: {
      formattedTime() {
        return function(datetime8601) {
          return DateTime.fromISO(datetime8601).toLocaleString(DateTime.DATETIME_FULL);
        };
      }
    },
    async mounted() {
      this.getPosts();
    },
    methods: {
      async getPosts() {
        try {
          const response = await axios.get(route("rescue.index"), {
            headers: {
              "X-CSRF-TOKEN": this.csrfToken,
              "Content-Type": "multipart/form-data",
            },
          });
          this.posts = response;
        } catch (error) {
          console.error(error); 
        }
      },
    },
  };

</script>