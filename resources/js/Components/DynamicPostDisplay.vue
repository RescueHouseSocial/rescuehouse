<template>
  <div id="DynamicPostDisplay">
    <div class="flex flex-col-reverse md:flex-row md:justify-between">
      <div>{{ post.title }}</div>
      <small class="font-light text-gray-800 text-end mx-4 md:mx-0 block">{{ formatDate(post.datetime8601) }}</small>
    </div>
    <div class="my-8">
      <div class="whitespace-break-spaces">{{ post.body }}</div>
    </div>
    <div class="my-8">
      <div v-for="image in post.galleries" :key="image.id" class="flex flex-row">
        <div>
          <img :src="`/storage/gallery/medium/${image.path}`" class="h-10 w-10 rounded-lg" alt="post gallery"/>
        </div>
      </div>
    </div>
    <div class="mr-4 md:mr-0 justify-end">
      <div class="grid grid-cols-12 gap-0 place-items-left">
        <div class="col-span-1"><img :src="`/storage/avatars/medium/${post.path}`" class="h-full w-full rounded" alt="user avatar"/></div>
        <div class="flex col-span-8 items-center"><a :href="`/account/${post.userId}`" class="mx-2">{{ post.name }}</a></div>
        <div class="flex col-span-1">
          <div class="flex flex-col items-center">
            <div @click="handleFavoriteToggle(post.postId)" class="hover:text-orange-400 cursor-pointer">
              <i class="fa-regular fa-heart fa-fw fa-lg"></i>
            </div>
            <div class="text-sm font-light">{{ formattedFavoriteCount }}</div>
          </div>
        </div>
        <div class="flex col-span-1">
          <div class="flex flex-col items-center">
            <div @click="handleCommentToggle(post.postId)" class="hover:text-orange-400 cursor-pointer">
              <i class="fa-regular fa-comments fa-fw fa-lg"></i>
            </div>
            <div class="text-sm font-light">{{ formattedCommentCount }}</div>
          </div>
        </div>
        <div class="flex col-span-1">
          <div class="flex flex-col items-center">
            <div @click="handleRepostToggle(post.postId)" class="hover:text-orange-400 cursor-pointer">
              <i class="fa-solid fa-retweet fa-fw fa-lg"></i>
            </div>
            <div class="text-sm font-light">{{ formattedRepostCount }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { defineProps, computed } from "vue";
  import { DateTime } from "luxon";

  const props = defineProps(["post"]);

  const formatDate = (datetime8601) => {
    return DateTime.fromISO(datetime8601).toLocaleString(DateTime.DATETIME_FULL);
  };

  const formattedFavoriteCount = computed(() => {
    return formatNumber(1000000);
  });

  const formattedCommentCount = computed(() => {
    return formatNumber(1000000);
  });

  const formattedRepostCount = computed(() => {
    return formatNumber(1000000);
  });

  function formatNumber(number) {
    if (typeof number === "number" && Number.isInteger(number)) {
      if (number < 10000) {
        return number.toLocaleString("en-US");
      } else if (number < 1000000) {
        return (number / 1000).toFixed(0) + "k";
      } else {
        let remainder = number % 1000000;
        let millions = (number - remainder) / 1000000;
        if (remainder < 10000) {
          return millions + "M";
        } else {
          return millions + "." + (remainder / 1000).toFixed(0) + "M";
        }
      }
    }
    return number;
  }

  const handleFavoriteToggle = (postId) => {
    console.log(postId);
  };

  const handleCommentToggle = (postId) => {
    console.log(postId);
  };

  const handleRepostToggle = (postId) => {
    console.log(postId);
  };

</script>