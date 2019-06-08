/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueElementLoading from 'vue-element-loading'

Vue.component('VueElementLoading', VueElementLoading);

import wysiwyg from "vue-wysiwyg";

require('./bootstrap.js');
require('./extra.js');

import "../../public/assets/dashmix/_scss/main.scss";
import "../../public/assets/dashmix/_scss/dashmix/themes/xwork.scss";

Vue.use(wysiwyg, {hideModules: { "table": true }, forcePlainTextOnPaste: true}, );

import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = apiUrl;

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('deletemodal', require('./components/DeleteModal.vue').default);
Vue.component('importmodal', require('./components/ImportModal.vue').default);
Vue.component('contactsmodal', require('./components/ContactsModal.vue').default);
Vue.component('sdbr', require('./components/Sidebar.vue').default);
Vue.component('hdr', require('./components/Header.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter({
    routes: [
        { name: 'posts', path: '/posts', component: require("./components/posts/Table").default, props: true, meta: { auth: true } },
        { name: 'dashboard', path: '/', component: require("./components/Dashboard").default, props: true, meta: { auth: true } },
        { name: 'posts.create', path: '/posts/create', component: require("./components/posts/Create").default, meta: { auth: true } },
        { name: 'posts.show', path: '/posts/:id', component: require("./components/posts/Show").default, meta: { auth: true } },
        { name: 'posts.edit', path: '/posts/:id/edit', component: require("./components/posts/Edit").default, meta: { auth: true } },
        { name: 'login', path: '/login', component: require("./components/Login").default, meta: { auth: false } },
        { name: 'institutes', path: '/institutes', component: require("./components/institutes/Table").default, props: true, meta: { auth: true } },
        { name: 'institutes.create', path: '/institutes/create', component: require("./components/institutes/Create").default, meta: { auth: true } },
        { name: 'institutes.show', path: '/institutes/:id', component: require("./components/institutes/Show").default, meta: { auth: true } },
        { name: 'institutes.edit', path: '/institutes/:id/edit', component: require("./components/institutes/Edit").default, meta: { auth: true } },
        { name: 'companies', path: '/companies', component: require("./components/companies/Table").default, props: true, meta: { auth: true } },
        { name: 'companies.create', path: '/companies/create', component: require("./components/companies/Create").default, meta: { auth: true } },
        { name: 'companies.show', path: '/companies/:id', component: require("./components/companies/Show").default, meta: { auth: true } },
        { name: 'companies.edit', path: '/companies/:id/edit', component: require("./components/companies/Edit").default, meta: { auth: true } },
        { name: 'companygoal', path: '/companygoal', component: require("./components/connections/CompanyGoal").default, meta: { auth: true } },
        { name: 'institutegoal', path: '/institutegoal', component: require("./components/connections/InstituteGoal").default, meta: { auth: true } },
    ]
});

Vue.router = router;
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
import Main from "./components/Main";
Main.router = Vue.router;
new Vue(Main).$mount('#main');



