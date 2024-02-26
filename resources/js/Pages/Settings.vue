<template>
  <AuthenticatedLayout>
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
                  <div v-if="avatar" class="max-w-24 h-auto">
                    <label clas="leading-7 text-sm text-gray-600">Avatar</label>
                    <img :src="`/storage/avatars/medium/${avatar.path}`" class="rounded-md" alt="user avatar"/>
                  </div>
                  <div class="flex flex-col mx-4 my-4 mx-auto">
                    <label for="name" clas="leading-7 text-sm text-gray-600">Name</label>
                    <input id="name" v-model="form.name"/>
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

  import DragAndDropImage from "../Components/DragAndDropImage.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { Head, useForm } from "@inertiajs/vue3";

  let isLoading = false;

  const props = defineProps(["users", "avatar"]);

  const form = useForm({
    name: props.users[0].name,
  });

  const handleSubmit = () => {
    isLoading = true;
    form.patch(route("settings.update"), {
      preserveScroll: true,
      onSuccess: () => {
        isLoading = false;
      },
      onError: () => {
        console.log("error");
        isLoading = false;
      },
    });
  };

</script>