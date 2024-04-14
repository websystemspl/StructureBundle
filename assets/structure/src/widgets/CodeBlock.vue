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
    <div class="code-block">
        <contenteditable tag="div" :contenteditable="true" v-model="props.elementData.code" :no-nl="false" :no-html="false" />
    </div>
</template>