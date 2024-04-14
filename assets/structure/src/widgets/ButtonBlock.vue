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
    <div class="button-block">
        <a :href="props.elementData.link" :target="props.elementData.target" :class="props.elementData.buttonclass" :title="props.elementData.label">{{ props.elementData.label }}</a>
    </div>
</template>