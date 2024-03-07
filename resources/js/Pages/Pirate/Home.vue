<template>
  <AuthenticatedLayout>
    <Head title="Pirate Home" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pirate</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-0 px-4 md:py-8 md:px-8 mx-auto w-full">
            User Accounts
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <!-- v-for="user in users" :key="user.id"  -->
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <div class="w-full p-4">
                  <div class="flex flex-row">
                    <div class="mx-2">:)</div>
                    <div class="mx-2">NAME</div>
                    <div class="mx-2">FOLLOWERS</div>
                    <div class="mx-2">FOLLOWING</div>
                    <div class="mx-2">BANK</div>
                  </div>
                </div>
              </div>
            </div>
            Posts
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <!-- v-for="user in users" :key="user.id"  -->
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleSubmit" class="w-full p-4">
                  Edit Posts
                </form>
              </div>
            </div>
            Tokens
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleTokenSubmit" class="w-full p-4">
                  <div v-if="successMessage" class="p-4 mb-4 text-sm text-orange-400 rounded-lg bg-yellow-50" role="alert">
                    <span class="font-medium">Success:</span> {{ successMessage }}
                  </div>
                  <div class="flex flex-col mx-4 my-4 mx-auto">
                    <div class="flex flex-wrap mb-4">
                      <div v-for="token in tokens" :key="token.id">
                        <img :src="`/storage/tokens/medium/${token.path}`" class="w-12 h-12 mx-4 my-4 rounded-lg" alt="tokens"/>
                      </div>
                    </div>
                    <div class="mb-4">
                      <label for="name" clas="leading-7 text-sm text-gray-600">Name</label>
                      <input id="name" v-model="form.name" class="w-full" maxlength="26"/>
                    </div>
                    <div class="mb-4">
                      <label for="price" clas="leading-7 text-sm text-gray-600">Price</label>
                      <CurrencyInput
                        v-model="form.price"
                        :options="{ currency: 'USD' }"
                      />
                    </div>
                    <div class="mb-4">
                      <DragAndDropToken
                        @token-add="handleTokenAdd"
                      />
                    </div>
                    <div class="flex justify-end">
                      <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                        <span v-if="isLoading">
                          <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                        </span>
                        <span v-else>
                          Create
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

  import axios from "axios";

  import { ref } from "vue";

  import CurrencyInput from "../../Components/CurrencyInput.vue";
  import DragAndDropToken from "../../Components/DragAndDropToken.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { Head, useForm } from "@inertiajs/vue3";

  let isLoading = ref(false);
  let successMessage = ref("");
  let files = [];

  const props = defineProps(["users", "avatar", "tokens"]);

  const form = useForm({
    name: "",
    price: 0,
    file: null,
  });

  const handleTokenAdd = async (data) => {
    form.file = data;
  };

  const handleTokenSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    await axios.post(route("pirate.createtoken"), {
      name: form.name,
      price: form.price,
      file: form.file,
    })
    .then(response => {
      successMessage.value = response.data.success;
    })
    .catch(error => {
      console.error("Error:", error);
    });
    isLoading.value = false;
    window.location.reload();
  };

</script>