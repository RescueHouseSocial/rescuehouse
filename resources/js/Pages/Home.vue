<template>
  <GuestLayout>
    <Head title="Home" />
    <div id="Home">
      <!-- <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-20">
          <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4 uppercase">Welcome to our social sanctuary, where every creature finds refuge and care.</h1>
          <div class="flex mt-6 justify-center">
            <div class="w-16 h-1 rounded-full bg-gray-500 inline-flex"></div>
          </div>
        </div>
      </div> -->
      <div class="bg-orange-400">
        <div class="py-24 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
          <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 uppercase">start today</h2>
            <button class="flex mx-auto mt-16 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">sign up now</button>
          </div>
        </div>
      </div>
      <div class="bg-white">
        <div class="container flex md:flex-row flex-col px-4 py-24 mx-auto items-center">
          <SuccessGallery></SuccessGallery>
        </div>
      </div>
      <div class="bg-white">
        <div class="container mx-auto flex px-4 py-24 flex-col items-center">
          <RescuingCards></RescuingCards>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>

  import { Head } from '@inertiajs/vue3';

  import GuestLayout from "@/Layouts/GuestLayout.vue";

  import SuccessGallery from "../Components/SuccessGallery.vue";
  import RescuingCards from "../Components/RescuingCards.vue";

</script>