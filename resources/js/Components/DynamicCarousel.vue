<template>
  <div id="DynamicCarousel">
    <div v-if="galleries && galleries.length > 0">
      <div class="flex w-full overflow-hidden rounded justify-center">
        <div class="inner" ref="inner" :style="innerStyles">
          <div v-for="image in galleries" :key="image.id" class="inline-flex justify-center">
            <img :src="`/storage/gallery/medium/${image.path}`" class="rounded" alt="Gallery Image"/>
          </div>
        </div>
      </div>
      <button @click="prev" class="hover:text-orange-400"><i class="fa-solid fa-arrow-left fa-fw"></i></button>
      <button @click="next" class="hover:text-orange-400"><i class="fa-solid fa-arrow-right fa-fw"></i></button>
    </div>
  </div>
</template>

<script>

export default {

  name: "DynamicCarousel",
  props: ["galleries"],
  data () {
    return {
      innerStyles: {},
      step: '',
      transitioning: false,
    }
  },
  // mounted () {
  //   this.setStep();
  //   this.resetTranslate();
  // },
  // methods: {
  //   setStep () {
  //     if (this.galleries && this.galleries.length > 0) {
  //       const innerWidth = this.$refs.inner.scrollWidth;
  //       const totalCards = this.galleries.length;
  //       this.step = `${innerWidth / totalCards}px`;
  //     }
  //   },

  //   next () {
  //     if (this.transitioning) return;
  //     this.transitioning = true;
  //     this.moveLeft();
  //     this.afterTransition(() => {
  //       const card = this.galleries.shift();
  //       this.galleries.push(card);
  //       this.resetTranslate();
  //       this.transitioning = false;
  //     });
  //   },

  //   prev () {
  //     if (this.transitioning) return;
  //     this.transitioning = true;
  //     this.moveRight();
  //     this.afterTransition(() => {
  //       const card = this.galleries.pop();
  //       this.galleries.unshift(card);
  //       this.resetTranslate();
  //       this.transitioning = false;
  //     });
  //   },

  //   moveLeft () {
  //     this.innerStyles = {
  //       transform: `translateX(-${this.step}) translateX(-${this.step})`
  //     }
  //   },

  //   moveRight () {
  //     this.innerStyles = {
  //       transform: `translateX(${this.step}) translateX(-${this.step})`
  //     }
  //   },

  //   afterTransition (callback) {
  //     const listener = () => {
  //       callback();
  //       this.$refs.inner.removeEventListener('transitionend', listener);
  //     };
  //     this.$refs.inner.addEventListener('transitionend', listener);
  //   },

  //   resetTranslate () {
  //     this.innerStyles = {
  //       transition: 'none',
  //       transform: `translateX(-${this.step})`
  //     };
  //   }
  // }

};

</script>

<style>

  .inner {
    transition: transform 0.2s;
    white-space: nowrap;
  }

  button {
    margin-right: 5px;
    margin-top: 10px;
  }

</style>