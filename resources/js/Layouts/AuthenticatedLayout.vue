<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
              <Link :href="route('home')"><ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/></Link>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
              <NavLink :href="route('feeds')" :active="route().current('feeds')"><i class="fa-solid fa-house-chimney fa-fw fa-2xl"></i></NavLink>
              <NavLink :href="route('account')" :active="route().current('account')"><i class="fa-solid fa-circle-user fa-fw fa-2xl"></i></NavLink>
              <NavLink :href="route('post')" :active="route().current('post')"><i class="fa-solid fa-pen-to-square fa-fw fa-2xl"></i></NavLink>
              <NavLink :href="route('market')" :active="route().current('market')"><i class="fa-solid fa-store fa-fw fa-2xl"></i></NavLink>
              <NavLink :href="route('calendar')" :active="route().current('calendar')"><i class="fa-regular fa-calendar-days fa-fw fa-2xl"></i></NavLink>
            </div>
          </div>
          <div class="hidden sm:flex sm:items-center sm:ms-6">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                      {{ $page.props.auth.user.name }}
                      <svg
                        class="ms-2 -me-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                      </svg>
                    </button>
                  </span>
                </template>
                <template #content>
                  <DropdownLink :href="route('settings')"> Settings </DropdownLink>
                  <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                </template>
              </Dropdown>
            </div>
          </div>
          <!-- Hamburger -->
          <div class="-me-2 flex items-center sm:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
              >
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                  :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown,
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown,
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <!-- Responsive Navigation Menu -->
      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <ResponsiveNavLink :href="route('feeds')" :active="route().current('feeds')"><i class="fa-solid fa-house-chimney fa-fw fa-2xl"></i><span class="leading-relaxed text-base text-gray-400">Feeds</span></ResponsiveNavLink>
          <ResponsiveNavLink :href="route('account')" :active="route().current('account')"><i class="fa-solid fa-circle-user fa-fw fa-2xl"></i><span class="leading-relaxed text-base text-gray-400">Account</span></ResponsiveNavLink>
          <ResponsiveNavLink :href="route('post')" :active="route().current('post')"><i class="fa-solid fa-pen-to-square fa-fw fa-2xl"></i><span class="leading-relaxed text-base text-gray-400">Post</span></ResponsiveNavLink>
          <ResponsiveNavLink :href="route('market')" :active="route().current('market')"><i class="fa-solid fa-store fa-fw fa-2xl"></i><span class="leading-relaxed text-base text-gray-400">Market</span></ResponsiveNavLink>
          <ResponsiveNavLink :href="route('calendar')" :active="route().current('calendar')"><i class="fa-regular fa-calendar-days fa-fw fa-2xl"></i><span class="leading-relaxed text-base text-gray-400">Calendar</span></ResponsiveNavLink>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="px-4">
            <div class="font-medium text-base text-gray-800">
              {{ $page.props.auth.user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
          </div>
          <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('settings')"> Settings </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
          </div>
        </div>
      </div>
    </nav>
    <!-- Page Heading -->
    <header class="bg-white shadow" v-if="$slots.header">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <slot name="header" />
      </div>
    </header>
    <!-- Page Content -->
    <main>
      <slot />
    </main>

    <footer class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap md:text-left text-center order-first">
          <div class="lg:w-1/4 md:w-1/2 w-full px-4">
            <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">pages</h2>
            <nav class="list-none mb-10">
              <li>
                <a href="/about" class="text-gray-600 hover:text-gray-800">About</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
              </li>
            </nav>
          </div>
          <div class="lg:w-1/4 md:w-1/2 w-full px-4">
            <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">help</h2>
              <nav class="list-none mb-10">
              <li>
                <a class="text-gray-600 hover:text-gray-800">First Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
              </li>
            </nav>
          </div>
          <div class="lg:w-1/4 md:w-1/2 w-full px-4">
            <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">company</h2>
            <nav class="list-none mb-10">
              <li>
                <a class="text-gray-600 hover:text-gray-800">First Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Second Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Third Link</a>
              </li>
              <li>
                <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
              </li>
            </nav>
          </div>
          <div class="lg:w-1/4 md:w-1/2 w-full px-4">
            <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">subscribe</h2>
            <div class="flex xl:flex-nowrap md:flex-nowrap lg:flex-wrap flex-wrap justify-center items-end md:justify-start">
              <div class="relative w-40 sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4 mr-2">
                <label for="footer-field" class="leading-7 text-sm text-gray-600">Email Address</label>
                <input type="text" id="footer-field" name="footer-field" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
              <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">Button</button>
            </div>
            <p class="text-gray-500 text-sm mt-2 md:text-left text-center">no spam guarantee</p>
          </div>
        </div>
      </div>
      <div class="bg-gray-100">
        <div class="container px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
          <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
            <img src="../../images/paw.png"/>
          </a>
          <p class="text-sm text-gray-500 sm:ml-6 sm:mt-0 mt-4">&copy; 2023 - 2024</p>
          <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
            <a href="https://facebook.com" class="text-gray-500">
              <i class="fa-brands fa-square-facebook fa-fw fa-2xl"></i>
            </a>
            <a href="https://threads.net" class="ml-3 text-gray-500">
              <i class="fa-brands fa-square-threads fa-fw fa-2xl"></i>
            </a>
            <a href="https://instagram.com" class="ml-3 text-gray-500">
              <i class="fa-brands fa-square-instagram fa-fw fa-2xl"></i>
            </a>
            <a href="https://youtube.com" class="ml-3 text-gray-500">
              <i class="fa-brands fa-square-youtube fa-fw fa-2xl"></i>
            </a>
          </span>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>

  import { ref } from 'vue';
  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import NavLink from '@/Components/NavLink.vue';
  import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
  import { Link } from '@inertiajs/vue3';

  const showingNavigationDropdown = ref(false);

</script>
