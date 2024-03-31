<template>
  <transition name="modal-fade">
    <div @click="close" class="modal-backdrop close">
      <div class="modal h-3/4 w-3/4 md:h-1/2 md:w-1/2 shadow rounded p-4">
        <div v-if="successMessage" class="p-4 mb-4 text-sm text-orange-400 rounded-lg bg-yellow-50" role="alert">
          <span class="font-medium">Success:</span> {{ successMessage }}
        </div>
        <header class="modal-header">
          <div class="flex justify-between items-center">
            <div class="mb-2 text-2xl font-bold tracking-tight text-gray-900">transfer tokens</div>
            <i @click="close" class="fa-solid fa-xmark fa-fw cursor-pointer close"></i>
          </div>
        </header>
        <section class="modal-body">
          <p class="mb-5 font-light text-gray-500">displayed are your tokens. select tokens to transfer</p>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div v-for="(tokens, tokenId) in mybank" :key="tokenId">
              <div v-for="token in tokens" :key="token.id" class="items-center bg-gray-50 rounded-lg shadow mb-4 box">
                <div 
                  @click="handleTokenToggle(token)"
                  :id="`token-${tokenId}`"
                  class="grid grid-cols-1 gap-4 content-center cursor-pointer hover:bg-gray-100"
                  :class="{ 'border-2 border-transparent': !token.selected, 'border-dashed border-2 border-orange-400': token.selected }"
                >
                  <img :src="`/storage/tokens/small/${token.path}`" class="rounded" alt="tokens"/>
                  <div class="flex flex-col items-center">
                    <div class="font-normal text-gray-700">{{ token.name }}</div>
                    <div class="font-normal text-gray-700">${{ token.price / 100 }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <footer class="modal-footer">
          <div class="flex justify-end">
            <form @submit.prevent="handleTransferTokens(checkoutTokens)">
              <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                <span v-if="isLoading">
                  <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                </span>
                <span v-else>
                  Submit
                </span>
              </button>
            </form>
          </div>
        </footer>
      </div>
    </div>
  </transition>
</template>

<script setup>

  import axios from "axios";

  import { ref, computed } from "vue";

  const props = defineProps(["postId", "mybank"]);

  const emit = defineEmits(["close"]);

  let isLoading = ref(false);
  let successMessage = ref("");
  const checkoutTokens = ref([]);

  const close = async (event) => {
    if (event.target.classList.contains("close")) {
      emit("close");
    }
  }

  const handleTransferTokens = async (tokens) => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 1500));
    for (const tokenId of tokens) {
      const divToHide = document.getElementById(`token-${tokenId}`);
      if (divToHide) {
        divToHide.style.display = "none";
      }
    }
    await axios.post(route("bank.processTransfer"), { 
      postId: props.postId, 
      tokens: tokens,
    })
    .then(response => {
      successMessage.value = response.data.success;
    })
    .catch(error => {
      console.error("Error:", error);
    });
    isLoading.value = false;
  }

  const handleTokenToggle = async (token) => {
    token.selected = !token.selected;
    const index = checkoutTokens.value.indexOf(token.tokenId);
    if (index === -1) {
      checkoutTokens.value.push(token.tokenId);
    } else {
      checkoutTokens.value.splice(index, 1);
    }
  }

</script>

<style>

  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.75);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .modal {
    background: #ffffff;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
  }

  /* .modal-header, .modal-footer {
    padding: 15px;
    display: flex;
  }

  .modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #4aae9b;
    justify-content: space-between;
  }

  .modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
  }

  .modal-body {
    position: relative;
    padding: 20px 10px;
  }

  .btn-green {
    color: white;
    background: #4aae9b;
    border: 1px solid #4aae9b;
    border-radius: 2px;
  } */

  .modal-fade-enter, .modal-fade-leave-to {
    opacity: 0;
  }

  .modal-fade-enter-active, .modal-fade-leave-active {
    transition: opacity 0.5s ease;
  }

  .box {
    position: relative;
  }

  /* common */
  .ribbon {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: absolute;
  }
  .ribbon::before,
  .ribbon::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #2980b9;
  }
  .ribbon span {
    position: absolute;
    z-index: 999;
    display: block;
    width: 225px;
    padding: 15px 0;
    background-color: #3498db;
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
    color: #fff;
    font: 700 18px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0,0,0,.2);
    text-transform: uppercase;
    text-align: center;
  }

  /* top right*/
  .ribbon-top-right {
    top: -10px;
    right: -10px;
  }
  .ribbon-top-right::before,
  .ribbon-top-right::after {
    border-top-color: transparent;
    border-right-color: transparent;
  }
  .ribbon-top-right::before {
    top: 0;
    left: 0;
  }
  .ribbon-top-right::after {
    bottom: 0;
    right: 0;
  }
  .ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg);
  }

</style>