<script setup>
import draggable from "vuedraggable";
import { defineEmits, ref, provide, inject } from 'vue';
import { widgetStore } from './../store/widgets.js'
import { contentStore } from './../store/content.js'
import MediaModal from './MediaModal.vue'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import Editor from 'primevue/editor';

defineEmits(['close']);

const settings = ref(null);
const showMediaModal = ref(false);
const mediaModalElementData = ref(null);
const twigWidgets = inject('widgets');


function openSettings(element)
{
    settings.value = element;
}

function openMedia(object)
{
    mediaModalElementData.value = object;
    showMediaModal.value = true;
}

provide('openSettings', openSettings);
</script>

<style>
@import 'vue3-perfect-scrollbar/style.css';

.ps {
  max-height: calc(100vh - 100px);
  width: 100%;
}
</style>

<template>
    <div class="editor">
        <MediaModal :show="showMediaModal" :elementData="mediaModalElementData" @update="(e) => {showMediaModal = false}" />
        <div class="editor__top-bar">
            <div class="editor__logo">Structure.</div>
            <button type="button" class="s-button s-button--transparent" @click="$emit('close')"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="editor__columns">
            <div class="editor__column editor__column--left">
                <PerfectScrollbar>
                    <div class="s-sidebar">
                        <h3 class="s-sidebar__header">Blocks</h3>
                        <draggable 
                            class="s-widgets" 
                            :list="widgetStore.widgets"
                            itemKey="id"
                            :group="{ name: 'containers', pull: 'clone', put: false }"
                            :clone="contentStore.cloneElement"
                            :sort="false"
                        >
                            <template #item="{ element }">
                                <div class="s-widget">
                                    <i :class="element.icon"></i> {{ element.name }}
                                </div>
                            </template>
                        </draggable>
                        <div v-if="settings !== null">
                            <h3 class="s-sidebar__header">Block settings - {{ settings.name }}</h3>
                            <div class="s-sidebar__settings">
                                <div v-for="setting, index in settings.settings" :key="index" class="s-sidebar__setting">
                                    <div class="s-sidebar__multi" v-if="index === 'Padding' || index === 'Margin'">
                                        <label>{{ index }}</label>
                                        <div class="s-sidebar__multi-inputs">
                                            <div>
                                                <input type="number" v-model="settings.settings[index].top" placeholder="Top" />
                                                <label>Top</label>
                                            </div>
                                            <div>
                                                <input type="number" v-model="settings.settings[index].right" placeholder="Right" />
                                                <label>Right</label>
                                            </div>
                                            <div>
                                                <input type="number" v-model="settings.settings[index].bottom" placeholder="Bottom" />
                                                <label>Bottom</label>
                                            </div>
                                            <div>
                                                <input type="number" v-model="settings.settings[index].left" placeholder="Left" />
                                                <label>Left</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="s-sidebar__multi" v-else-if="index === 'Background'">
                                        <label>{{ index }}</label>
                                        <div class="s-sidebar__multi-inputs">
                                            <div>
                                                <input type="text" v-model="settings.settings[index]" />
                                                <label></label>
                                            </div>
                                            <div>
                                                <input style="width: 50px;" type="color" v-model="settings.settings[index]" />
                                                <label></label>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="s-sidebar__multi" v-else-if="index === 'Color'">
                                        <label>{{ index }}</label>
                                        <div class="s-sidebar__multi-inputs">
                                            <div>
                                                <input type="text" v-model="settings.settings[index]" />
                                                <label></label>
                                            </div>
                                            <div>
                                                <input style="width: 50px;" type="color" v-model="settings.settings[index]" />
                                                <label></label>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="s-sidebar__multi" v-else-if="index === 'Align'">
                                        <label>{{ index }}</label>
                                        <div class="s-sidebar__multi-inputs">
                                            <button type="button" class="s-button s-button--transparent">
                                                <i class="bi bi-text-left" @click="settings.settings[index] = 'left'"></i>
                                            </button>
                                            <button type="button" class="s-button s-button--transparent">
                                                <i class="bi bi-text-center" @click="settings.settings[index] = 'center'"></i>
                                            </button>
                                            <button type="button" class="s-button s-button--transparent">
                                                <i class="bi bi-text-right" @click="settings.settings[index] = 'right'"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="s-sidebar__single s-sidebar__single--left" v-else-if="index === 'Container'">
                                        <label>Wrap in {{ index }}</label>
                                        <input type="checkbox" v-model="settings.settings[index]" />
                                    </div>                                
                                </div>
                                <div v-if="settings.hasOwnProperty('content')" class="s-sidebar__setting s-sidebar__setting--editor">
                                    <div class="s-sidebar__single">
                                        <label>Content</label>
                                        <Editor v-model="settings.content" editorStyle="height: 320px;">
                                            <template v-slot:toolbar>
                                                <span class="ql-formats">
                                                    <button v-tooltip.bottom="'Bold'" class="ql-bold"></button>
                                                    <button v-tooltip.bottom="'Italic'" class="ql-italic"></button>
                                                    <button v-tooltip.bottom="'Underline'" class="ql-underline"></button>
                                                </span>
                                            </template>
                                        </Editor>
                                    </div>
                                </div>
                                <div v-if="settings.hasOwnProperty('columnsCount')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Columns</label>
                                        <input min="1" max="12" type="number" v-model="settings.columnsCount" />
                                    </div>
                                </div>
                                <div v-if="settings.hasOwnProperty('block')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Widgets</label>
                                        <select v-model="settings.block">
                                            <option v-for="twigWidget in twigWidgets" :key="twigWidget.name" :value="twigWidget.name">{{ twigWidget.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="settings.hasOwnProperty('style')" class="s-sidebar__setting">
                                    <div class="s-sidebar__multi">
                                        <label>Header</label>
                                        <div class="s-sidebar__multi-inputs">
                                            <i class="bi bi-type-h1" @click="settings.style = 'h1'"></i>
                                            <i class="bi bi-type-h2" @click="settings.style = 'h2'"></i>
                                            <i class="bi bi-type-h3" @click="settings.style = 'h3'"></i>
                                            <i class="bi bi-type-h4" @click="settings.style = 'h4'"></i>
                                            <i class="bi bi-type-h5" @click="settings.style = 'h5'"></i>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="settings.hasOwnProperty('src')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Image</label>
                                        <div class="s-sidebar__image-link">
                                            <img :src="settings.src" @click="openMedia(settings)" />
                                            <p></p>
                                        </div>
                                    </div>
                                </div>                                
                                <div v-if="settings.hasOwnProperty('label')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Label</label>
                                        <input type="text" v-model="settings.label" />
                                    </div>
                                </div>                                
                                <div v-if="settings.hasOwnProperty('link')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Link</label>
                                        <input type="text" v-model="settings.link" />
                                    </div>
                                </div>                                
                                <div v-if="settings.hasOwnProperty('target')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Target</label>
                                        <input type="text" v-model="settings.target" />
                                    </div>
                                </div>                                
                                <div v-if="settings.hasOwnProperty('buttonclass')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Class</label>
                                        <input type="text" v-model="settings.buttonclass" />
                                    </div>
                                </div>                                
                                <div v-if="settings.hasOwnProperty('code')" class="sidebar__setting">
                                    <div class="s-sidebar__single">
                                        <label>Code</label>
                                        <textarea type="text" v-model="settings.code"></textarea>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </PerfectScrollbar>
            </div>
            <div class="editor__column editor__column--right">
                <PerfectScrollbar>
                    <div style="margin: 20px 0;">
                    <draggable
                        class="drag-area"
                        :list="contentStore.content"
                        group="containers"
                        itemKey="uid"
                        handle=".active-widget__drag"
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
                                    <button type="button" class="s-button s-button--transparent" @click="contentStore.findAndDuplicateByUID(element.uid)"><i class="bi bi-copy"></i></button>
                                    <button type="button" class="s-button s-button--transparent" @click="contentStore.removeElement(element.uid)"><i class="bi bi-x-lg"></i></button>
                                </div>
                                <component :elementData="element" :is="contentStore.createBlock(element.component)"></component>   
                            </div>
                        </template>
                    </draggable>
                    </div>
                </PerfectScrollbar>
            </div>
        </div>
    </div>
</template>