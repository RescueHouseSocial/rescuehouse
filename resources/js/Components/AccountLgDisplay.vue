<template>
  <div id="AccountLgDisplay">
    <div class="mx-4">
      <div class="bg-gray-50 rounded-lg shadow">
        <div class="p-4">
          <div class="flex justify-center">
            <img :src="`/storage/avatars/medium/${avatar.path}`" class="rounded-lg" alt="user avatar" />
          </div>
          <div class="flex flex-row justify-center">
            <div v-if="follow != null" class="flex justify-center p-4">
              <span v-if="isLoading">
                <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
              </span>
              <span v-else>
                <button 
                  @click="handleFollowToggle"
                  :class="{'border-2 border-gray-600': isFollowing, 'flex mx-auto text-white bg-orange-500 border-2 border-transparent py-2 px-8 focus:outline-none hover:bg-orange-600 rounded text-lg': true}"
                  ><span v-if="isFollowing === false">Follow</span><span v-else>Following</span>
                </button>
              </span>
            </div>
            <div class="flex justify-center p-4">
              <button
                @click="handleMessageSubmit"
                class="flex mx-auto text-white bg-orange-500 border-2 border-transparent py-2 px-8 focus:outline-none hover:bg-orange-600 rounded text-lg"
              >Message</button>
            </div>
          </div>
          <div class="mb-4">
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
              <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 grid-cols-3">
                <div class="flex flex-col items-center justify-center">
                  <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ formattedPostCount }}</dt>
                  <dd class="font-light text-gray-500">{{ formattedPostCount === 1 ? 'Posts' : 'Post' }}</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ formattedFollowingCount }}</dt>
                  <dd class="font-light text-gray-500">Following</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ formattedFollowersCount }}</dt>
                  <dd class="font-light text-gray-500">Followers</dd>
                </div>
              </dl>
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-xl font-bold tracking-tight text-gray-900">{{ users.name }}</h3>
            <div v-if="users.location"><i class="text-gray-500 fa-solid fa-location-dot fa-fw"></i><span class="text-gray-500 mx-1">{{ users.location }}</span></div>
            <p class="mt-4 mb-4 font-light text-gray-500 whitespace-break-spaces">{{ users.biography }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref } from "vue";

  const emit = defineEmits(["following", "messaging"]);

  const props = defineProps(["users", "avatar", "follow", "formattedPostCount", "formattedFollowingCount", "formattedFollowersCount"]);

  let isFollowing = props.follow;
  
  let isLoading = ref(false);

  const handleMessageSubmit = async () => {
    emit("messaging", props.users.userId);
  };

  const handleFollowToggle = async () => {
    isLoading.value = true;
    if (isFollowing === false) {
      isFollowing = true;
      emit("following", isFollowing);
      isLoading.value = false;
    } else {
      isFollowing = false;
      emit("following", isFollowing);
      isLoading.value = false;
    }
    window.location.reload();
  };

</script>