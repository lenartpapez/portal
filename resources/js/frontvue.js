 window._ = require('lodash');

 window.axios = require('axios');

 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

 let token = document.head.querySelector('meta[name="csrf-token"]');

 if (token) {
     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
 } else {
     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
 }

import Vue from 'vue';
import VueElementLoading from 'vue-element-loading'

Vue.component('VueElementLoading', VueElementLoading);
import wysiwyg from "vue-wysiwyg";

Vue.use(wysiwyg, {hideModules: { "table": true }, forcePlainTextOnPaste: true}, );

import Comments from "./components/posts/CommentSection";
new Vue(Comments).$mount('#app');

