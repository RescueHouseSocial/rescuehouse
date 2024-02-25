<template>
  <div id="AccountLgDisplay">
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
      <div v-if="avatar" class="w-100 h-100">
        <img :src="`/storage/avatars/medium/${avatar.path}`" class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" alt="user avatar"/>
      </div>
      <div class="p-4">
        <h3 class="text-xl font-bold tracking-tight text-gray-900">{{ users.name }}</h3>
        <span class="text-gray-500">Location</span>
        <p class="mt-4 mb-4 font-light text-gray-500">Biography</p>
      </div>
    </div>
  </div>
</template>

<script setup>

  const props = defineProps(["users", "avatar"]);

</script>