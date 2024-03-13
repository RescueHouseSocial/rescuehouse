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
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <div class="w-full p-4">
                  <div class="py-4 mb-4 border-b-2 border-gray-200">
                    <div class="invisible md:visible grid grid-cols-12 gap-1 text-center bg-gray-200 my-2 py-2 px-2">
                      <div>(id)</div>
                      <div class="col-span-2">name</div>
                      <div class="col-span-2">email</div>
                      <div class="col-span-4">created at</div>
                      <div>ban</div>
                      <div>active</div>
                      <div>a pirate</div>
                    </div>
                    <div v-for="user in users.data" :key="user.id" class="grid grid-rows-1 md:grid-cols-12 gap-1 text-start md:text-center bg-gray-200 my-2 py-2 px-2">
                      <div>({{user.id}})</div>
                      <div class="col-span-2">{{ user.name }}</div>
                      <div class="col-span-2">{{ user.email }}</div>
                      <div class="col-span-4">{{ user.created_at }}</div>
                      <div>{{ user.ban }}</div>
                      <div>{{ user.active }}</div>
                      <div>{{ user.pirate }}</div>
                    </div>
                  </div>
                  <ul class="flex flex-wrap pt-2 my-2 items-center justify-center text-gray-900">
                    <li v-for="link in users.links" :key="link.id" class="mx-2">
                      <a :href="link.url" :title="link.active" v-html="link.label" :class="link.active ? 'inline-flex items-center px-1 pt-1 border-b-2 border-gray-400 text-sm font-medium leading-5 text-orange-400 focus:outline-none focus:border-gray-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'"></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            Social Posts
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <!-- v-for="user in users" :key="user.id"  -->
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleSubmit" class="w-full p-4">
                  Edit Posts
                </form>
              </div>
            </div>
            Rescue Posts
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <!-- v-for="user in users" :key="user.id"  -->
              <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
                <form @submit.prevent="handleSubmit" class="w-full p-4">
                  Edit Posts
                </form>
              </div>
            </div>
            Interactive Posts
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
                      <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                        <div v-for="token in tokens" :key="token.id">
                          <TokenItem 
                            :token="token"
                          />
                        </div>
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
  import TokenItem from "../../Components/TokenItem.vue";

  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { Head, useForm } from "@inertiajs/vue3";

  let isLoading = ref(false);
  let successMessage = ref("");
  let files = [];

  const props = defineProps(["tokens", "users"]);

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