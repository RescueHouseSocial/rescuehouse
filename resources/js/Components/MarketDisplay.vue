<template>
  <div id="MarketDisplay">

    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 sm:flex">
      <div class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <TokensDisplay></TokensDisplay>
        </div>
      </div>
    </div>

    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 sm:flex">
      <div class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <TokensDisplay></TokensDisplay>
        </div>
      </div>
    </div>

    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 sm:flex">
      <div class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <TokensDisplay></TokensDisplay>
        </div>
      </div>
    </div>

    <div class="items-center bg-gray-50 rounded-lg shadow mb-4 sm:flex">
      <div class="w-full p-4">
        <div class="flex flex-col mx-4 my-4 mx-auto">
          <div>CHECKOUT</div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>

  import TokensDisplay from "../Components/TokensDisplay.vue";

</script>