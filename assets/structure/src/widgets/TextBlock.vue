<script setup>
import { defineProps } from 'vue';
import contenteditable from 'vue-contenteditable'

let props = defineProps({
  elementData: {
    type: Object,
    default: null,
  },
});

</script>

<template>
    <div class="text-block">
        <contenteditable tag="div" :contenteditable="true" v-model="props.elementData.content" :no-nl="false" :no-html="false" />
    </div>
</template>