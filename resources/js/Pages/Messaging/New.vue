<template>
  <AuthenticatedLayout>
    <Head title="New Messages" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Messages</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="w-full">
          <div class="flex justify-center">
            <div class="py-8 px-8 mx-auto w-full md:w-1/2">
              <div class="grid gap-4 mb-4 md:grid-cols-1">
                <div class="flex flex-row justify-between">
                  <div v-for="item in addressee" :key="item.id">
                    <div class="flex flex-row items-center">
                      <img :src="`/storage/avatars/medium/${item.path}`" class="w-8 h-8 rounded mr-4" alt="user avatar"/>
                      <div>{{ item.name }}</div>
                    </div>
                  </div>
                  <div>{{ displayDateTime }}</div>
                </div>
                <div class="max-h-96 min-h-96 w-full border-2 border-gray-200 bg-white"></div>
                <div>
                  <form @submit.prevent="handleMessageSubmit" @input="updateCharacterCount" class="flex my-4">
                    <textarea v-model="form.body" class="h-12 w-full"></textarea>
                    <button class="flex text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded-tr rounded-br text-lg" type="submit">
                      <span v-if="isLoading">
                        <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                      </span>
                      <span v-else>
                        Send
                      </span>
                    </button>
                  </form>
                  <div class="text-sm text-gray-500 mt-2">{{ characterCount }}/60,000 characters</div>
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

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  import { ref, computed, onMounted } from "vue";
  
  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  let isLoading = ref(false);
  let characterCount = ref(0);

  const props = defineProps(["message", "addressee"]);

  const form = useForm({
    body: "",
  });

  const displayDateTime = ref(DateTime.now().toLocaleString(DateTime.DATETIME_FULL));

  onMounted(() => {
    setInterval(() => {
      displayDateTime.value = DateTime.now().toLocaleString(DateTime.DATETIME_FULL);
    }, 1000);
  });

  const handleMessageSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    form.put(route("messages.store"), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        isLoading.value = false;
      },
      onError: () => {
        console.log("error");
        isLoading.value = false;
      },
    });
  };

  const formatDate = (updated_at) => {
    return DateTime.fromISO(updated_at).toLocaleString(DateTime.DATETIME_FULL);
  };

  const updateCharacterCount = () => {
    const maxLength = 60000;
    let limitedText = form.body.slice(0, maxLength);
    form.body = limitedText;
    characterCount.value = limitedText.length;
  };

  updateCharacterCount();

</script>