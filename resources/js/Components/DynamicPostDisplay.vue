<template>
  <div id="DynamicPostDisplay">
    <!-- <pre>{{ post }}</pre> -->
    <div class="flex flex-col-reverse md:flex-row md:justify-between">
      <div>{{ post.title }}</div>
      <small class="font-light text-gray-800 text-end mx-4 md:mx-0 block">{{ formatDate(post.datetime8601) }}</small>
    </div>
    <div class="my-8">
      {{ post.body }}
    </div>
    <div class="my-8">
      <div v-for="image in gallery" :key="image.id" class="flex flex-row">
        <div>
          <img :src="`/storage/gallery/medium/${image}`" class="h-10 w-10 rounded-lg" alt="post gallery"/>
        </div>
      </div>
    </div>
    <div class="my-4 mr-4 md:mr-0 justify-end">
      <div class="grid grid-cols-12 gap-4">
        <div class="col-span-1"><img :src="`/storage/avatars/medium/${post.path}`" class="min-h-10 min-w-10 rounded-lg" alt="user avatar"/></div>
        <div class="flex col-span-8 items-center"><a :href="`/account/${post.userId}`">{{ post.name }}</a></div>
        <div class="flex col-span-1 items-center"><i class="fa-regular fa-heart fa-fw"></i></div>
        <div class="flex col-span-1 items-center"><i class="col-span-1 fa-regular fa-comments fa-fw"></i></div>
        <div class="flex col-span-1 items-center"><i class="col-span-1 fa-solid fa-retweet fa-fw"></i></div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { DateTime } from "luxon";

  const props = defineProps(["post", "gallery"]);

  const formatDate = (datetime8601) => {
    return DateTime.fromISO(datetime8601).toLocaleString(DateTime.DATETIME_FULL);
  };

</script>