<template>
  <div id="FundraisingCards">
    <Flicking :options="{ circular: true }" :plugins="plugins">
      <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        <article class="p-6 my-4 bg-white rounded-lg border border-gray-200 shadow">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
            Tutorial
            </span>
            <span class="text-sm">14 days ago</span>
          </div>
          <div class="w-50 h-50 inline-flex items-center justify-center rounded-full mb-5 flex-shrink-0">
            <img src="https://picsum.photos/id/11/520/480" class="rounded"/>
          </div>
          <div class="flex justify-between items-center text-gray-500">
            <div>
              <span class="text-lg font-bold">$1,000</span> of $8,000 goal
            </div>
            <span class="text-sm">26,096 donations</span>
          </div>
          <div class="w-full mb-4 bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><a href="#">How to quickly deploy a static website</a></h2>
          <p class="mb-5 font-light text-gray-500">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers influence both web designers and developers.</p>
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
              <span class="font-medium">
              Jese Leos
              </span>
            </div>
            <a href="#" class="inline-flex items-center font-medium text-primary-600 hover:underline">Read more<svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
          </div>
        </article>
        <article class="p-6 my-4 bg-white rounded-lg border border-gray-200 shadow">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
            Tutorial
            </span>
            <span class="text-sm">14 days ago</span>
          </div>
          <div class="w-50 h-50 inline-flex items-center justify-center rounded-full mb-5 flex-shrink-0">
            <img src="https://picsum.photos/id/11/520/480" class="rounded"/>
          </div>
          <div class="flex justify-between items-center text-gray-500">
            <div>
              <span class="text-lg font-bold">$1,000</span> of $8,000 goal
            </div>
            <span class="text-sm">26,096 donations</span>
          </div>
          <div class="w-full mb-4 bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><a href="#">How to quickly deploy a static website</a></h2>
          <p class="mb-5 font-light text-gray-500">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers influence both web designers and developers.</p>
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
              <span class="font-medium">
              Jese Leos
              </span>
            </div>
            <a href="#" class="inline-flex items-center font-medium text-primary-600 hover:underline">Read more<svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
          </div>
        </article>
      </div>
      <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        <article class="p-6 my-4 bg-white rounded-lg border border-gray-200 shadow">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
            Tutorial
            </span>
            <span class="text-sm">14 days ago</span>
          </div>
          <div class="w-50 h-50 inline-flex items-center justify-center rounded-full mb-5 flex-shrink-0">
            <img src="https://picsum.photos/id/11/520/480" class="rounded"/>
          </div>
          <div class="flex justify-between items-center text-gray-500">
            <div>
              <span class="text-lg font-bold">$1,000</span> of $8,000 goal
            </div>
            <span class="text-sm">26,096 donations</span>
          </div>
          <div class="w-full mb-4 bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><a href="#">How to quickly deploy a static website</a></h2>
          <p class="mb-5 font-light text-gray-500">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers influence both web designers and developers.</p>
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
              <span class="font-medium">
              Jese Leos
              </span>
            </div>
            <a href="#" class="inline-flex items-center font-medium text-primary-600 hover:underline">Read more<svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
          </div>
        </article>
        <article class="p-6 my-4 bg-white rounded-lg border border-gray-200 shadow">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
            Tutorial
            </span>
            <span class="text-sm">14 days ago</span>
          </div>
          <div class="w-50 h-50 inline-flex items-center justify-center rounded-full mb-5 flex-shrink-0">
            <img src="https://picsum.photos/id/11/520/480" class="rounded"/>
          </div>
          <div class="flex justify-between items-center text-gray-500">
            <div>
              <span class="text-lg font-bold">$1,000</span> of $8,000 goal
            </div>
            <span class="text-sm">26,096 donations</span>
          </div>
          <div class="w-full mb-4 bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><a href="#">How to quickly deploy a static website</a></h2>
          <p class="mb-5 font-light text-gray-500">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers influence both web designers and developers.</p>
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
              <span class="font-medium">
              Jese Leos
              </span>
            </div>
            <a href="#" class="inline-flex items-center font-medium text-primary-600 hover:underline">Read more<svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
          </div>
        </article>
      </div>
      <template #viewport>
        <span class="flicking-arrow-prev h-full hover:bg-gradient-to-r from-gray-600"></span>
        <span class="flicking-arrow-next h-full hover:bg-gradient-to-l from-gray-600"></span>
        <div class="flicking-pagination"></div>
      </template>
    </Flicking>
  </div>
</template>

<script>
  import Flicking from "@egjs/vue3-flicking";
  import { Arrow } from "@egjs/flicking-plugins";
  import { Pagination } from "@egjs/flicking-plugins";
  import "@egjs/vue3-flicking/dist/flicking.css";
  import "@egjs/flicking-plugins/dist/arrow.css";
  import "@egjs/flicking-plugins/dist/pagination.css";

  export default {
    name: "Home",
    components: {
      Flicking,
    },
    data() {
      return {
        media: [],
        plugins: [new Arrow(), new Pagination({ type: 'bullet' })],
      };
    },
    methods: {},
  };

</script>

<style scoped>
  .flicking-arrow-prev{
    left: 0 !important;
  }

  .flicking-arrow-next {
    right: 0 !important;
  }
</style>