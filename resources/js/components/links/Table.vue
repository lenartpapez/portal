<template>
    <div class="content">
        <deletemodal ref="delete_modal" @close="closeDeleteModal()" @delete="deletePost(linkId)">
            <template #header>
                <h5 class="modal-title" id="exampleModalLongTitle">Izbriši povezavo?</h5>
            </template>
            <template #body>
                <b>ID: </b>{{ linkId }} <br>
                <b>Tekst: </b>{{ linkText }} <br>
                <b>Url: </b>{{ linkUrl }}
            </template>
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
                <h3 class="block-title">Povezave</h3>
                <div class="block-options">
                    <router-link class="create btn btn-sm btn-outline-primary" :to="{ name: 'links.create' }">Dodaj povezavo</router-link>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Tekst</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">URL</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%">Kategorija</th>
                        <th style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="link in laravelData.data" :data="link" :key="link.id">
                        <td class="text-center">{{ link.id }}</td>
                        <td class="font-w600">{{ link.text }}</td>
                        <td class="d-none d-sm-table-cell">{{ link.url | truncate(35, '...') }}</td>
                        <td class="font-w600">{{ link.category.title }}</td>
                        <td>
                                <div class="dropdown d-inline-block" style="float: right">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Akcije
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="p-2">
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'links.edit', params: { id: link.id }}">
                                                <i class="far fa-fw fa-edit mr-1"></i>Popravi
                                            </router-link>
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="openDeleteModal(link.id, link.text, link.url)">
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

    export default {
        data() {
            return {
                search: '',
                message: this.msg,
                laravelData: {},
                linkId: '',
                linkText: '',
                linkUrl: ''
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

            deletePost(id) {
                axios.post('links/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data;
                    }).catch((error) => {console.log(error)});
                this.closeDeleteModal();
            },

            getResults(page = 1) {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('/links?page=' + page + '&search=' + this.search)
                .then(response => {
                    this.laravelData = response.data;
                    setTimeout(function() {
                        Dashmix.block("state_normal", "#postsBlock");
                    }, 1000)
                });
            },

            openDeleteModal(id, text, url) {
                $("#deleteModal").modal("show");
                this.linkId = id; 
                this.linkText = text;
                this.linkUrl = url;
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

        },

        filters: {
            truncate: function (url, length, suffix) {
                if(url !== null && url.length > length) {
                    return url.substring(0, length) + suffix;
                }
                return url;
            },
        }

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
