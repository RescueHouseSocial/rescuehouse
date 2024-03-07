<template>
  <div id="CurrencyInput">
    <input class="w-full" ref="inputRef" type="text"/>
  </div>
</template>

<script>
  import { useCurrencyInput } from "vue-currency-input"

  export default {
    name: "CurrencyInput",
    props: {
      modelValue: Number,
      options: Object
    },
    setup(props) {
      const { inputRef } = useCurrencyInput(props.options)
      return { inputRef }
    }
  }
</script>