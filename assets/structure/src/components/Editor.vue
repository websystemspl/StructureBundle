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
import Button from 'primevue/button';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Moveable from "vue3-moveable";
import InputText from 'primevue/inputtext';
import Image from 'primevue/image';
import Dropdown from 'primevue/dropdown';

defineEmits(['close']);

const settings = ref(null);
const showMediaModal = ref(false);
const mediaModalElementData = ref(null);
const twigWidgets = inject('widgets');
const save = inject('save');
const sidebar = ref();
const editor_column = ref();
const saveLoading = ref(false);

const fontSizeTypes = ref([
    { name: 'px', code: 'px' },
    { name: 'rem', code: 'rem' },
    { name: '%', code: '%' },
]);

function openSettings(element)
{
    settings.value = element;
}

function openMedia(object)
{
    mediaModalElementData.value = object;
    showMediaModal.value = true;
}

function onResize(e)
{
    e.target.style.width = `${e.width}px`;
}

function saveData()
{
    saveLoading.value = true;
    const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ entity: save.entity, id: save.id, content: contentStore.content, property: save.property})
    };

    fetch(save.url, requestOptions).then(response => response.json()).then(data => {
        saveLoading.value = false;
    });
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
            <div class="editor__top-bar-left">
                <div class="editor__logo">Structure.</div>
                <Button icon="bi bi-plus-lg" @click="settings = null" severity="contrast" rounded  raised  />
            </div>
            <div class="editor__top-bar-right">
                <Button v-if="save !== null" icon="bi bi-floppy2-fill" label="Save" @click="saveData()" severity="primary" :loading="saveLoading"  />
                <Button icon="bi bi-x-lg" @click="$emit('close')" severity="contrast" text  />
            </div>
        </div>
        <div class="editor__columns">
            <div class="editor__column editor__column--left" ref="sidebar">
                <PerfectScrollbar>
                    <div class="s-sidebar">
                        <div class="s-sidebar__blocks-wraper" v-if="settings === null">
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
                        </div>
                        <div class="s-sidebar__settings-wraper" v-if="settings !== null">
                            <h3 class="s-sidebar__header">Block settings - {{ settings.name }}</h3>
                            <div class="s-sidebar__settings">
                                <TabView :scrollable="true">
                                    <TabPanel header="Common">
                                        <div v-if="settings.hasOwnProperty('content')" class="s-sidebar__setting s-sidebar__setting--editor">
                                            <div class="s-sidebar__single">
                                                <label>Content</label>
                                                <Editor v-if="settings.editor === true" v-model="settings.content" editorStyle="height: 320px;">
                                                    <template v-slot:toolbar>
                                                        <span class="ql-formats">
                                                            <button v-tooltip.bottom="'Bold'" class="ql-bold"></button>
                                                            <button v-tooltip.bottom="'Italic'" class="ql-italic"></button>
                                                            <button v-tooltip.bottom="'Underline'" class="ql-underline"></button>
                                                        </span>
                                                    </template>
                                                </Editor>
                                                <!-- <input v-if="settings.editor === false" type="text" v-model="settings.content"> -->
                                                <InputText v-if="settings.editor === false" type="text" v-model="settings.content" />
                                            </div>
                                        </div>                                        
                                        <div v-if="settings.hasOwnProperty('columnsCount')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Columns</label>
                                                <InputText min="1" max="12" type="number" v-model="settings.columnsCount" />
                                            </div>
                                        </div>
                                        <div v-if="settings.hasOwnProperty('block')" class="s-sidebar__setting">
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
                                                    <Button icon="bi bi-type-h1" @click="settings.style = 'h1'" text severity="contrast" />
                                                    <Button icon="bi bi-type-h2" @click="settings.style = 'h2'" text severity="contrast" />
                                                    <Button icon="bi bi-type-h3" @click="settings.style = 'h3'" text severity="contrast" />
                                                    <Button icon="bi bi-type-h4" @click="settings.style = 'h4'" text severity="contrast" />
                                                    <Button icon="bi bi-type-h5" @click="settings.style = 'h5'" text severity="contrast" />
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="settings.hasOwnProperty('alignVertical')" class="s-sidebar__setting">
                                            <div class="s-sidebar__multi">
                                                <label>Vertical align</label>
                                                <div class="s-sidebar__multi-inputs">
                                                    <Button icon="bi-align-top" @click="settings.alignVertical = 'start'" severity="contrast" text  />
                                                    <Button icon="bi-align-center" @click="settings.alignVertical = 'center'" severity="contrast" text  />
                                                    <Button icon="bi-align-bottom" @click="settings.alignVertical = 'end'" severity="contrast" text  />
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="settings.hasOwnProperty('src')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Image</label>
                                                <div class="s-sidebar__image-link">
                                                    <Image alt="Image" preview @click="openMedia(settings)">
                                                        <template #indicatoricon>
                                                            <i class="bi bi-folder2-open"></i>
                                                        </template>
                                                        <template #image>
                                                            <img :src="settings.src" alt="image" />
                                                        </template>
                                                    </Image>
                                                </div>
                                            </div>
                                        </div>                                
                                        <div v-if="settings.hasOwnProperty('label')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Label</label>
                                                <input type="text" v-model="settings.label" />
                                            </div>
                                        </div>                                
                                        <div v-if="settings.hasOwnProperty('link')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Link</label>
                                                <input type="text" v-model="settings.link" />
                                            </div>
                                        </div>                                
                                        <div v-if="settings.hasOwnProperty('target')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Target</label>
                                                <input type="text" v-model="settings.target" />
                                            </div>
                                        </div>                                
                                        <div v-if="settings.hasOwnProperty('buttonclass')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Class</label>
                                                <input type="text" v-model="settings.buttonclass" />
                                            </div>
                                        </div>                                
                                        <div v-if="settings.hasOwnProperty('code')" class="s-sidebar__setting">
                                            <div class="s-sidebar__single">
                                                <label>Code</label>
                                                <textarea type="text" v-model="settings.code"></textarea>
                                            </div>
                                        </div>                                          
                                    </TabPanel>
                                    <TabPanel header="Style">
                                        <div v-for="setting, index in settings.settings" :key="index" class="s-sidebar__setting">
                                            <div class="s-sidebar__multi" v-if="index === 'Padding' || index === 'Margin'">
                                                <label>{{ index }}</label>
                                                <div class="s-sidebar__multi-inputs">
                                                    <div>
                                                        <InputText type="number" v-model="settings.settings[index].top" />
                                                        <label>Top</label>
                                                    </div>
                                                    <div>
                                                        <InputText type="number" v-model="settings.settings[index].right" />
                                                        <label>Right</label>
                                                    </div>
                                                    <div>
                                                        <InputText type="number" v-model="settings.settings[index].bottom" />
                                                        <label>Bottom</label>
                                                    </div>
                                                    <div>
                                                        <InputText type="number" v-model="settings.settings[index].left" />
                                                        <label>Left</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="s-sidebar__multi" v-else-if="index === 'Background'">
                                                <label>{{ index }}</label>
                                                <div class="s-sidebar__multi-inputs">
                                                    <div>
                                                        <InputText type="text" v-model="settings.settings[index]" />
                                                        <label></label>
                                                    </div>
                                                    <div>
                                                        <InputText style="width: 50px;" type="color" v-model="settings.settings[index]" />
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
                                            <div class="s-sidebar__multi" v-else-if="index === 'FontSize'">
                                                <label>{{ index }}</label>
                                                <div class="s-sidebar__multi-inputs">
                                                    <div>
                                                        <InputText type="number" v-model="settings.settings[index]" />
                                                        <label></label>
                                                    </div>
                                                    <div>
                                                        <Dropdown v-model="settings.settings['FontSizeType']" :options="fontSizeTypes" optionLabel="name" placeholder="" />
                                                        <label></label>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div class="s-sidebar__multi" v-else-if="index === 'Align'">
                                                <label>{{ index }}</label>
                                                <div class="s-sidebar__multi-inputs">
                                                    <Button icon="bi bi-text-left" @click="settings.settings[index] = 'left'" text severity="contrast" />
                                                    <Button icon="bi bi-text-center" @click="settings.settings[index] = 'center'" text severity="contrast" />
                                                    <Button icon="bi bi-text-right" @click="settings.settings[index] = 'right'" text severity="contrast" />
                                                </div>
                                            </div>
                                            <div class="s-sidebar__single s-sidebar__single--left" v-else-if="index === 'Container'">
                                                <label>Wrap in {{ index }}</label>
                                                <input type="checkbox" v-model="settings.settings[index]" />
                                            </div>                                
                                        </div>                       
                                    </TabPanel>
                                </TabView>
                            </div>
                        </div>
                    </div>
                </PerfectScrollbar>
            </div>
            <Moveable
                :target="sidebar"
                :draggable="false"
                :scalable="true"
                :resizable="true"
                :rotatable="false"
                :hideDefaultLines="true"
                :keepRatio="false"
                :checkInput="true"
                :throttleResize="1"
                :renderDirections="['e']"
                :scroll-sensitivity="200"
                :force-fallback="true"
                :origin="false"
                @resize="onResize"
            />



            <div class="editor__column editor__column--right" ref="editor_column">
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
                            <div class="active-widget">
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