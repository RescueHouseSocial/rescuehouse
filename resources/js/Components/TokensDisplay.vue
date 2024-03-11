<template>
  <div id="TokenGallery">
    <Flicking :options="{ circular: true }" :plugins="plugins">
      <div v-for="token in sortedTokens" :key="token.id">
        <div 
          @click="handleTokenSelection(token)"
          class="grid grid-cols-1 gap-4 content-center cursor-pointer hover:bg-gray-100"
          :class="{ 'border-2 border-transparent': !token.selected, 'border-dashed border-2 border-orange-400': token.selected }"
        >
          <img :src="`/storage/tokens/small/${token.path}`" class="rounded" alt="tokens"/>
          <div class="flex flex-col items-center">
            <div class="font-normal text-gray-700">{{ token.name }}</div>
            <div class="font-normal text-gray-700">${{ token.price * 100 }}</div>
          </div>
        </div>
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
    name: "Tokens",
    props:["tokens", "type"],
    components: {
      Flicking,
    },
    data() {
      return {
        clicked: false,
        plugins: [new Arrow(), new Pagination({ type: 'bullet' })],
      };
    },
    computed: {
      sortedTokens() {
        return this.tokens.filter(token => token.type === this.type);
      },
    },
    methods: {
      async handleTokenSelection(token) {
        token.selected = !token.selected;
        this.$emit("token-toggle", token.tokenId);
      }
    },
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