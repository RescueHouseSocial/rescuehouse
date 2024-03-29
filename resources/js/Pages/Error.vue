<template>
  <div id="Error">
    {{ error }}
  </div>
</template>

<script setup>

  const props = defineProps(["error"]);

</script>