 window._ = require('lodash');

 import "../../public/assets/dashmix/js/plugins/bootstrap-notify/bootstrap-notify.min";
 import "../../public/assets/dashmix/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min";
 import "../../public/assets/dashmix/_es6/main/app";

 window.axios = require('axios');

 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

 let token = document.head.querySelector('meta[name="csrf-token"]');

 if (token) {
     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
 } else {
     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
 }

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueElementLoading from 'vue-element-loading'

Vue.component('VueElementLoading', VueElementLoading);

import wysiwyg from "vue-wysiwyg";

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

const router = new VueRouter({
    routes: [
        { name: 'dashboard', path: '/', component: require("./components/Dashboard").default, props: true, meta: { auth: ['editor', 'admin', 'super_admin'] } },
        { name: 'companies', path: '/companies', component: require("./components/companies/Table").default, props: true, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'companies.create', path: '/companies/create', component: require("./components/companies/Create").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'companies.show', path: '/companies/:id', component: require("./components/companies/Show").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'companies.edit', path: '/companies/:id/edit', component: require("./components/companies/Edit").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'companygoal', path: '/companygoal', component: require("./components/goal_adding/CompanyGoal").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'institutegoal', path: '/institutegoal', component: require("./components/goal_adding/InstituteGoal").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'posts', path: '/posts', component: require("./components/posts/Table").default, props: true, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'posts.create', path: '/posts/create', component: require("./components/posts/Create").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'posts.show', path: '/posts/:id', component: require("./components/posts/Show").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'posts.edit', path: '/posts/:id/edit', component: require("./components/posts/Edit").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'categories', path: '/categories', component: require("./components/categories/Table").default, props: true, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'categories.create', path: '/categories/create', component: require("./components/categories/Create").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'categories.edit', path: '/categories/:id/edit', component: require("./components/categories/Edit").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'links', path: '/links', component: require("./components/links/Table").default, props: true, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'links.create', path: '/links/create', component: require("./components/links/Create").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'links.edit', path: '/links/:id/edit', component: require("./components/links/Edit").default, meta: { auth: ['editor', 'super_admin'] } },
        { name: 'login', path: '/login', component: require("./components/Login").default, meta: { auth: false } },
        { name: 'institutes', path: '/institutes', component: require("./components/institutes/Table").default, props: true, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'institutes.create', path: '/institutes/create', component: require("./components/institutes/Create").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'institutes.show', path: '/institutes/:id', component: require("./components/institutes/Show").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'institutes.edit', path: '/institutes/:id/edit', component: require("./components/institutes/Edit").default, meta: { auth: ['admin', 'super_admin'] } },
        { name: 'users', path: '/users', component: require("./components/users/Users").default, meta: { auth: ['super_admin'] } },
        { name: 'forbidden', path: '/403', redirect: {name: 'dashboard'} }
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

/* $(document).ready(function () {
    $('.editr--toolbar .dashboard label').click(function (event) {
        $(event.target).focus()
    });
}); */



