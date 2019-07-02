<template>
    <div>
        <div class="bg-image">
            <div class="bg-primary-light">
                <div class="content content-full justify-content-between d-flex">
                    <h1 class="font-size-h2 text-white my-0 d-inline-block">
                        Dodeli Admin/Editor pravice
                    </h1>
                    <a class="btn btn-light" @click="$router.go(-1)">
                        <i class="fas fa-arrow-left"></i> Nazaj
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <transition name="fade">
                <div v-if="msg !== null" class="alert alert-success alert-dismissable d-flex align-items-center" role="alert">
                    <div class="flex-fill ml-3">
                        <p class="mb-0">{{ msg }}</p>
                    </div>
                    <button type="button" class="close" @click="msg = null" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </transition>
            <div class="block block-rounded block-bordered pb-5" id="createPostBlock">
                <div class="block-content">
                    <div class="row push">
                        <div class="col-12">
                            <h2 class="content-heading pt-0">Izberi uporabnika</h2>
                            <div class="row mb-5">
                                <div class="col-8">
                                    <multiselect v-model="user" track-by="name" :optionsLimit="50" label="name" placeholder="Uporabnik" 
                                                :closeOnSelect="true" :options="users" :searchable="true" :allow-empty="false"
                                                selectLabel="" deselectLabel="" :custom-label="nameWithEmail">
                                    </multiselect>
                                </div>
                                <div class="col-4">
                                    <button v-if="user" class="btn btn-success" v-on:click="grant('admin')">
                                        Dodaj admin
                                    </button>
                                    <button v-if="user" class="btn btn-success" v-on:click="grant('editor')">
                                        Dodaj editor
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h2 class="content-heading pt-0">Administratorji / Editorji</h2>
                                <div class="block block-rounded" id="postsBlock">
                                    <div class="block-content block-content-full p-0">
                                        <table v-if="admins.length > 0" class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Email</th>
                                                <th class="d-none d-sm-table-cell" style="width: 40%;">Pravice</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="admin in admins" :data="user" :key="admin.id">
                                                    <td class="font-w400">{{ admin.name }}</td>
                                                    <td class="font-w400">{{ admin.email }}</td>
                                                    <td class="font-w400">
                                                        <span v-for="(role,index) in admin.roles" :key="index">
                                                            {{ role.name }} 
                                                            <button style="cursor: pointer" class="badge badge-danger" v-on:click="remove(admin.id, role.name)">Odstrani</button>
                                                            <span class="mr-2" v-if="index !== admin.roles.length-1">,</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</template>

<script>

    import Multiselect from 'vue-multiselect'

    export default {

        components: {
            Multiselect
        },
        data() {
            return {
                user: null,
                users: [],
                admins: [],
                msg: null
            }
        },

        methods: {
            grant(role) {
                axios.post('users/admin/' + this.user.id + '/' + role, {_method: 'put'})
                    .then((response) => { 
                        this.msg = response.data;
                        this.closeDeleteModal();
                        this.getAdmins();
                        this.getUsers();
                        this.user = null;
                    })
                    .catch((error) => { console.log(error)});
            },

            remove(id, role) {
                axios.post('users/admin/' + id + '/' + role, {_method: 'delete'})
                    .then((response) => { 
                        this.msg = response.data;
                        this.closeDeleteModal();
                        this.getAdmins();
                        this.getUsers();
                    })
                    .catch((error) => { console.log(error)});
            },

            openDeleteModal() {
                $("#delete").modal("show");
            },

            closeDeleteModal() {
                $("#delete").modal("hide");
            },

            nameWithEmail({ name, email }) {
                return `${name} — ${email}`;
            },

            getUsers() {
                axios.get('users').then((response) => {
                    this.users = response.data;
                }).catch(error => console.log(error));
            },

            getAdmins() {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('users/admin').then((response) => {
                    this.admins = response.data;
                    setTimeout(function() {
                        Dashmix.block("state_normal", "#postsBlock");
                    }, 500)
                }).catch(error => console.log(error));
            }
        },

        mounted() {
            this.getUsers();
            this.getAdmins();
        },
        
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>