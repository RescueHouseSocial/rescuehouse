<template>
  <div id="CheckoutDisplay">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 bg-gray-50 rounded-lg shadow">
        <div v-for="(items, key) in tokens" :key="key">
          <div v-for="item in items" :key="item.id" class="mb-16">
            <div class="flex justify-between items-end border-dashed border-b-4 border-gray-300 pb-2 mb-4">
              <img :src="`/storage/tokens/small/${item.path}`" class="h-12 w-12 rounded" alt="tokens"/>
              <div class="font-normal text-gray-700">${{ item.price / 100 }}</div>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <div class="flex flex-col text-end">
            <span class="font-normal text-gray-700">Sub Total: ${{ totalPrice / 100 }}</span>
            <span class="font-normal text-gray-700">Fee: ${{ fees / 100 }}</span>
            <span class="font-normal text-gray-700">Total: ${{ totalAndFees / 100 }}</span>
          </div>
        </div>
      </div>
      <div class="sticky top-0">
        <StripeCheckout></StripeCheckout>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { onMounted, ref } from "vue";

  import StripeCheckout from "../Components/StripeCheckout.vue";

  const props = defineProps(["checkouts", "tokens", "totalPrice", "fees", "totalAndFees"]);

</script>