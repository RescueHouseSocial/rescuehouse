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
          <div class="py-8 px-8 mx-auto w-full">
            <div class="bg-gray-50 rounded-lg shadow">
              <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
                <img class="w-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup.svg" alt="dashboard image">
                <img class="w-full hidden dark:block" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup-dark.svg" alt="dashboard image">
                <div class="mt-4 md:mt-0">
                  <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Let's create more tools and ideas that brings us together.</h2>
                  <p class="mb-6 font-light text-gray-500 md:text-lg">Flowbite helps you connect with friends and communities of people who share your interests. Connecting with your friends and family as well as discovering new ones is easy with features like Groups.</p>
                  <div class="flex justify-end">
                    <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                      <span v-if="isLoading">
                        <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                      </span>
                      <span v-else>
                        Go Live
                      </span>
                    </button>
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

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  import { ref } from "vue";

  import { Head } from '@inertiajs/vue3';

  import { DateTime } from "luxon";

  let isLoading = ref(false);

</script>
