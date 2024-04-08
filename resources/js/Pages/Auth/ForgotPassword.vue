<template>
  <GuestLayout>
    <div class="bg-white min-h-screen">
      <div class="container px-5 py-24 mx-auto">
        <div class="mb-4 text-sm text-gray-600">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">{{ status }}</div>
        <div class="flex justify-center">
          <form @submit.prevent="submit" class="w-full md:w-1/2">
            <div>
              <InputLabel for="email" value="Email Address" />
              <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
              />
              <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <button class="flex text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Email Password Reset Link</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>

  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  // import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, useForm } from '@inertiajs/vue3';

  defineProps({
    status: {
      type: String,
    },
  });

  const form = useForm({
    email: '',
  });

  const submit = () => {
    form.post(route('password.email'));
  };

</script>
