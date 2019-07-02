<template>
    <div class="content">
        <deletemodal ref="delete_modal" @close="closeDeleteModal()" @delete="deleteCategory(categoryId)">
            <template #header>
                <h5 class="modal-title" id="exampleModalLongTitle">Izbriši objavo?</h5>
            </template>
            <template #body>
                <b>ID: </b>{{ categoryId }} <br>
                <b>Naslov: </b>{{ categoryTitle }}
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
        <div class="block block-rounded block-bordered" id="postsBlock">
            <div class="block-header block-header-default">
                <h3 class="block-title">Kategorije</h3>
                <div class="block-options">
                    <router-link class="create btn btn-sm btn-outline-primary" :to="{ name: 'categories.create' }">Dodaj kategorijo</router-link>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Ime</th>
                        <th class="d-none d-sm-table-cell" style="width: 60%;">Tekst</th>
                        <th style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in data" :data="category" :key="category.id">
                        <td class="text-center">{{ category.id }}</td>
                        <td class="font-w600">{{ category.title }}</td>
                        <td class="d-none d-sm-table-cell">{{ category.text | truncate(70, '...') }}</td>
                        <td>
                                <div class="dropdown d-inline-block" style="float: right">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Akcije
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="p-2">
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'categories.edit', params: { id: category.id }}">
                                                <i class="far fa-fw fa-edit mr-1"></i>Popravi
                                            </router-link>
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="openDeleteModal(category.id, category.title)">
                                                <i class="far fa-fw fa-trash-alt mr-1"></i>Izbriši
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
   </div>
</template>

<script>

    export default {
        data() {
            return {
                message: this.msg,
                data: [],
                categoryId: '',
                categoryTitle: ''
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
            search() {
                this.getResults();
            }
        },

        methods: {

            deleteCategory(id) {
                axios.post('categories/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data;
                    }).catch((error) => {console.log(error)});
                this.closeDeleteModal();
            },

            getResults() {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('/categories')
                .then(response => {
                    this.data = response.data;
                    setTimeout(function() {
                        Dashmix.block("state_normal", "#postsBlock");
                    }, 1000)
                });
            },

            openDeleteModal(id, title) {
                $("#deleteModal").modal("show");
                this.categoryId = id; 
                this.categoryTitle = title;
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

        },

        filters: {
            truncate: function (text, length, suffix) {
                if(text !== null && text.length > length) {
                    return text.substring(0, length) + suffix;
                }
                return text;
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
