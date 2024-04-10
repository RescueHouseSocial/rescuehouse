<template>
  <AuthenticatedLayout>
    <Head title="Messages" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="bg-gray-50 rounded-lg shadow p-4 mx-4 my-4">
          <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="flex flex-col col-span-2">
              <div v-for="item in messages" :key="item.id">
                <a :href="`/messages/${item.threadId}`" :class="['block', 'border', 'border-2', 'border-gray-200', 'hover:bg-gray-200', 'p-2', item.status === 'unread' ? 'border-orange-400' : '']">
                  <div>{{ item.threadId }}</div>
                </a>
              </div>
            </div>
            <div class="flex flex-col col-span-4">
              <div class="flex flex-row justify-between mb-4">
                <div v-for="item in addressee" :key="item.id">
                  <div class="flex flex-row items-center">
                    <img :src="`/storage/avatars/medium/${item.path}`" class="w-8 h-8 rounded mr-4" alt="user avatar"/>
                    <div>{{ item.name }}</div>
                  </div>
                </div>
                <div>{{ displayDateTime }}</div>
              </div>
              <div ref="scrollableDiv" class="max-h-96 min-h-96 w-full overflow-y-scroll border-2 border-gray-200 bg-white">
                <div v-for="item in message" :key="item.id">
                  <div :class="[userId === item.messengerId ? 'justify-end' : 'items-start', 'flex', 'mb-4']">
                    <div v-if="item.path && item.path != 'unknown.jpg'" class="items-center">
                      <img :src="`/storage/avatars/medium/${item.path}`" class="h-8 w-8 rounded border-2 border-transparent" alt="user avatar"/>
                    </div>
                    <div v-else>
                      <img src="../../images/paw.png" class="h-8 w-8 rounded border-2 border-transparent" alt="user avatar"/>
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
  </AuthenticatedLayout>
</template>

<script setup>

  // import DynamicLiveSession from "../Components/DynamicLiveSession.vue";
  // import InteractivesDisplay from "../Components/InteractivesDisplay.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  import { ref, computed, onMounted } from "vue";
  
  import { Head, useForm } from "@inertiajs/vue3";

  import { DateTime } from "luxon";

  let isLoading = ref(false);
  let characterCount = ref(0);
  const scrollableDiv = ref(null);

  const props = defineProps(["userId", "message", "messages", "addressee"]);
  // const currentThread = props.messages.map(message => message.threadId);
  // console.log(currentThread[0]);
  const form = useForm({
    // thread: currentThread[0],
    body: "",
    // addresseeId: props.addresseeId,
  });

  const displayDateTime = ref(DateTime.now().toLocaleString(DateTime.DATETIME_FULL));

  onMounted(() => {
    scrollToBottom();
    setInterval(() => {
      displayDateTime.value = DateTime.now().toLocaleString(DateTime.DATETIME_FULL);
    }, 1000);
  });

  const handleMessageSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 500));
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
    scrollToBottom();
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

  async function scrollToBottom() {
    await new Promise(resolve => setTimeout(resolve, 1500));
    if (scrollableDiv.value) {
      scrollableDiv.value.scrollTop = scrollableDiv.value.scrollHeight + 200;
    }
  }

</script>