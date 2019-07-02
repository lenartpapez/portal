<template>
    <div>
            <div class="bg-image">
                <div class="bg-primary-light">
                    <div class="content content-full justify-content-between d-flex">
                        <h1 class="font-size-h2 text-white my-0 d-inline-block">
                            <i class="fa fa-plus text-white-50 mr-1"></i> Uredi povezavo
                        </h1>
                        <a class="btn btn-light" @click="$router.go(-1)">
                            <i class="fas fa-arrow-left"></i> Nazaj
                        </a>
                    </div>
                </div>
            </div>
            <div class="content">
                <div v-if="message !== ''" v-bind:class="{ 'alert-success': !error, 'alert-danger': error }" class="alert mb-3">
                    {{ message }}
                </div>
                <div class="block block-rounded block-bordered" id="createPostBlock">
                    <div class="block-content">

                        <h2 class="content-heading pt-0">Osnovne informacije</h2>
                        <div class="row push">
                            <div class="col-xl-4 col-12">
                                <p class="text-muted">
                                    Podatki
                                </p>
                            </div>
                            <div class="col-lg-10 col-xl-8">


                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="category">Kategorija</label>
                                        <select v-model="category" class="form-control" required>
                                            <option v-for="category of categories" :value="category.id" :key="category.id">
                                                {{ category.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Tekst</label>
									<input type="text" class="form-control" v-model="text" required>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="title">URL</label>
									    <input type="url" validate class="form-control" v-model="url" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button v-on:click="update" class="btn btn-success mb-5">
                    Shrani
                </button>
                <button v-on:click="openDeleteModal" type="button" class="btn btn-danger mb-5">
                    Izbriši
                </button>
            </div>
        <deletemodal @close="closeDeleteModal" @delete="deleteLink(id)">
                <template #header>
                    <h5 class="modal-title" id="exampleModalLongTitle">Izbriši povezavo?</h5>
                </template>
                <template #body>
                    <b>ID: </b>{{ id }} <br>
                    <b>Tekst: </b>{{ text }} <br>
                    <b>URL: </b>{{ url }}
                </template>
        </deletemodal>
    </div>
</template>

<script>

    export default {


        data() {
            return {
                error: false,
                categories: [],
                category: null,
                message: '',
                text: '',
                url: '',
                id: null
            }
        },

        mounted() {
            axios.get('links/' + this.$route.params.id).then((response) => {
                this.category = response.data.category_id;
                this.text = response.data.text;
                this.url = response.data.url;
                this.id = this.$route.params.id;
            }).catch(error => console.log(error));
            this.getCategories();
        },

        methods: {
            update() {
                var isUrl = require('is-url');
                if(isUrl(this.url)) {
                    axios.post('links/' + this.id, {
                        _method: 'put',
                        category: this.category,
                        text: this.text,
                        url: this.url
                    }).then((response) => {
                            this.error = false;
                            this.message = response.data;
                    }).catch((error) => {
                            console.log(error)
                    });
                } else {
                    this.error = true;
                    this.message = 'URL ni v pravilnem formatu.';
                }
            },

            openDeleteModal() {
                $("#deleteModal").modal("show");
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

            deleteLink(id) {
                axios.post('links/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.$router.push({ name: 'links', params: { msg: response.data } }) 
                        this.closeDeleteModal();
                    }).catch((error) => {console.log(error)});
            },

            getCategories() {
                axios.get('categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {});
            }
        }
    }
</script>

<style scoped>

    label, h2 {
        color: #1C1C1C;
    }

</style>