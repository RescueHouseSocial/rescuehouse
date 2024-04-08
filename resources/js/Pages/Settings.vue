<template>
  <AuthenticatedLayout>
    <Head title="Settings" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Settings</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-0 px-4 md:py-8 md:px-8 mx-auto w-full md:w-1/2">
            Profile
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <div v-for="user in users" :key="user.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleSubmit" class="w-full p-4">
                  <div v-if="successMessage" class="p-4 mb-4 text-sm text-orange-400 rounded-lg bg-yellow-50" role="alert">
                    <span class="font-medium">Success:</span> {{ successMessage }}
                  </div>
                  <div v-if="avatar" class="max-w-24 h-auto">
                    <label clas="leading-7 text-sm text-gray-600">Avatar</label>
                    <div v-if="avatar.path && avatar.path != 'unknown.jpg'" class="items-center">
                      <img :src="`/storage/avatars/medium/${avatar.path}`" class="h-12 w-12 rounded" alt="user avatar"/>
                    </div>
                    <div v-else>
                      <img src="../../images/paw.png" class="h-12 w-12 rounded" alt="user avatar"/>
                    </div>
                  </div>
                  <div class="flex flex-col mx-4 my-4 mx-auto">
                    <div class="mb-4">
                      <label for="name" clas="leading-7 text-sm text-gray-600">Name</label>
                      <input id="name" v-model="form.name" class="w-full" maxlength="26"/>
                    </div>
                    <div class="mb-4">
                      <label for="location" clas="leading-7 text-sm text-gray-600">Location</label>
                      <input id="location" v-model="form.location" class="w-full" maxlength="125"/>
                    </div>
                    <div class="mb-4">
                      <label for="biography" clas="leading-7 text-sm text-gray-600">Biography</label>
                      <textarea id="body" v-model="form.body" @input="updateCharacterCount" class="w-full h-60"></textarea>
                      <div class="text-sm text-gray-500 mt-2">{{ characterCount }}/500 characters</div>
                    </div>
                    <div class="flex justify-end">
                      <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                        <span v-if="isLoading">
                          <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                        </span>
                        <span v-else>
                          Update
                        </span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <DragAndDropImage/>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import axios from "axios";

  import { ref } from "vue";

  import DragAndDropImage from "../Components/DragAndDropImage.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  
  import { Head, useForm } from "@inertiajs/vue3";

  let isLoading = ref(false);
  let successMessage = ref("");
  let characterCount = ref(0);

  const props = defineProps(["users", "avatar"]);

  const form = useForm({
    name: props.users[0].name,
    location: props.users[0].location,
    body: props.users[0].biography,
  });

  const handleSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    await axios.post(route("settings.update"), {
      name: form.name,
      location: form.location,
      body: form.body,
    })
    .then(response => {
      successMessage.value = response.data.success;
    })
    .catch(error => {
      console.error("Error:", error);
    });
    isLoading.value = false;
  };

  const updateCharacterCount = () => {
    const maxLength = 500;
    let limitedText = "";
    if (form.body) {
      limitedText = form.body.slice(0, maxLength);
    }
    form.body = limitedText;
    characterCount.value = limitedText.length;
  };

  updateCharacterCount();

</script>