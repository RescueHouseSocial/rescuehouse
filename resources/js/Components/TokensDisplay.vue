<template>
  <div id="TokenGallery">
    <div class="w-full">
      <Flicking :options="{ circular: true }" :plugins="plugins">
        <div v-for="token in sortedTokens" :key="token.id">
          <div 
            @click="handleTokenSelection(token)" 
            :class="{ 'cursor-pointer border-2 border-transparent mx-4': !token.selected, 'border-dashed border-2 border-orange-400 mx-4': token.selected }"
          >
            <img :src="`/storage/tokens/medium/${token.path}`" class="rounded h-32 w-32" alt="tokens"/>
          </div>
        </div>
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