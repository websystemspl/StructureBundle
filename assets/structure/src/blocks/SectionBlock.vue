<script setup>
import { defineProps, ref, inject } from 'vue';
import draggable from "vuedraggable";
import { contentStore } from './../store/content.js'

const openSettings = inject('openSettings');

const props = defineProps({
  elementData: {
    type: Object,
    default: null,
  },
});

</script>

<template>
    <div class="section-block">
          <draggable
              class="drag-area"
              :list="props.elementData.blocks"
              group="containers"
              itemKey="uid"
          >
              <template #item="{ element }">
                    <div class="active-widget" :style="[
                        'padding-top:'+element.settings.Padding.top+'px;',
                        'padding-right:'+element.settings.Padding.right+'px;',
                        'padding-bottom:'+element.settings.Padding.bottom+'px;',
                        'padding-left:'+element.settings.Padding.left+'px;',
                        'margin-top:'+element.settings.Margin.top+'px;',
                        'margin-right:'+element.settings.Margin.right+'px;',
                        'margin-bottom:'+element.settings.Margin.bottom+'px;',
                        'margin-left:'+element.settings.Margin.left+'px;',
                        'background-color:'+element.settings.Background+';',
                        'color:'+element.settings.Color+';',
                        'text-align:'+element.settings.Align+';',
                        'max-width:'+(element.settings.Container ? '1140px; margin: auto;' : '100%;'),
                    ]
                    ">
                      <div class="active-widget__actions">
                          <div class="active-widget__drag"><i class="bi bi-grip-horizontal"></i></div>
                          <button type="button" class="s-button s-button--transparent" @click="openSettings(element)"><i class="bi bi-gear-fill"></i></button>
                          <button type="button" class="s-button s-button--transparent"><i class="bi bi-copy"></i></button>
                          <button type="button" class="s-button s-button--transparent" @click="contentStore.removeElement(element.uid)"><i class="bi bi-x-lg"></i></button>
                      </div>
                      <component :elementData="element" :is="contentStore.createBlock(element.component)"></component>   
                  </div>
              </template>
          </draggable> 
    </div> 
</template>