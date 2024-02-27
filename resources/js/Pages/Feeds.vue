<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feeds</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-8 px-8 mx-auto w-full md:w-1/2">
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <div v-for="post in posts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <div class="flex flex-col mx-4 my-4 mx-auto p-4 w-full">
                  <div class="flex flex-col-reverse md:flex-row md:justify-between">
                    <div>{{ post.title }}</div>
                    <small class="font-light text-gray-800 text-end mx-4 md:mx-0 block">{{ formatDate(post.datetime8601) }}</small>
                  </div>
                  <div class="my-8">
                    {{ post.body }}
                  </div>
                  <div class="my-4 mr-4 md:mr-0 justify-end">
                    <div class="grid grid-cols-12 gap-4">
                      <div class="col-span-1"><img :src="`/storage/avatars/medium/${post.path}`" class="min-h-10 min-w-10 rounded-lg" alt="user avatar"/></div>
                      <div class="flex col-span-8 items-center"><a :href="`/account/${post.userId}`">{{ post.name }}</a></div>
                      <div class="flex col-span-1 items-center"><i class="fa-regular fa-heart fa-fw fa-lg"></i></div>
                      <div class="flex col-span-1 items-center"><a :href="`/post/${post.postId}`" class="hover:text-orange-400"><i class="col-span-1 fa-regular fa-comments fa-fw fa-lg"></i></a></div>
                      <div class="flex col-span-1 items-center"><i class="col-span-1 fa-solid fa-retweet fa-fw fa-lg"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { Head } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  const props = defineProps(["posts"]);

  const formatDate = (datetime8601) => {
    return DateTime.fromISO(datetime8601).toLocaleString(DateTime.DATETIME_FULL);
  };

</script>
