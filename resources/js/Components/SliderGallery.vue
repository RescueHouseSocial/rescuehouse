<template>
  <div id="SliderGallery">
    <div class="w-full">
      <Flicking :options="{ circular: true }" :plugins="plugins">
        <!-- <div v-for="(images, index) in post.media" :key="index" class="scroll-item w-full h-full mx-2">
          <img :src="`${images.url}`" class="w-full h-full" alt="Media Images"/>
        </div> -->
        <img class="object-cover object-center rounded" alt="hero" src="https://picsum.photos/id/27/720/600">
        <img class="object-cover object-center rounded" alt="hero" src="https://picsum.photos/id/27/720/600">
        <img class="object-cover object-center rounded" alt="hero" src="https://picsum.photos/id/27/720/600">
        <template #viewport>
          <span class="flicking-arrow-prev h-full hover:bg-gradient-to-r from-gray-600"></span>
          <span class="flicking-arrow-next h-full hover:bg-gradient-to-l from-gray-600"></span>
          <div class="flicking-pagination"></div>
        </template>
      </Flicking>
    </div>
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