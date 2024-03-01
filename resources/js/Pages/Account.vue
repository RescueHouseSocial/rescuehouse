<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Account</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-8 px-8 mx-auto w-full">
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <AccountSocial
                :followerscount="followerscount"
                :followingcount="followingcount"
                :postcount="postcount"
              />
              <AccountLgDisplay
                :users="users"
                :avatar="avatar"
                :follow="follow"
                @following="handleFollowing"
              />
              <AccountLgPosts
                :myposts="myposts"
                :myreplies="myreplies"
                :mygalleries="mygalleries"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import axios from 'axios';

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';

  import AccountSocial from "@/Components/AccountSocial.vue";
  import AccountLgDisplay from "@/Components/AccountLgDisplay.vue";
  import AccountLgPosts from "@/Components/AccountLgPosts.vue";

  const props = defineProps(["users", "avatar", "follow", "followerscount", "followingcount", "postcount", "myposts", "myreplies", "mygalleries"]);

  const handleFollowing = async (following) => {
    try {
      const response = await axios.post(route("account.follow"), { following });
    } catch (error) {
      console.error('Error:', error);
    }
  }

</script>
