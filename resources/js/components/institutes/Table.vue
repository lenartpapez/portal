<template>
    <div class="content">
        <contactsmodal ref="contacts_modal" @close="closeContactsModal">
            <template #contacts>
                <h4>{{ instituteName }}</h4>
                <div v-for="contact in contacts" :data="contact" :key="contact.id"> 
                    <b>{{ contact.contact_name }}: </b>{{ contact.email }} <br>
                </div>
            </template>
        </contactsmodal>
        <deletemodal ref="mod" @close="closeDeleteModal" @delete="deleteInstitute(instituteId)">
            <template #header>
                <h5 class="modal-title" id="exampleModalLongTitle">Izbriši inštitut?</h5>
            </template>
            <template #body>
                <b>ID: </b>{{ instituteId }} <br>
                <b>Ime: </b>{{ instituteName }}
            </template>
        </deletemodal>
        <importmodal ref="import_modal" @close="closeImportModal" @import="importInstitutes">
            <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 50%">Ime</th>
                        <th>Kratica</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Kontakt</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="institute in importData" :data="institute" :key="institute.name">
                        <td class="font-w600">{{ institute[1] }}</td>
                        <td class="font-w600">{{ institute[2] }}</td>
                        <td class="d-none d-sm-table-cell">{{ institute[0] }}</td>
                        <td class="d-none d-sm-table-cell">{{ institute[3] }}</td>
                    </tr>
                    </tbody>
                </table>
        </importmodal>
        <transition name="fade">
            <div v-if="message !== undefined" class="alert alert-success alert-dismissable d-flex align-items-center" role="alert">
                <div class="flex-fill ml-3">
                    <p class="mb-0">{{ message }}</p>
                </div>
                <button type="button" class="close" @click="message = undefined" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
         </transition>
        <div class="block-content block-content-full block-content-sm bg-body-dark">
            <input type="text" class="form-control form-control-alt"  placeholder="Iskanje..." v-model="search">
        </div>
        <div class="block block-rounded block-bordered" id="postsBlock">
            <div class="block-header block-header-default">
                <h3 class="block-title">Inštituti</h3>
                <div class="block-options">
                    <div class="custom-file">
                        <router-link class="create btn btn-sm btn-outline-primary" :to="{ name: 'institutes.create' }">Dodaj inštitut</router-link>
                        <button class="btn btn-sm btn-outline-success" @click.prevent="triggerFilePrompt">Uvozi inštitute in kontakte</button>
                        <input ref="import" @change="previewImport" type="file" style="display:none" />
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Ime</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Kratica</th>
                        <th  class="d-none d-sm-table-cell">Kontakti</th>
                        <th style="width: 15%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="institute in laravelData.data" :data="institute" :key="institute.id">
                        <td class="text-center">{{ institute.id }}</td>
                        <td class="font-w600">{{ institute.name }}</td>
                        <td class="font-w600">{{ institute.short }}</td>
                        <td class="font-w600">
                            <button class="btn btn-primary" @click="openContactsModal(institute.name, institute.contacts)">Kontakti</button>
                        </td>
                        <td>
                                <div class="dropdown d-inline-block" style="float: right">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Akcije
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="p-2">
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'institutes.show', params: { id: institute.id }}">
                                                <i class="far fa-fw fa-eye mr-1"></i>Preglej
                                            </router-link>
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'institutes.edit', params: { id: institute.id }}">
                                                <i class="far fa-fw fa-edit mr-1"></i>Popravi
                                            </router-link>
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="openDeleteModal(institute.id, institute.name)">
                                                <i class="far fa-fw fa-trash-alt mr-1"></i>Izbriši
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <pagination :limit="2" :data="laravelData" @pagination-change-page="getResults"></pagination>
            </div>
        </div>
   </div>
</template>

<script>

    import Papa from 'papaparse';

    export default {
        data() {
            return {
                search: '',
                message: this.msg,
                laravelData: {},
                instituteId: '',
                instituteName: '',
                importData: [],
                contacts: []
            }
        },

        mounted() {
            this.getResults();
        },

        props: [
            'msg',
        ],

        watch:{
            msg(){
                this.message = this.msg;
            },
            search(){
                this.getResults();
            }
        },

        methods: {
            triggerFilePrompt() {
                this.$refs.import.click();
            },
            getResults(page = 1) {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('/institutes?page=' + page + '&search=' + this.search)
                .then(response => {
                    this.laravelData = response.data;
                    setTimeout(function() {
                        Dashmix.block("state_normal", "#postsBlock");
                    }, 1000)
                });
            },

            parseData(url, callBack) {
                $("#importModal").modal("show");
                Papa.parse(url, {
                    complete: function(results) {
                        callBack(results.data);
                    }      
                });
            },

            saveImportData(data) {
                this.importData = data;
            },

            previewImport() {
                this.parseData(this.$refs.import.files[0], this.saveImportData);
                this.$refs.import.value = null;
            },

            importInstitutes() {
                axios.post('institutes/import', {
                    importData: this.importData 
                }).then((response) => {
                        this.message = response.data;
                        this.getResults();
                    }).catch((error) => {console.log(error)});
                this.$refs.import_modal.$emit('close');
            },

            deleteInstitute(id) {
                axios.post('institutes/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data;
                    }).catch((error) => {console.log(error)});
                this.$refs.mod.$emit('close');
            },

            openDeleteModal(id, name) {
                $("#deleteModal").modal("show");
                this.instituteId = id; 
                this.instituteName = name;
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

            closeImportModal() {
                $("#importModal").modal("hide");
            },

            closeContactsModal() {
                $("#contactsModal").modal("hide");
            },

            openContactsModal(institute, contacts) {
                this.contacts = contacts;
                this.instituteName = institute;
                $("#contactsModal").modal("show");
            }
        },


        filters: {
            format: function (value) {
                value = value.split(" ");
                let date = value[0].split("-");
                let time = value[1].split(":");
                return date[2] + "." + date[1] + "." + date[0].slice(-2) + " " + time[0] + ":" + time[1];
            }
        },
    }
</script>

<style lang="scss" scoped>

    .content table td, .content table th {
        vertical-align: middle;
    }
    .fade-enter-active, .fade-leave-active {
        transition-property: opacity;
        transition-duration: .15s;
    }

    .fade-enter-active {
        transition-delay: .15s;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }

    .btn-outline-success {

        position: relative;
        input[type=file] {
                color: transparent;
                background-color: transparent;
                position: absolute;
                left: 0;
                width: 100%;
                height: 100%;
                top: 0;
                opacity: 0;
                z-index: 100;
            }
    }

</style>
