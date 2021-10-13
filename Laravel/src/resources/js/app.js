require('./bootstrap');

import ExampleComponent from './components/ExampleComponent.vue';
import Create from './components/Create.vue';

import { createApp } from 'vue';

const app = createApp({
    components: {
        ExampleComponent,
        Create,
    }
}).mount('#app');