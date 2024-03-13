<template>
  <div id="DynamicPostRescue">
    <div v-for="user in users" :key="user.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex">
      <form @submit.prevent="handleSubmit" class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <div class="mb-8">
            <div class="flex flex-col-reverse md:flex-row md:justify-between">
              <label for="body" clas="leading-7 text-sm text-gray-600">Post</label>
              <div>{{ user.name }} at {{ displayDateTime }}</div>
            </div>
            <textarea id="body" v-model="form.body" @input="updateCharacterCount" class="w-full h-60"></textarea>
            <div class="text-sm text-gray-500 mt-2">{{ characterCount }}/60,000 characters</div>
          </div>
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
</template>

<script setup>

  import { ref, computed, onMounted } from "vue";

  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  let formatDateTime = DateTime.now().toISO();
  let isLoading = ref(false);
  let gallery = [];
  let characterCount = ref(0);

  const props = defineProps(["postId", "users"]);

  const form = useForm({
    postId: props.postId,
    body: "",
    gallery: gallery,
    datetime8601: formatDateTime,
  });

  const displayDateTime = ref(DateTime.now().toLocaleString(DateTime.DATETIME_FULL));

  onMounted(() => {
    setInterval(() => {
      displayDateTime.value = DateTime.now().toLocaleString(DateTime.DATETIME_FULL);
    }, 1000);
  });

  const handleSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    form.put(route("rescue.store"), {
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

  const updateCharacterCount = () => {
    const maxLength = 60000;
    let limitedText = form.body.slice(0, maxLength);
    form.body = limitedText;
    characterCount.value = limitedText.length;
  };

  updateCharacterCount();

</script>