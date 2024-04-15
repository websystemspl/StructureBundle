<script setup>
import { defineProps, ref } from 'vue';

let props = defineProps({
  elementData: {
    type: Object,
    default: null,
  },
});
</script>

<template>
  <img :src="props.elementData.src" style="max-width: 100%;">
</template>