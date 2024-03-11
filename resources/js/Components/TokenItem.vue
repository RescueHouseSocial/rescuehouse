<template>
  <div id="tokenItem">
    <div class="min-h-60 border border-gray-200 rounded shadow hover:bg-gray-100">
      <img :src="`/storage/tokens/small/${token.path}`" class="mb-4 rounded" alt="tokens"/>
      <div class="flex flex-row justify-between px-4">
        <div class="font-normal text-gray-700">{{ token.name }}</div>
        <div class="font-normal text-gray-700">${{ token.price / 100 }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>

  const props = defineProps(["token"]);

</script>