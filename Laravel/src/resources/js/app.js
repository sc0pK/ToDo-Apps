require('./bootstrap');

import TodoView from './components/TodoView.vue';
import Create from './components/Create.vue';

import { createApp } from 'vue';

const app = createApp({
    components: {
        TodoView,
        Create,
    }
}).mount('#app');