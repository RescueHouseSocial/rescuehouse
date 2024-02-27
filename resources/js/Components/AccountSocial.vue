<template>
  <div id="AccountSocial">
    <div class="container mx-auto">
      <div class="flex flex-row -m-4 text-center">
        <div class="p-4 sm:w-1/4 w-1/2">
          <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ formattedFollowersCount }}</h2>
          <p class="leading-relaxed">Followers</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ formattedFollowingCount }}</h2>
          <p class="leading-relaxed">Following</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2>
          <p class="leading-relaxed">Bank</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
          <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ formattedPostCount }}</h2>
          <p class="leading-relaxed">Posts</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { defineProps, computed } from 'vue';

  const props = defineProps(["followerscount", "followingcount", "postcount"]);

  const formattedFollowersCount = computed(() => {
    return formatNumber(props.followerscount);
  });

  const formattedFollowingCount = computed(() => {
    return formatNumber(props.followingcount);
  });

  const formattedPostCount = computed(() => {
    return formatNumber(props.postcount);
  });

  function formatNumber(number) {
    if (typeof number === 'number' && Number.isInteger(number)) {
      return number.toLocaleString('en-US');
    }
    return number;
  }

</script>