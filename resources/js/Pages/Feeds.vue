<template>
  <AuthenticatedLayout>
    <Head title="Feeds" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feeds</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">

        <div class="flex justify-center">
          <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <div class="flex flex-row justify-around">
              <div class="me-2">
                <div @click="social" 
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'social' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Social
                </div>
              </div>
              <div class="me-2">
                <div @click="rescues"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'rescues' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Rescues
                </div>
              </div>
              <div class="me-2">
                <div @click="interactive"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'interactive' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Interactive
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div v-if="activeTab === 'social'">
            <div class="flex justify-center">
              <div class="py-8 px-8 mx-auto w-full md:w-1/2">
                <div class="grid gap-8 mb-4 md:grid-cols-1">
                  <div v-for="post in posts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                    <div class="flex flex-col mx-auto p-4 w-full">
                      <DynamicPostDisplay
                        :post="post"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div v-if="activeTab === 'rescues'">
            <div class="flex justify-center">
              <div class="py-8 px-8 mx-auto w-full md:w-1/2">
                <div class="grid gap-8 mb-4 md:grid-cols-1">
                  <p>Rescues</p>
                  <!-- <div v-for="post in posts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                    <div class="flex flex-col mx-auto p-4 w-full">
                      <DynamicPostDisplay
                        :post="post"
                      />
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div v-if="activeTab === 'interactive'">
            <div class="flex justify-center">
              <div class="py-8 px-8 mx-auto w-full md:w-1/2">
                <div class="grid gap-8 mb-4 md:grid-cols-1">
                  <p>Interactive</p>
                  <!-- <div v-for="post in posts" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                    <div class="flex flex-col mx-auto p-4 w-full">
                      <DynamicPostDisplay
                        :post="post"
                      />
                    </div>
                  </div> -->
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

  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  
  import { Head } from "@inertiajs/vue3";

  import { ref } from "vue";

  const props = defineProps(["posts"]);

  let activeTab = ref("social");

  const social = async () => {
    activeTab.value = "social";
  }

  const rescues = async () => {
    activeTab.value = "rescues";
  }

  const interactive = async () => {
    activeTab.value = "interactive";
  }

</script>
