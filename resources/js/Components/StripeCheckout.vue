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

  import axios from "axios";

  import { v4 as uuidv4 } from "uuid";

  const stripe = Stripe(import.meta.env.VITE_STRIPE_KEY);
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
      // this.checkStatus();
    },
    methods: {
      async initialize() {
        await axios.post(route("checkout.createPayment"), {
          checkoutId: this.checkoutId,
        })
        .then(response => {
          const { output, message } = response.data;
          const clientSecret = output.clientSecret;
          elements = stripe.elements({clientSecret});
          const paymentElementOptions = {
            layout: "tabs",
          };
          const paymentElement = elements.create("payment", paymentElementOptions);
          paymentElement.mount("#payment-element");
        })
        .catch(error => {
          console.error("Error:", error);
        });
      },
      // async checkStatus() {},
      async handleStripeSubmit() {
        this.isLoading = true;
        await new Promise(resolve => setTimeout(resolve, 1500));
        const { error } = await stripe.confirmPayment({
          elements,
          confirmParams: {
            return_url: "http://127.0.0.1:8000/market",
          },
          redirect: "if_required",
        });
        if (error) {
          console.log(error);
        }
        await axios.post(route("checkout.processPayment"), {
          checkoutId: this.checkoutId,
        })
        .then(response => {
          window.location.href = `/market`;
        })
        .catch(error => {
          console.error("Error:", error);
        });
        this.isLoading = false;
      },
      // async showMessage(messageText) {},
    }
  };

</script>