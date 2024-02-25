<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-8 px-8 mx-auto w-full">
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <div v-for="user in users" :key="user.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleSubmit" class="w-full p-4">
                  <div class="flex flex-col mx-4 my-4 mx-auto">
                    <div class="flex flex-col-reverse md:flex-row md:justify-between">
                      <label for="body" clas="leading-7 text-sm text-gray-600">Post</label>
                      <div>{{ user.name }} at {{ displayDateTime }}</div>
                    </div>
                    <textarea id="body" v-model="form.body" class="h-60"></textarea>
                    <div class="flex justify-end">
                      <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                        <span v-if="isLoading">
                          <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                        </span>
                        <span v-else>
                          Post
                        </span>
                      </button>
                    </div>
                  </div>
                </form>
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
  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  let currentDateTime = DateTime.local();
  let formatDateTime = DateTime.now().toISO();
  let displayDateTime = `${currentDateTime.toLocaleString(DateTime.DATETIME_FULL)}`;
  let isLoading = false;

  const props = defineProps(['users']);

  const form = useForm({
    userId: props.users[0].userId,
    body: "",
    datetime8601: formatDateTime,
  });

  const handleSubmit = () => {
    isLoading = true;
    form.put(route("post.store"), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        isLoading = false;
      },
      onError: () => {
        console.log("error");
        isLoading = false;
      },
    });
  };

</script>
