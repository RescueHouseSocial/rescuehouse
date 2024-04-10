<template>
  <AuthenticatedLayout>
    <Head title="Messages Home" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages Home</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex flex-col-1 md:flex-col-2 gap-4">
          <div class="py-8 px-8 mx-auto w-full md:w-1/2">
            <div class="grid gap-4 mb-4 md:grid-cols-1">
              <div v-for="list in lists" :key="list.id" class="mx-4">
                <div v-for="thread in list" :key="thread.id">
                  <a :href="`/messages/${thread.threadId}`" class="flex items-center bg-gray-50 rounded shadow flex-row md:max-w-xl hover:bg-gray-100 mb-4">
                    <div v-if="thread.path && thread.path != 'unknown.jpg'">
                      <img :src="`/storage/avatars/medium/${thread.path}`" class="object-cover w-full h-12 md:h-auto md:w-12 rounded-none rounded-s-lg" alt="user avatar"/>
                    </div>
                    <div v-else>
                      <img src="../../../images/paw.png" class="object-cover w-full h-12 md:h-auto md:w-12 rounded-none rounded-s-lg" alt="user avatar"/>
                    </div>
                    <div class="flex flex-col justify-between leading-normal">
                      <div class="mb-1 ml-4 text font-medium text-gray-900">{{ thread.body }}</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="py-8 px-8 mx-auto w-full md:w-1/2">
            <div class="grid gap-4 mb-4 md:grid-cols-1">
              <div ref="scrollableDiv" class="max-h-96 min-h-96 w-full p-4 overflow-y-scroll border-2 border-gray-200 bg-white">
                <div v-for="item in messages" :key="item.id">
                  <div :class="[userId === item.messengerId ? 'justify-end' : 'items-start', 'flex', 'mb-4']">
                  <div v-if="item.path && item.path != 'unknown.jpg'" class="items-center">
                    <img :src="`/storage/avatars/medium/${item.path}`" class="h-8 w-8 rounded border-2 border-transparent" alt="user avatar"/>
                  </div>
                  <div v-else>
                    <img src="../../../images/paw.png" class="h-8 w-8 rounded border-2 border-transparent" alt="user avatar"/>
                  </div>
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                      <div class="flex items-center space-x-2">
                        <span class="text-sm font-semibold text-gray-900">{{ item.name }}</span>
                        <span class="text-sm font-normal text-gray-500">{{ formatDate(item.updated_at) }}</span>
                      </div>
                      <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                        <p class="text-sm font-normal text-gray-900">{{ item.body }}</p>
                      </div>
                      <span class="flex justify-end text-sm font-normal text-gray-300">{{ item.status }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <form @submit.prevent="handleMessageSubmit" @input="updateCharacterCount" class="flex my-4">
                  <div class="flex flex-row w-full">
                    <textarea v-model="form.body" class="h-12 w-full"></textarea>
                    <button class="flex text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded-tr rounded-br text-lg" type="submit">
                      <span v-if="isLoading">
                        <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                      </span>
                      <span v-else>
                        Send
                      </span>
                    </button>
                  </div>
                </form>
                <div class="text-sm text-gray-500 mt-2">{{ characterCount }}/60,000 characters</div>
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

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  import { ref, computed, onMounted } from "vue";
  
  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  var pusher = new Pusher("9320384060910ab45950", {
    cluster: "us3"
  });

  var channel = pusher.subscribe("my-channel");
  channel.bind("my-event", function(data) {
    getAllThreadMessages();
  });

  let isLoading = ref(false);
  let characterCount = ref(0);
  let messages = ref([]);
  const scrollableDiv = ref(null);

  const props = defineProps(["userId", "threadId", "addressee", "lists"]);

  const form = useForm({
    thread: props.threadId,
    body: "",
  });

  // const displayDateTime = ref(DateTime.now().toLocaleString(DateTime.DATETIME_FULL));

  onMounted(() => {
    getAllThreadMessages();
    scrollToBottom();
    // setInterval(() => {
    //   displayDateTime.value = DateTime.now().toLocaleString(DateTime.DATETIME_FULL);
    // }, 1000);
  });

  const getAllThreadMessages = async () => {
    try {
      const response = await axios.post(route("messages.refresh"), { 
        threadId: props.threadId,  
      });
      messages.value = response.data.messages;
      await new Promise(resolve => setTimeout(resolve, 500));
      scrollToBottom();
    } catch (error) {
      console.error('Error:', error);
    }
  };

  const handleMessageSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    form.put(route("messages.update"), {
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
    scrollToBottom();
  };

  const formatDate = (updated_at) => {
    const pastDate = DateTime.fromISO(updated_at);
    const now = DateTime.now();
    const diff = now.diff(pastDate, ["years", "months", "days", "hours"]).toObject();
    if (diff.years > 0) {
      const roundedYears = Math.round(diff.years);
      return `${roundedYears} year${roundedYears !== 1 ? "s" : ""} ago`;
    } else if (diff.months > 0) {
      const roundedMonths = Math.round(diff.months);
      return `${roundedMonths} month${roundedMonths !== 1 ? "s" : ""} ago`;
    } else if (diff.days > 0) {
      const roundedDays = Math.round(diff.days);
      return `${roundedDays} day${roundedDays !== 1 ? "s" : ""} ago`;
    } else if (diff.hours > 1) {
      const roundedHours = Math.round(diff.hours);
      return `${roundedHours} hour${roundedHours !== 1 ? "s" : ""} ago`;
    } else {
      return "1 hour ago";
    }
  };

  const updateCharacterCount = () => {
    const maxLength = 60000;
    let limitedText = form.body.slice(0, maxLength);
    form.body = limitedText;
    characterCount.value = limitedText.length;
  };

  updateCharacterCount();

  async function scrollToBottom() {
    await new Promise(resolve => setTimeout(resolve, 1500));
    if (scrollableDiv.value) {
      scrollableDiv.value.scrollTop = scrollableDiv.value.scrollHeight + 200;
    }
  }

</script>