<template>
  <div id="MarketDisplay">
    <div class="flex flex-wrap my-4">
      <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
        <div v-for="token in tokens" :key="token.id" class="items-center bg-gray-50 rounded-lg shadow mb-4 box">
          <!-- <div class="ribbon ribbon-top-right"><span>ribbon</span></div> -->
          <div 
            @click="handleTokenToggle(token)"
            class="grid grid-cols-1 gap-4 content-center cursor-pointer hover:bg-gray-100"
            :class="{ 'border-2 border-transparent': !token.selected, 'border-dashed border-2 border-orange-400': token.selected }"
          >
            <img :src="`/storage/tokens/small/${token.path}`" class="rounded" alt="tokens"/>
            <div class="flex flex-col items-center">
              <div class="font-normal text-gray-700">{{ token.name }}</div>
              <div class="font-normal text-gray-700">${{ token.price / 100 }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form @submit.prevent="handleCheckoutSubmit" class="items-center bg-gray-50 rounded-lg shadow">
      <div class="flex flex-col p-4 mx-4 my-4 mx-auto">
        <div class="mb-8">
          <div class="grid grid-cols-2 md:grid-cols-8 gap-4">
            <div v-for="(item, index) in currentCart" :key="index">
              <div class="bg-gray-50 rounded-lg shadow">
                <img :src="`/storage/tokens/small/${item.path}`" class="rounded" alt="tokens"/>
                <div class="flex flex-col items-center">
                  <div class="font-normal text-gray-700">{{ item.name }}</div>
                  <div class="font-normal text-gray-700">${{ item.price / 100 }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
            <span v-if="isLoading">
              <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
            </span>
            <span v-else>
              Checkout
            </span>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>

  import axios from 'axios';
  
  import { ref, computed } from "vue";

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

  const handleTokenToggle = async (token) => {
    token.selected = !token.selected;
    const index = checkoutTokens.value.indexOf(token.tokenId);
    if (index === -1) {
      checkoutTokens.value.push(token.tokenId);
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
    await new Promise(resolve => setTimeout(resolve, 500));
    await axios.post(route("market.store"), { 
      checkoutTokens: checkoutTokens.value,
    })
    .then(response => {
      window.location.href = `/checkout/${response.data.checkoutId}`;
    })
    .catch(error => {
      isLoading.value = false;
      console.error("Error:", error);
    });
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