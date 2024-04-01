<template>
  <div id="DynamicPostDisplay">
    <div class="flex flex-col mx-auto p-4 w-full">
      <div class="flex flex-row justify-between">
        <div class="flex flex-row">
          <div v-if="post.path" class="items-center"><img :src="`/storage/avatars/medium/${post.path}`" class="h-12 w-12 rounded" alt="user avatar"/></div>
          <div class="flex items-center"><a :href="`/account/${post.userId}`" class="mx-2">{{ post.name }}</a></div>
        </div>
        <div class="flex items-center"><small class="font-light text-gray-800 text-end mx-4 md:mx-0">{{ formatDate(post.datetime8601) }}</small></div>
      </div>
      <div class="my-8">
        <div class="whitespace-break-spaces">{{ post.body }}</div>
      </div>
      <div class="my-8">
        <DynamicCarousel
          :galleries="post.galleries"
        />
      </div>
      <div class="mr-4 md:mr-0 justify-end">
        <div class="flex flex-row flex-nowrap justify-between">
          <div class="flex flex-row">
            <div class="flex flex-row items-center mx-2">
              <div v-if="formattedFavoriteCount > 0" class="text-sm mr-1">{{ formattedFavoriteCount }}</div>
              <div @click="handleFavoriteToggle(post.postId)" class="hover:text-orange-400 cursor-pointer">
                <span v-if="post.favorites && post.favorites.length > 0 || activeFavorite === false">
                  <i class="fa-solid fa-heart fa-fw fa-lg"></i>
                </span>
                <span v-else>
                  <i class="fa-regular fa-heart fa-fw fa-lg"></i>
                </span>
              </div>
            </div>
            <div @click="showModal" class="hover:text-orange-400 cursor-pointer">
              <i class="fa-solid fa-circle-dollar-to-slot fa-fw fa-lg"></i>
            </div>
            <Modal 
              v-show="isModalVisible"
              :postId="post.postId"
              :mybank="mybank"
              @close="closeModal"
            />
          </div>
          <div class="flex flex-row">
            <div class="flex flex-row items-center mx-2">
              <div v-if="formattedCommentCount > 0" class="text-sm mr-1">{{ formattedCommentCount }}</div>
              <div @click="handleCommentToggle(post.postId)" class="hover:text-orange-400 cursor-pointer">
                <i class="fa-regular fa-comments fa-fw fa-lg"></i>
              </div>
            </div>
            <div class="flex flex-row items-center mx-2">
              <div @click="handleShareToggle(post.postId)" class="mx-1 hover:text-orange-400 cursor-pointer">
                <i class="fa-regular fa-paper-plane fa-fw fa-lg"></i>
              </div>
            </div>
            <div class="flex flex-row items-center mx-2">
              <div @click="handleRepostToggle(post.postId)" class="mx-1 hover:text-orange-400 cursor-pointer">
                <i class="fa-solid fa-retweet fa-fw fa-lg"></i>
              </div>
            </div>
            <div class="flex flex-row items-center mx-2">
              <div @click="handleMessageToggle(post.userId)" class="mx-1 hover:text-orange-400 cursor-pointer">
                <i class="fa-solid fa-at fa-fw fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import DynamicCarousel from "../Components/DynamicCarousel.vue";
  import Modal from "../Components/DynamicModal.vue";

  import { defineProps, computed, ref } from "vue";

  import axios from 'axios';

  import { DateTime } from "luxon";

  const emit = defineEmits(["feed-refresh"]);

  const props = defineProps(["post", "mybank"]);

  let activeFavorite = ref();
  let isModalVisible = ref(false);
  let favoried = ref(false);

  const formatDate = (datetime8601) => {
    const pastDate = DateTime.fromISO(datetime8601);
    const now = DateTime.now();
    const diff = now.diff(pastDate, ["years", "months", "days", "hours"]).toObject();
    if (diff.years > 0) {
      const roundedYears = Math.round(diff.years);
      return `${roundedYears} year${roundedYears !== 1 ? "s" : ""} ago`;
    } else if (diff.months > 0) {
      const roundedMonths = Math.round(diff.months);
      return `${roundedMonths} month${roundedMonths !== 1 ? "s" : ""} ago`;
    } else if (diff.days > 0) {
      const roundedDays = Math.round(diff.days);
      return `${roundedDays} day${roundedDays !== 1 ? "s" : ""} ago`;
    } else if (diff.hours > 1) {
      const roundedHours = Math.round(diff.hours);
      return `${roundedHours} hour${roundedHours !== 1 ? "s" : ""} ago`;
    } else {
      return "1 hour ago";
    }
  };

  const formattedFavoriteCount = computed(() => {
    return formatNumber(props.post.favoritescount);
  });

  const formattedCommentCount = computed(() => {
    return formatNumber(props.post.repliescount);
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

  const handleFavoriteToggle = async (postId) => {
    if (props.post.favorites.length === 0) {
      activeFavorite.value = false;
      favoried.value = false;
    } else {
      props.post.favorites = [];
      activeFavorite.value = true;
      favoried.value = true;
    }
    await axios.post(route("favorite.store"), {
      favoried: favoried.value,
      postId: postId,
    })
    .then(response => {
      emit("feed-refresh");
    })
    .catch(error => {
      console.error("Error:", error);
    });
  };

  const showModal = () => {
    isModalVisible.value = true;
  };

  const closeModal = () => {
    isModalVisible.value = false;
  };

  const handleCommentToggle = (postId) => {
    window.location.href = `/post/${postId}`;
  };

  const handleShareToggle = (postId) => {
    console.log(postId);
  };

  const handleRepostToggle = (postId) => {
    console.log(postId);
  };

  const handleMessageToggle = (postId) => {
    window.location.href = `/message/${postId}`;
  };

</script>