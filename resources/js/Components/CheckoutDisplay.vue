<template>
  <div id="CheckoutDisplay">
    CheckoutDisplay
    <pre>{{ checkouts }}</pre>
    <pre>{{ tokens }}</pre>
    <pre>{{ totalPrice }}</pre>
    <StripeCheckout></StripeCheckout>
  </div>
</template>

<script setup>

  import StripeCheckout from "../Components/StripeCheckout.vue";

  const props = defineProps(["checkouts", "tokens", "totalPrice"]);

</script>