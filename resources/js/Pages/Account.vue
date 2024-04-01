<template>
  <AuthenticatedLayout>
    <Head title="Account" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Account</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <div class="flex flex-row justify-around">
              <div class="me-2">
                <div @click="posts"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'posts' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">
                  <!-- <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2> -->
                  Posts
                </div>
              </div>
              <div class="me-2">
                <div @click="replies"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'replies' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">
                  <!-- <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2> -->
                  Replies
                </div>
              </div>
              <div class="me-2">
                <div @click="following"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'following' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">
                  <!-- <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2> -->
                  Following
                </div>
              </div>
              <div class="me-2">
                <div @click="followers"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'followers' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">
                  <!-- <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2> -->
                  Followers
                </div>
              </div>
              <div class="me-2">
                <div @click="bank"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'bank' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">
                  <!-- <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2> -->
                  Bank
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4 mx-4">
          <div class="md:sticky md:top-0">
            <AccountLgDisplay
              :users="users"
              :avatar="avatar"
              :follow="follow"
              :formattedPostCount="formattedPostCount"
              :formattedFollowingCount="formattedFollowingCount"
              :formattedFollowersCount="formattedFollowersCount"
              @following="handleFollowing"
              @messaging="handleMessaging"
            />
          </div>
          <div>
            <div v-if="activeTab === 'posts'">
              <div class="flex flex-col justify-center">
                <div v-if="isLoading" class="my-8">
                  <div class="flex justify-center">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </div>
                </div>
                <div v-else>
                  <div class="flex justify-center">
                    <div class="px-4 mx-auto w-full">
                      <div class="grid gap-4 mb-4 md:grid-cols-1">
                        <div v-for="post in myposts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow">
                          <DynamicPostDisplay
                            :post="post"
                            :mybank="mybank"
                            @feed-refresh="handleFeedRefresh"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="activeTab === 'replies'">
              <div class="flex flex-col justify-center">
                <div v-if="isLoading" class="my-8">
                  <div class="flex justify-center">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </div>
                </div>
                <div v-else>
                  <div class="flex justify-center">
                    <div class="px-4 mx-auto w-full">
                      <div class="grid gap-4 mb-4 md:grid-cols-1">
                        <div v-for="post in myreplies" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow">
                          <DynamicPostDisplay
                            :post="post"
                            :mybank="mybank"
                            @feed-refresh="handleFeedRefresh"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div v-for="post in socialposts" :key="post.id">
                    <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                      <div class="items-center bg-gray-50 rounded-lg shadow">
                        <div class="grid grid-cols-1 gap-4">
                          <DynamicPostDisplay
                            :post="post"
                            :mybank="mybank"
                            @feed-refresh="handleFeedRefresh"
                          />
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
            <div v-if="activeTab === 'following'">
              <div class="flex flex-col justify-center">
                <div v-if="isLoading" class="my-8">
                  <div class="flex justify-center">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </div>
                </div>
                <div v-else>
                  Following {{ formattedFollowingCount }}
                  <!-- <div v-for="post in socialposts" :key="post.id">
                    <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                      <div class="items-center bg-gray-50 rounded-lg shadow">
                        <div class="grid grid-cols-1 gap-4">
                          <DynamicPostDisplay
                            :post="post"
                            :mybank="mybank"
                            @feed-refresh="handleFeedRefresh"
                          />
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
            <div v-if="activeTab === 'followers'">
              <div class="flex flex-col justify-center">
                <div v-if="isLoading" class="my-8">
                  <div class="flex justify-center">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </div>
                </div>
                <div v-else>
                  Followers {{ formattedFollowersCount }}
                  <!-- <div v-for="post in socialposts" :key="post.id">
                    <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                      <div class="items-center bg-gray-50 rounded-lg shadow">
                        <div class="grid grid-cols-1 gap-4">
                          <DynamicPostDisplay
                            :post="post"
                            :mybank="mybank"
                            @feed-refresh="handleFeedRefresh"
                          />
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
            <div v-if="activeTab === 'bank'">
              <div class="flex flex-col justify-center">
                <div v-if="isLoading" class="my-8">
                  <div class="flex justify-center">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </div>
                </div>
                <div v-else>
                  <div class="flex flex-col mx-4 mx-auto">
                    <div class="flex flex-wrap mb-4">
                      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div v-for="tokens in mybank" :key="tokens.id">
                          <div v-for="token in tokens" :key="tokens.id">
                            <TokenItem 
                              :token="token"
                            />
                          </div>
                        </div>
                      </div>
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

  import axios from "axios";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  
  import { Head } from "@inertiajs/vue3";

  import AccountLgDisplay from "../Components/AccountLgDisplay.vue";
  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";
  import TokenItem from "../Components/TokenItem.vue";

  import { ref, onMounted, defineProps, computed } from "vue";

  const props = defineProps(["users", "avatar", "follow", "followerscount", "followingcount", "postcount", "myposts", "myreplies", "mygalleries", "mybank"]);

  console.log(props.myposts);

  let isLoading = ref(false);
  let activeTab = ref("posts");
  let accountBiography = ref([]);
  let accountPosts = ref([]);
  let accountFollowing = ref([]);
  let accountFollowers = ref([]);
  let accountBank = ref([]);

  // onMounted(async () => {
  //   const response = await axios.get(route("feeds.social"));
  //   socialposts.value = response.data.posts;
  //   mybank.value = response.data.mybank;
  // });

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

  const handleMessaging = async (addresseeId) => {
    window.location.href = `/message/${addresseeId}`;
  };

  const handleFollowing = async (following) => {
    try {
      const response = await axios.post(route("account.follow"), { following });
    } catch (error) {
      console.error("Error:", error);
    }
  };

  const posts = async () => {
    activeTab.value = "posts";
    isLoading.value = true;
    // const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    // socialposts.value = response.data.posts;
    // mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const replies = async () => {
    activeTab.value = "replies";
    isLoading.value = true;
    // const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    // socialposts.value = response.data.posts;
    // mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const following = async () => {
    activeTab.value = "following";
    isLoading.value = true;
    // const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    // socialposts.value = response.data.posts;
    // mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const followers = async () => {
    activeTab.value = "followers";
    isLoading.value = true;
    // const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    // socialposts.value = response.data.posts;
    // mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const bank = async () => {
    activeTab.value = "bank";
    isLoading.value = true;
    // const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    // socialposts.value = response.data.posts;
    // mybank.value = response.data.mybank;
    isLoading.value = false;
  }

</script>
