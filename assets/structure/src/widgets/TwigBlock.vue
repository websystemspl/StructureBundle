<script setup>
import { defineProps } from 'vue';

let props = defineProps({
  elementData: {
    type: Object,
    default: null,
  },
});

</script>

<template>
  <div class="twig-block">
    <i class="bi bi-braces"></i> {{ elementData.block }}
  </div>
</template>