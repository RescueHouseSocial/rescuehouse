<template>
  <div id="CheckoutDisplay">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 bg-gray-50 rounded-lg shadow">
        <div v-for="(items, key) in tokens" :key="key">
          <div v-for="item in items" :key="item.id" class="mb-16">
            <div class="flex justify-between items-end border-dashed border-b-4 border-gray-300 pb-2 mb-4">
              <img :src="`/storage/tokens/small/${item.path}`" class="h-12 w-12 rounded" alt="tokens"/>
              <div class="font-normal text-gray-700">${{ item.price }}</div>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <div class="flex flex-col text-end">
            <span class="font-normal text-gray-700">Sub Total: ${{ totalPrice }}</span>
            <span class="font-normal text-gray-700">Fee: ${{ totalPrice }}</span>
            <span class="font-normal text-gray-700">Total: ${{ totalPrice }}</span>
          </div>
        </div>
      </div>
      <div class="sticky top-0">
        <StripeCheckout></StripeCheckout>
      </div>
    </div>











    <!-- CheckoutDisplay
    <pre>{{ checkouts }}</pre>
    <pre>{{ tokens }}</pre>
    <pre>{{ totalPrice }}</pre>
    <StripeCheckout></StripeCheckout> -->
  </div>
</template>

<script setup>

  import StripeCheckout from "../Components/StripeCheckout.vue";

  const props = defineProps(["checkouts", "tokens", "totalPrice"]);

</script>