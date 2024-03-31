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
                <div @click="rescue"
                  :class="{ 'text-orange-400 border-b-2 border-gray-600 rounded-t-lg active': activeTab === 'rescue' }"
                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 cursor-pointer">Rescue
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
        <div v-if="activeTab === 'social'">
          <div class="flex flex-col justify-center">
            <div v-if="isLoading" class="my-8">
              <div class="flex justify-center">
                <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
              </div>
            </div>
            <div v-else>
              <div v-for="post in socialposts" :key="post.id">
                <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                  <div class="items-center bg-gray-50 rounded-lg shadow">
                    <div class="grid grid-cols-1 gap-4">
                      <DynamicPostDisplay
                        :post="post"
                        :mybank="mybank"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="activeTab === 'rescue'">
          <div class="flex flex-col justify-center">
            <div v-if="isLoading" class="my-8">
              <div class="flex justify-center">
                <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
              </div>
            </div>
            <div v-else>
              <div v-for="post in rescueposts" :key="post.id">
                <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                  <div class="items-center bg-gray-50 rounded-lg shadow">
                    <div class="grid grid-cols-1 gap-4">
                      <DynamicPostDisplay
                        :post="post"
                        :mybank="mybank"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="activeTab === 'interactive'">
          <div class="flex flex-col justify-center">
            <div v-if="isLoading" class="my-8">
              <div class="flex justify-center">
                <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
              </div>
            </div>
            <div v-else>
              <div v-for="post in interactiveposts" :key="post.id">
                <div class="py-4 px-8 mx-auto w-full md:w-3/5">
                  <div class="items-center bg-gray-50 rounded-lg shadow">
                    <div class="grid grid-cols-1 gap-4">
                      <DynamicPostDisplay
                        :post="post"
                        :mybank="mybank"
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
  </AuthenticatedLayout>
</template>

<script setup>

  import axios from "axios";

  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  
  import { Head } from "@inertiajs/vue3";

  import { ref, onMounted } from "vue";

  let isLoading = ref(false);
  let activeTab = ref("social");
  let socialposts = ref([]);
  let rescueposts = ref([]);
  let interactiveposts = ref([]);
  let mybank = ref([]);

  onMounted(async () => {
    const response = await axios.get(route("feeds.social"));
    socialposts.value = response.data.posts;
    mybank.value = response.data.mybank;
  });

  const social = async () => {
    activeTab.value = "social";
    isLoading.value = true;
    const response = await axios.get(route("feeds.social"));
    await new Promise(resolve => setTimeout(resolve, 500));
    socialposts.value = response.data.posts;
    mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const rescue = async () => {
    activeTab.value = "rescue";
    isLoading.value = true;
    const response = await axios.get(route("feeds.rescue"));
    await new Promise(resolve => setTimeout(resolve, 500));
    rescueposts.value = response.data.posts;
    mybank.value = response.data.mybank;
    isLoading.value = false;
  }

  const interactive = async () => {
    activeTab.value = "interactive";
    isLoading.value = true;
    const response = await axios.get(route("feeds.interactive"));
    await new Promise(resolve => setTimeout(resolve, 500));
    interactiveposts.value = response.data.posts;
    mybank.value = response.data.mybank;
    isLoading.value = false;
  }

</script>
