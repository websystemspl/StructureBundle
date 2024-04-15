<script setup>
import { defineProps, ref, inject } from 'vue';
import draggable from "vuedraggable";
import { contentStore } from './../store/content.js'

const props = defineProps({
  elementData: {
    type: Object,
    default: null,
  },
});

const openSettings = inject('openSettings');

for (let i = 0; i < props.elementData.columnsCount; i++) {
  props.elementData.columns.push([]);
}

</script>

<template>
    <div class="columns-block">
      <div class="columns-block__columns" :style="'align-items:' + (props.elementData.alignVertical)">
        <div v-for="col in props.elementData.columnsCount" :key="col - 1" class="columns-block__column">
          <draggable
              class="drag-area"
              :list="props.elementData.columns[col - 1]"
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
      </div> 
    </div> 
</template>