import './assets/main.scss'

import { createApp } from 'vue'
import App from './App.vue'
import PrimeVue from 'primevue/config';

const app = createApp({})
app.use(PrimeVue);
app.component('structure-app', App)
app.mount('#structureApp')
