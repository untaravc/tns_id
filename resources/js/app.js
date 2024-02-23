require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue'
import router from './src/router'
import { Bootstrap4Pagination } from 'laravel-vue-pagination'
import VueSweetalert2 from 'vue-sweetalert2';
import Loading from 'vue3-loading-overlay';
import { createPinia } from 'pinia'
import mitt from 'mitt';
import filter from './src/filter'
import registerIcon from "./src/oh_icon";

const app = createApp(App);
const pinia = createPinia()

app.component('Loading', Loading)
app.component('Bootstrap4Pagination', Bootstrap4Pagination)

app.use(VueSweetalert2)
window.Swal = app.config.globalProperties.$swal;

const emitter = mitt();
app.config.globalProperties.emitter = emitter;
window.emitter = emitter

app.config.globalProperties.$filter = filter

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

registerIcon(app)

app.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
app.use(pinia)
app.use(router)
    .mount('#app')
