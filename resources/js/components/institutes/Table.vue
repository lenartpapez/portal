<template>
    <div class="content">
        <deletemodal v-if="showDeleteModal" ref="mod" @close="showDeleteModal = false" @delete="deleteInstitute(instituteId)">
            <b>ID: </b>{{ instituteId }} <br>
            <b>Naslov: </b>{{ instituteName }}
        </deletemodal>
        <importmodal ref="import_modal">
            <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 240px;">Kontakt</th>
                        <th>Ime</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Kratica</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="institute in importData" :data="institute" :key="institute.name">
                        <td class="font-w600">{{ institute[0] }}</td>
                        <td class="font-w600">{{ institute[1] }}</td>
                        <td class="d-none d-sm-table-cell">{{ institute[2] }}</td>
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                        <button class="btn btn-sm btn-outline-success" @click.prevent="triggerFilePrompt">Uvozi inštitute</button>
                        <input ref="import" @change="previewImport" type="file" style="display:none" />
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th class="d-none d-sm-table-cell" style="width: 240px;">Kontakt</th>
                        <th>Ime</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Kratica</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Email</th>
                        <th style="width: 15%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="institute in laravelData.data" :data="institute" :key="institute.id">
                        <td class="text-center">{{ institute.id }}</td>
                        <td class="font-w600">{{ institute.contact_name }}</td>
                        <td class="font-w600">{{ institute.name }}</td>
                        <td class="d-none d-sm-table-cell">{{ institute.short }}</td>
                         <td class="d-none d-sm-table-cell">{{ institute.email }}</td>
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
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="showDeleteModal = true; instituteId = institute.id; instituteName = institute.name">
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
                showDeleteModal: false,
                search: '',
                message: this.msg,
                laravelData: {},
                instituteId: '',
                instituteName: '',
                importData: []
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
            },

            importInstitutes() {

            },

            deleteInstitute(id) {
                axios.post('institutes/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data[1];
                    }).catch((error) => {console.log(error)});
                this.$refs.mod.$emit('close');
            },

            showImportModal() {
                $(document).ready(function(){
                    $('importmodal').modal('show');
                });
            },

            closeImportModal() {
                $(document).ready(function(){
                    $('importmodal').modal('hide');
                });
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
