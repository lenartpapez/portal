<template>
    <div class="content">
        <deletemodal v-if="showModal" ref="mod" @close="showModal = false" @delete="deletePost(postId)">
            <b>ID: </b>{{ postId }} <br>
            <b>Naslov: </b>{{ postTitle }}
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
                <h3 class="block-title">Objave</h3>
                <div class="block-options">
                    <form class="form-inline">
                        <router-link class="create btn btn-sm btn-outline-primary" :to="{ name: 'posts.create' }">Dodaj objavo</router-link>
                    </form>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Naslov</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Ustvarjena</th>
                        <th style="width: 15%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="post in laravelData.data" :data="post" :key="post.id">
                        <td class="text-center">{{ post.id }}</td>
                        <td class="font-w600">{{ post.title }}</td>
                        <td class="d-none d-sm-table-cell">{{ post.created_at | format }}</td>
                        <td>
                            <div class="col-sm-6 col-xl-4" style="float: right">
                                <div class="dropdown d-inline-block">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Akcije
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="p-2">
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'posts.show', params: { id: post.id }}">
                                                <i class="far fa-fw fa-eye mr-1"></i>Preglej
                                            </router-link>
                                            <router-link class="dropdown-item btn btn-sm btn-outline-primary" :to="{ name: 'posts.edit', params: { id: post.id }}">
                                                <i class="far fa-fw fa-edit mr-1"></i>Uredi
                                            </router-link>
                                            <a class="dropdown-item btn btn-sm btn-outline-primary" @click="showModal = true; postId = post.id; postTitle = post.title">
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
                postId: '',
                postTitle: ''
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
                axios.post('posts/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.getResults();
                        this.message = response.data[1];
                    }).catch((error) => {console.log(error)});
                this.$refs.mod.$emit('close');
            },

            getResults(page = 1) {
                Dashmix.block("state_loading", "#postsBlock");
                axios.get('/posts?page=' + page + '&search=' + this.search)
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
