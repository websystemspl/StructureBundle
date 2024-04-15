<script setup>
import { defineProps, ref, watch, provide } from 'vue';
import { contentStore } from './store/content.js'
import Editor from './components/Editor.vue'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

let props = defineProps({
  name: {
    type: String,
    default: null,
  },
  value: {
    type: String,
    default: null,
  },
  id: {
    type: String,
    default: null,
  },
  media: {
    type: String,
  },
  widgets: {
    type: String,
  },
  save: {
    type: String,
    default: null,
  },
});

contentStore.content = JSON.parse(props.value)
const element = ref(JSON.stringify(contentStore.content));
const showEditor = ref(false);
const isLoading = ref(false);

const startApp = () => {
  isLoading.value = true;
  setTimeout(() => {
    isLoading.value = false
    showEditor.value = true;
  }, 2000)
}

provide('mediaEndpoint', props.media);
provide('widgets', JSON.parse(props.widgets));
provide('save', JSON.parse(props.save));

watch(() => contentStore.content, (newContent) => {
  element.value = JSON.stringify(newContent);
}, { deep: true });
</script>

<template>
  <input type="hidden" v-model="element" :name="props.name" :id="props.id" />
  
  <div class="start-structure">
    <button type="button" class="start-structure__button" @click="startApp()">Start Structure</button>
  </div>

  <loading :active="isLoading" :can-cancel="false" :is-full-page="true" background-color="#000" opacity="1" transition="fade">
    <template #default>
      <div class="loading-logo">Structure.</div>
    </template>
  </loading>  
  <Teleport to="body">
    <Editor v-if="showEditor" @close="(e) => {showEditor = false}" />
  </Teleport>
</template>
