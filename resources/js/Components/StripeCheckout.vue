<template>
  <div id="StripeCheckout">
    <form @submit.prevent="handleStripeSubmit">
      <div class="my-4">
        <div id="payment-element"></div>
      </div>
      <div class="flex justify-end">
        <button class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded">
          <span v-if="isLoading">
            <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
          </span>
          <span v-else>
            Buy Now
          </span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>

  import { v4 as uuidv4 } from "uuid";

  const stripe = Stripe("pk_test_51NyfD1FhjVR4sV2Rg18D3LHi3v9QJssLt9JVBiXsI5FyFGZ6DDlG35jOZs6TrhAcfhMp4ihTsqJvIhhnsISO1STw00GtNAvj03");
  let elements = null;

  
  export default {
    name: "StripeCheckout",
    data() {
      return {
        checkoutId: null,
        message: null,
        uuid: uuidv4(),
        isLoading: false,
      };
    },
    async mounted() {
      const urlParts = window.location.href.split('/');
      const id = urlParts[urlParts.length - 1];
      this.checkoutId = id;
      this.initialize();
      this.checkStatus();
    },
    methods: {
      async initialize() {},
      async checkStatus() {},
      async handleStripeSubmit() {},
      async showMessage(messageText) {},
    }
  };

</script>