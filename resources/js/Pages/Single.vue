<template>
  <AuthenticatedLayout>
    <Head title="Single" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex flex-col justify-center">
          <div class="py-4 px-8 mx-auto w-full md:w-3/5">
            <div class="items-center bg-gray-50 rounded-lg shadow mb-4">
              <div class="grid grid-cols-1 gap-4">
                <DynamicPostDisplay
                  :post="posts"
                />
              </div>
            </div>
            <DynamicReplies
              :post="posts"
              :users="users"
              :replies="replies"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";
  import DynamicReplies from "../Components/DynamicReplies.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { Head } from "@inertiajs/vue3";

  const props = defineProps(["posts", "users", "replies"]);

</script>