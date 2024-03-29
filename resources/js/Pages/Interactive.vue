<template>
  <AuthenticatedLayout>
    <Head title="Interactive" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Interactive</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <!-- <div v-if="postId">
            <DynamicLiveSession 
              :posts="posts"
              :opentok_api_key="opentok_api_key"
              :sessionId="sessionId"
              :token="token"
            />
          </div>
          <div v-else> -->
            <InteractivesDisplay
              :posts="posts"
            />
          <!-- </div> -->
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import InteractivesDisplay from "../Components/InteractivesDisplay.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  import { Head } from "@inertiajs/vue3";

  const props = defineProps(["posts"]);

</script>
