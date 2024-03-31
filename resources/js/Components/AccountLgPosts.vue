<template>
  <div id="AccountLgPosts">
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
      <div class="flex flex-row justify-around">
        <div class="me-2">
          <div @click="posts" 
            :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'posts' }"
            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Posts
          </div>
        </div>
        <div class="me-2">
          <div @click="replies"
            :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'replies' }"
            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Replies
          </div>
        </div>
        <div class="me-2">
          <div @click="tokens"
            :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'tokens' }"
            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Tokens
          </div>
        </div>
        <div class="me-2">
          <div @click="galleries" 
            :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'galleries' }"
            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Gallery
          </div>
        </div>
      </div>
    </div>
    <div class="w-full">
      <div v-if="activeTab === 'posts'">
        <div class="flex justify-center">
          <div class="py-4 px-4 mx-auto w-full md:w-1/2">
            <div class="grid gap-4 mb-4 md:grid-cols-1">
              <div v-for="post in myposts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow">
                <DynamicPostDisplay
                  :post="post"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="activeTab === 'replies'">
        <div class="flex justify-center">
          <div class="py-4 px-4 mx-auto w-full md:w-1/2">
            <div class="grid gap-4 mb-4 md:grid-cols-1">
              <div v-for="post in myreplies" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow">
                <DynamicPostDisplay
                  :post="post"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="activeTab === 'tokens'">
        <div class="flex flex-wrap my-4">
          <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
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
      <div v-if="activeTab === 'galleries'">
        <div class="flex flex-row flex-wrap my-4">
          <div v-for="post in mygalleries" :key="post.id" class="w-12 h-12 mr-4 mb-4">
            <img :src="`/storage/gallery/medium/${post.path}`" class="rounded-lg" alt="user gallery"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";
  import TokenItem from "../Components/TokenItem.vue";

  import { defineProps, computed, ref } from "vue";

  import axios from 'axios';

  const props = defineProps(["myposts", "myreplies", "mygalleries", "mybank"]);

  let activeTab = ref("posts"); 

  const posts = async () => {
    activeTab.value = "posts";
  }

  const replies = async () => {
    activeTab.value = "replies";
  }

  const tokens = async () => {
    try {
      // const response = await axios.post(route("account.follow"), { following });
      activeTab.value = "tokens";
    } catch (error) {
      console.error("Error:", error);
    }
  }

  const galleries = async () => {
    try {
      // const response = await axios.post(route("account.follow"), { following });
      activeTab.value = "galleries";
    } catch (error) {
      console.error("Error:", error);
    }
  }

</script>