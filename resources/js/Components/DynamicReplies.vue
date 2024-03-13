<template>
  <div id="DynamicReplies">
    <div v-for="user in users" :key="user.id" class="items-center">
      <form @submit.prevent="handleSubmit" class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <div class="flex flex-col-reverse md:flex-row md:justify-between">
            <label for="body" clas="leading-7 text-sm text-gray-600">Post</label>
            <div>{{ user.name }} at {{ displayDateTime }}</div>
          </div>
          <textarea id="body" v-model="form.body" class="h-32"></textarea>
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
    <div v-for="post in replies" :key="post.id" class="items-center bg-gray-50 rounded-lg shadow sm:flex mb-4">
      <DynamicPostDisplay
        :post="post"
      />
    </div>
  </div>
</template>

<script setup>

  import DynamicPostDisplay from "../Components/DynamicPostDisplay.vue";

  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  let currentDateTime = DateTime.local();
  let formatDateTime = DateTime.now().toISO();
  let displayDateTime = `${currentDateTime.toLocaleString(DateTime.DATETIME_FULL)}`;
  let isLoading = false;

  const props = defineProps(["post", "users", "replies"]);

  const form = useForm({
    postId: props.post["postId"],
    body: "",
    datetime8601: formatDateTime,
  });

  const handleSubmit = () => {
    isLoading = true;
    form.put(route("reply.store"), {
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