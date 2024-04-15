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
    <div class="header-block">
        <contenteditable :tag="props.elementData.style" :contenteditable="true" v-model="props.elementData.content" :no-nl="true" :no-html="false" />
    </div>
</template>