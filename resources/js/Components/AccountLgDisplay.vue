<template>
  <div id="AccountLgDisplay">
    <div class="bg-gray-50 rounded-lg shadow sm:flex">
      <div v-if="avatar" class="w-100 h-100">
        <img :src="`/storage/avatars/medium/${avatar.path}`" class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" alt="user avatar"/>
      </div>
      <div class="flex flex-col w-full">
        <div v-if="follow != null" class="flex justify-center p-4">
          <button 
            @click="handleFollowToggle"
            :class="{'border-2 border-gray-600': isFollowing, 'flex mx-auto text-white bg-orange-500 border-2 border-transparent py-2 px-8 focus:outline-none hover:bg-orange-600 rounded text-lg': true}"
            ><span v-if="isFollowing === false">Follow</span><span v-else>Following</span></button>
        </div>
        <div class="p-4">
          <h3 class="text-xl font-bold tracking-tight text-gray-900">{{ users.name }}</h3>
          <div v-if="users.location"><i class="text-gray-500 fa-solid fa-location-dot fa-fw"></i><span class="text-gray-500 mx-1">{{ users.location }}</span></div>
          <p class="mt-4 mb-4 font-light text-gray-500 whitespace-break-spaces">{{ users.biography }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  const emit = defineEmits(["following"]);

  const props = defineProps(["users", "avatar", "follow"]);

  let isFollowing = props.follow;

  const handleFollowToggle = () => {
    if (isFollowing === false) {
      isFollowing = true;
      emit("following", isFollowing);
    } else {
      isFollowing = false;
      emit("following", isFollowing);
    }
    window.location.reload();
  };

</script>