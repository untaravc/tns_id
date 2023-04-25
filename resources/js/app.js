require('./bootstrap');
import 'flowbite';
import Vue from 'vue'

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const app = new Vue({
    el: '#__tenisindo',
});
