<template>
  <AuthenticatedLayout>
    <Head title="Live Home" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Live</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="w-full">
          <div v-if="template === 'many'">
            <Many
              :opentok_api_key = "opentok_api_key"
              :sessionId = "sessionId"
              :token = "token"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  // import axios from "axios";

  import Many from "./Many.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  // import { ref, computed, onMounted } from "vue";
  
  import { Head, useForm } from "@inertiajs/vue3";

  // import { DateTime } from "luxon";

  // var pusher = new Pusher("9320384060910ab45950", {
  //   cluster: "us3"
  // });

  // var channel = pusher.subscribe("my-channel");
  // channel.bind("my-event", function(data) {
  //   getAllThreadMessages();
  // });

  // let isLoading = ref(false);
  // let characterCount = ref(0);
  // let messages = ref([]);
  // const scrollableDiv = ref(null);

  const props = defineProps(["template", "postId", "opentok_api_key", "sessionId", "token"]);

  // const form = useForm({
  //   thread: props.threadId,
  //   body: "",
  // });

  // const displayDateTime = ref(DateTime.now().toLocaleString(DateTime.DATETIME_FULL));

  // onMounted(() => {
  //   getAllThreadMessages();
  //   scrollToBottom();
  //   setInterval(() => {
  //     displayDateTime.value = DateTime.now().toLocaleString(DateTime.DATETIME_FULL);
  //   }, 1000);
  // });

  // const getAllThreadMessages = async () => {
  //   try {
  //     const response = await axios.post(route("messages.refresh"), { 
  //       threadId: props.threadId,  
  //     });
  //     messages.value = response.data.messages;
  //     await new Promise(resolve => setTimeout(resolve, 1500));
  //     scrollToBottom();
  //   } catch (error) {
  //     console.error('Error:', error);
  //   }
  // };

  // const handleMessageSubmit = async () => {
  //   isLoading.value = true;
  //   await new Promise(resolve => setTimeout(resolve, 1500));
  //   form.put(route("messages.update"), {
  //     preserveScroll: true,
  //     onSuccess: () => {
  //       form.reset();
  //       isLoading.value = false;
  //     },
  //     onError: () => {
  //       console.log("error");
  //       isLoading.value = false;
  //     },
  //   });
  //   scrollToBottom();
  // };

  // const formatDate = (updated_at) => {
  //   return DateTime.fromISO(updated_at).toLocaleString(DateTime.DATETIME_FULL);
  // };

  // const updateCharacterCount = () => {
  //   const maxLength = 60000;
  //   let limitedText = form.body.slice(0, maxLength);
  //   form.body = limitedText;
  //   characterCount.value = limitedText.length;
  // };

  // updateCharacterCount();

  // async function scrollToBottom() {
  //   await new Promise(resolve => setTimeout(resolve, 1500));
  //   if (scrollableDiv.value) {
  //     scrollableDiv.value.scrollTop = scrollableDiv.value.scrollHeight + 200;
  //   }
  // }

</script>