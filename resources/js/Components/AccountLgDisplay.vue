<template>
  <div id="AccountLgDisplay">
    <div class="mx-4">
      <div class="bg-gray-50 rounded-lg shadow">
        <div class="p-4">
          <div class="flex justify-center items-center">
            <div v-for="avatar in userAvatar" :key="avatar.id">
              <div v-if="avatar.path && avatar.path != 'unknown.jpg'">
                <img :src="`/storage/avatars/medium/${avatar.path}`" class="h-60 w-60 rounded" alt="user avatar"/>
              </div>
              <div v-else>
                <img src="../../images/paw150.png" class="h-60 w-60 rounded" alt="user avatar"/>
              </div>
            </div>
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
            <h3 class="text-xl font-bold tracking-tight text-gray-900">{{ users[0].name }}</h3>
            <div v-if="users[0].location"><i class="text-gray-500 fa-solid fa-location-dot fa-fw"></i><span class="text-gray-500 mx-1">{{ users[0].location }}</span></div>
            <p class="mt-4 mb-4 font-light text-gray-500 whitespace-break-spaces">{{ users[0].biography }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref } from "vue";

  const emit = defineEmits(["following", "messaging"]);

  const props = defineProps(["users", "userAvatar", "follow", "formattedPostCount", "formattedFollowingCount", "formattedFollowersCount"]);

  let isFollowing = props.follow;
  let followee = props.users[0].userId;

  let isLoading = ref(false);

  const handleMessageSubmit = async () => {
    emit("messaging", props.users[0].userId);
  };

  const handleFollowToggle = async () => {
    isLoading.value = true;
    let payload = [];
    if (isFollowing === false) {
      isFollowing = true;
      payload = [
        {
          isFollowing: isFollowing,
          followee: followee
        }
      ];
      emit("following", payload);
      isLoading.value = false;
    } else {
      isFollowing = false;
      payload = [
        {
          isFollowing: isFollowing,
          followee: followee
        }
      ];
      emit("following", payload);
      isLoading.value = false;
    }
  };

</script>