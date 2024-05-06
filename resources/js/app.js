import './bootstrap';

import { createApp } from 'vue';
import parentComponent from './components/parentComponent.vue';

createApp({})
    .component('parentComponent', parentComponent)
    .mount('#app')

