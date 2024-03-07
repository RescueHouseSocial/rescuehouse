<template>
  <div id="MarketDisplay">
    <!-- <p>free</p> -->
    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 box">
      <!-- <div class="ribbon ribbon-top-right"><span>ribbon</span></div> -->
      <TokensDisplay
        :tokens="tokens"
        :type="freeType"
        @token-toggle="handleTokenToggle"
      />
    </div>
    <!-- <p>exclusive</p> -->
    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 box">
      <!-- <div class="ribbon ribbon-top-right"><span>ribbon</span></div> -->
      <TokensDisplay
        :tokens="tokens"
        :type="exclusiveType"
        @token-toggle="handleTokenToggle"
      />
    </div>
    <!-- <p>premium</p> -->
    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 box">
      <!-- <div class="ribbon ribbon-top-right"><span>ribbon</span></div> -->
      <TokensDisplay
        :tokens="tokens"
        :type="premiumType"
        @token-toggle="handleTokenToggle"
      />
    </div>
    <div class="items-center bg-gray-50 rounded-lg shadow mb-4">
      <div class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <div>
            <div v-for="(item, index) in currentCart" :key="index">
              {{ item.name }}
              <img :src="`/storage/tokens/medium/${item.path}`" class="rounded h-32 w-32" alt="tokens"/>
            </div>
          </div>
          <div class="flex justify-end">
            <form @submit.prevent="handleCheckoutSubmit" class="w-full p-4">
              <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                <span v-if="isLoading">
                  <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                </span>
                <span v-else>
                  Checkout
                </span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import axios from 'axios';

  import { ref, computed } from "vue";

  import TokensDisplay from "../Components/TokensDisplay.vue";

  const props = defineProps(["tokens"]);

  const freeType = "free";
  const exclusiveType = "exclusive";
  const premiumType = "premium";
  
  let isLoading = ref(false);
  const checkoutTokens = ref([]);
  const currentCart = ref([]);

  const handleTokenDisplay = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    await axios.post(route("market.cart"), { 
      checkoutTokens: checkoutTokens.value,
    })
    .then(response => {
      currentCart.value = response.data.tokenDetails;
    })
    .catch(error => {
      console.error("Error:", error);
    });
    isLoading.value = false;
  }

  const handleTokenToggle = async (tokenId) => {
    const index = checkoutTokens.value.indexOf(tokenId);
    if (index === -1) {
      checkoutTokens.value.push(tokenId);
    } else {
      checkoutTokens.value.splice(index, 1);
    }
    handleTokenDisplay();
  }

  const updatedCheckoutTokens = computed(() => {
    return [...checkoutTokens.value];
  });

  const handleCheckoutSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    await axios.post(route("market.store"), { 
      checkoutTokens: checkoutTokens.value,
    })
    .then(response => {
      successMessage.value = response.data.success;
    })
    .catch(error => {
      console.error("Error:", error);
    });
    isLoading.value = false;
  }

</script>

<style>
  .box {
    position: relative;
  }

  /* common */
  .ribbon {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: absolute;
  }
  .ribbon::before,
  .ribbon::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #2980b9;
  }
  .ribbon span {
    position: absolute;
    z-index: 999;
    display: block;
    width: 225px;
    padding: 15px 0;
    background-color: #3498db;
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
    color: #fff;
    font: 700 18px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0,0,0,.2);
    text-transform: uppercase;
    text-align: center;
  }

  /* top right*/
  .ribbon-top-right {
    top: -10px;
    right: -10px;
  }
  .ribbon-top-right::before,
  .ribbon-top-right::after {
    border-top-color: transparent;
    border-right-color: transparent;
  }
  .ribbon-top-right::before {
    top: 0;
    left: 0;
  }
  .ribbon-top-right::after {
    bottom: 0;
    right: 0;
  }
  .ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg);
  }

</style>