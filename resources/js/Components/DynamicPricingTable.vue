<template>
  <div id="DynamicPricingTable">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">super charge your rescue house social experence</h2>
        <p class="mb-5 font-light text-gray-500 sm:text-xl">select a monthly plan from below and enjoy more amazing services</p>
      </div>
      <div class="space-y-8 lg:grid lg:grid-cols-1 sm:gap-6 xl:gap-10 lg:space-y-0">
        <!-- <div @click="handleSubscribeToggle('starter')" class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-gray-100 rounded-lg shadow cursor-pointer hover:bg-gray-200">
          <h3 class="mb-4 text-2xl font-semibold">Starter</h3>
          <p class="font-light text-gray-500 sm:text-lg">Our Starter plan offers essential features to meet your needs. Perfect for individuals or small businesses just starting out.</p>
          <div class="flex justify-center items-baseline my-8">
            <span class="mr-2 text-5xl font-extrabold">$19</span>
            <span class="text-gray-500">/month</span>
          </div>
          <ul role="list" class="mb-8 space-y-4 text-left">
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
          </ul>
        </div> -->
        <div @click="handleSubscribeToggle('premium')" class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-gray-50 rounded-lg shadow cursor-pointer hover:bg-gray-100">
          <h3 class="mb-4 text-2xl font-semibold">Premium</h3>
          <p class="font-light text-gray-500 sm:text-lg">Elevate your business to the next level with our Standard plan, designed and crafted solutions to meet your business needs.</p>
          <div class="flex justify-center items-baseline my-8">
            <span class="mr-2 text-5xl font-extrabold">$2</span>
            <span class="text-gray-500">/month</span>
          </div>
          <ul role="list" class="mb-8 space-y-4 text-left">
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
          </ul>
        </div>
        <!-- <div @click="handleSubscribeToggle('premium')" class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-gray-100 rounded-lg shadow cursor-pointer hover:bg-gray-200">
          <h3 class="mb-4 text-2xl font-semibold">Premium</h3>
          <p class="font-light text-gray-500 sm:text-lg">The very best advanced features, exclusive perks, our Premium plan will drive success and maximize your potential.</p>
          <div class="flex justify-center items-baseline my-8">
            <span class="mr-2 text-5xl font-extrabold">$99</span>
            <span class="text-gray-500">/month</span>
          </div>
          <ul role="list" class="mb-8 space-y-4 text-left">
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
            <li class="flex items-center space-x-3">
              <i class="fa-regular fa-circle-check fa-fw text-green-500"></i>
              <span>post-ironic four dollar toast vegan</span>
            </li>
          </ul>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script setup>

  // import axios from 'axios';
  
  // import { ref, computed } from "vue";

  // const props = defineProps(["tokens"]);

  // const freeType = "free";
  // const exclusiveType = "exclusive";
  // const premiumType = "premium";
  
  // let isLoading = ref(false);
  // const checkoutTokens = ref([]);
  // const currentCart = ref([]);

  const handleSubscribeToggle = async (type) => {
    console.log("handleSubscribeToggle " + type);
  }

</script>

