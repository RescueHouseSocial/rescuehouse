<template>
  <div id="GuestLayout">
    <div class="flex flex-col min-h-screen scroll-smooth">
      <div :class="$page.url === '/' ? 'flex h-full w-full bg-gray-200' : 'bg-gray-400'">
        <div :class="$page.url === '/' ? 'flex-1 bg-hero bg-cover bg-center bg-no-repeat' : ''">
          <div class="container mx-auto flex flex-wrap my-4 flex-col md:flex-row items-center">
            <!-- <a href="/" class="flex items-center mb-4 md:mb-0"><img src="../../images/paw.png" alt="Logo"/></a>
            <nav class="grid grid-cols-1 gap-4 md:ml-auto md:mr-auto items-center justify-center">
              <a href="/about" class="text-white font-bold hover:text-orange-400 hover:underline underline-offset-1">About</a>
            </nav>
            <div v-if="$page.props.auth.user" class="grid grid-cols-1 gap-4">
              <a :href="route('feeds')" class="text-white font-bold hover:text-orange-400 hover:underline underline-offset-1">Social</a>
            </div>
            <div v-else>
              <div class="grid grid-cols-2 gap-4">
                <a :href="route('login')" class="text-white font-bold hover:text-orange-400 hover:underline underline-offset-1">Log in</a>
                <a :href="route('register')" class="text-white font-bold hover:text-orange-400 hover:underline underline-offset-1">Register</a>
              </div>
            </div> -->
          </div>
          <!-- <div v-if="$page.url == '/'" class="container pt-4 pb-24 mx-auto">
            <div class="text-center mb-20">
              <h1 class="text-8xl font-medium tracking-widest title-font text-orange-400 mb-4 uppercase">Rescue House</h1>
              <h2 class="text-4xl font-medium title-font text-orange-400 mb-4 uppercase">Welcome to our social sanctuary, where every creature finds refuge and care.</h2>
              <div class="flex mt-6 justify-center">
                <div class="w-16 h-1 rounded-full bg-gray-500 inline-flex"></div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <slot />
      <Footer></Footer>
    </div>
  </div>
</template>

<script setup>

  import Footer from '@/Components/Footer.vue';

</script>
