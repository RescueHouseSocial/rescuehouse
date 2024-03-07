<template>
  <AuthenticatedLayout>
    <Head title="Checkout" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-8xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <div class="py-8 px-8 mx-auto w-full">
            <div class="grid gap-8 mb-4 md:grid-cols-1">
              <CheckoutDisplay
                :checkouts="checkouts"
                :tokens="tokens"
                :totalPrice="totalPrice"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import CheckoutDisplay from "../Components/CheckoutDisplay.vue";

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  import { Head } from '@inertiajs/vue3';

  const props = defineProps(["checkouts", "tokens", "totalPrice"]);

</script>
