<template>
    <div>
            <div class="bg-image">
                <div class="bg-primary-light">
                    <div class="content content-full justify-content-between d-flex">
                        <h1 class="font-size-h2 text-white my-0 d-inline-block">
                            <i class="fa fa-plus text-white-50 mr-1"></i> Uredi kategorijo
                        </h1>
                        <a class="btn btn-light" @click="$router.go(-1)">
                            <i class="fas fa-arrow-left"></i> Nazaj
                        </a>
                    </div>
                </div>
            </div>
            <div class="content">
                <div v-if="message !== ''" class="alert alert-success mb-3">
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
                                        <label for="title">Ime</label>
                                        <input disabled type="text" class="form-control" v-model="title" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content">Tekst</label>
                                    <wysiwyg id="wysiwyg" v-model="text" placeholder="Vnesi vsebino..."></wysiwyg>
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
        <deletemodal @close="closeDeleteModal" @delete="deleteCategory(id)">
                <template #header>
                    <h5 class="modal-title" id="exampleModalLongTitle">Izbriši kategorijo?</h5>
                </template>
                <template #body>
                    <b>ID: </b>{{ id }} <br>
                    <b>Ime: </b>{{ title }}
                </template>
        </deletemodal>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                message: '',
                title: '',
                text: null,
                id: null,
            }
        },

        mounted() {
            axios.get('categories/' + this.$route.params.id).then((response) => {
                this.title = response.data.title;
                this.text = response.data.text;
                this.id = this.$route.params.id;
            }).catch(error => console.log(error));
        },

        methods: {
            update() {
                axios.post('categories/' + this.id, {
                    _method: 'put',
                    text: this.text
                }).then((response) => {
                    this.message = response.data;
                }).catch((error) => {
                    console.log(error)
                });
            },

            openDeleteModal() {
                $("#deleteModal").modal("show");
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

            deleteCategory(id) {
                axios.post('categories/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.$router.push({ name: 'categories', params: { msg: response.data } }) 
                        this.closeDeleteModal();
                    }).catch((error) => {console.log(error)});
            }
        }
    }
</script>

<style lang="scss" scoped>

    label, h2 {
        color: #1C1C1C;
    }

    ::v-deep .editr .editr--content {
        height: 200px !important;
    }

</style>