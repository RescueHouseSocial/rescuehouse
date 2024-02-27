<template>
  <div id="AccountLgDisplay">
    <div class="bg-gray-50 rounded-lg shadow sm:flex">
      <div v-if="avatar" class="w-100 h-100">
        <img :src="`/storage/avatars/medium/${avatar.path}`" class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" alt="user avatar"/>
      </div>
      <div class="flex flex-col w-full">
        <div class="flex justify-center p-4">
          <button 
            @click="handleFollowToggle"
            :class="{'border-2 border-gray-600': isFollowing, 'flex mx-auto text-white bg-orange-500 border-2 border-transparent py-2 px-8 focus:outline-none hover:bg-orange-600 rounded text-lg': true}"
          >{{ buttonText }}</button>
        </div>
        <div class="p-4">
          <h3 class="text-xl font-bold tracking-tight text-gray-900">{{ users.name }}</h3>
          <span class="text-gray-500">Location</span>
          <p class="mt-4 mb-4 font-light text-gray-500">Biography</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref } from 'vue';
  let buttonText = ref('Follow');
  let isFollowing = ref(false);

  const props = defineProps(["users", "avatar"]);

  const handleFollowToggle = () => {
    if (isFollowing.value === false) {
      buttonText.value = 'Following';
      isFollowing.value = true;
    } else {
      buttonText.value = 'Follow';
      isFollowing.value = false;
    }
  };

</script>