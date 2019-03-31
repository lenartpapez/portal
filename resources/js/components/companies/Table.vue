<template>
    <div class="content">
        <deletemodal v-if="showModal" ref="mod" @close="showModal = false" @delete="deleteCompany(companyId)">
            <b>ID: </b>{{ companyId }} <br>
            <b>Ime: </b>{{ companyName }}
        </deletemodal>
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
                <h3 class="block-title">Podjetja</h3>
                <div class="block-options">
                    <router-link class="create btn btn-sm btn-outline-primary" :to="{ name: 'create' }">Uvozi podjetja</router-link>
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
                    <tr v-for="company in laravelData.data" :data="company" :key="company.id">
                        <td class="text-center">{{ company.id }}</td>
                        <td class="font-w600">{{ company.contact_name }}</td>
                        <td class="font-w600">{{ company.name }}</td>
                        <td class="d-none d-sm-table-cell">{{ company.short }}</td>
                         <td class="d-none d-sm-table-cell">{{ company.email }}</td>
                        <td>
                            <div class="col-sm-6 col-xl-4" style="float: right">
                                <div class="dropdown d-inline-block">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Akcije
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="p-2">
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="showModal = true; companyId = company.id; companyName = company.name">
                                                <i class="far fa-fw fa-trash-alt mr-1"></i>Izbriši
                                            </a>
                                        </div>
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


    export default {
        data() {
            return {
                showModal: false,
                search: '',
                message: this.msg,
                laravelData: {},
                companyId: '',
                companyName: ''
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

            deleteCompany(id) {
                axios.post('companies/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data[1];
                    }).catch((error) => {console.log(error)});
                this.$refs.mod.$emit('close');
            },

            getResults(page = 1) {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('/companies?page=' + page + '&search=' + this.search)
                .then(response => {
                    this.laravelData = response.data;
                    setTimeout(function() {
                        Dashmix.block("state_normal", "#postsBlock");
                    }, 1000)
                });
            },
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

<style scoped>

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

</style>
