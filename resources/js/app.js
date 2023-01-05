
require('./bootstrap');

import {createApp} from 'vue';
import app from './components/App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import LaravelVuePagination from 'laravel-vue-pagination';
import Slider from '@vueform/slider';


const router = createRouter({
  history: createWebHistory(),
  routes: [
    ...routes
  ],
});

createApp(app).use(Slider).use(LaravelVuePagination).use(router).use(VueAxios, axios).mount("#app");

