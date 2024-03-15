<template>
  <AuthenticatedLayout>
    <Head title="Subscription" />
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Subscription</h2>
      <p class="leading-relaxed text-base text-gray-400">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug VHS try-hard.</p>
    </template>
    <div class="py-4">
      <div class="max-w-7xl min-h-screen bg-gray-100 mx-auto">
        <div class="flex justify-center">
          <DynamicPricingTable></DynamicPricingTable>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  import { Head } from '@inertiajs/vue3';

  import DynamicPricingTable from "../Components/DynamicPricingTable.vue";

</script>