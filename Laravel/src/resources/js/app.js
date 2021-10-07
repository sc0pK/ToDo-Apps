require('./bootstrap');

import ExampleComponent from './components/ExampleComponent.vue';

import { createApp } from 'vue';

const app = createApp({
    components: {
        ExampleComponent
    }
}).mount('#app');