<template>
  <div id="DateTimePicker">
    <label for="picker" clas="leading-7 text-sm text-gray-600">Date & Time</label>
    <VueDatePicker v-model="date" id="picker" @update:model-value="handleDateTime" :preview-format="formattedDateTime" :is-24="false" :min-date="new Date()" week-start="0" time-picker-inline placeholder="Select Date"></VueDatePicker>
  </div>
</template>

<script>

  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css'

  import { DateTime } from "luxon";

  export default {
    components: { 
      VueDatePicker 
    },
    data() {
      return {
        formattedDateTime: DateTime.now().toLocaleString(DateTime.DATETIME_FULL),
        date: DateTime.now(),
      };
    },
    methods: {
      async handleDateTime(datetime) {
        const luxonDateTime = DateTime.fromJSDate(new Date(datetime));
        const dateString = luxonDateTime.toISO();
        this.$emit("datetime-add", dateString);
      },
    },
  };

</script>