<template>
  <div id="InteractivesDisplay">
    <div class="flex flex-col justify-center">
      <div v-for="post in posts" :key="post.id">
        <div class="py-4 px-8 mx-auto w-full">
          <div class="bg-gray-50 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 p-4">
              <DynamicCarousel
                :galleries="post.galleries"
              />
              <div class="mt-4 md:mt-0">
                <p class="font-light text-gray-500">This session starts</p>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">{{ formatDate(post.datetime) }}</h2>
                <h2 v-if="post.title" class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">{{ post.title }}</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg">{{ post.body }}</p>
                <form @submit.prevent="handleLiveSubmit(post.postId)">
                  <div class="flex justify-end">
                    <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                      <span v-if="isLoading">
                        <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                      </span>
                      <span v-else>
                        Go Live
                      </span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { DateTime } from "luxon";

  import { ref } from "vue";

  import DynamicCarousel from "../Components/DynamicCarousel.vue";

  let isLoading = ref(false);

  const props = defineProps(["posts"]);

  const formatDate = (datetime) => {
    return DateTime.fromISO(datetime).toLocaleString(DateTime.DATETIME_FULL);
  };

  const handleLiveSubmit = async (postId) => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    window.location.href = `/interactive/${postId}`;
    isLoading.value = false;
  };

</script>