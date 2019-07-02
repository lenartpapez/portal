<template>
    <div>
        <form method="post" @submit.stop.prevent="update" enctype='multipart/form-data'>
            <div class="bg-image">
                <div class="bg-primary-light">
                    <div class="content content-full justify-content-between d-flex">
                        <h1 class="font-size-h2 text-white my-0 d-inline-block">
                            <i class="fa fa-plus text-white-50 mr-1"></i> Uredi objavo
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
                <div class="block block-rounded block-bordered" id="editPostBlock">
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
                                        <label for="title">Naslov</label>
                                        <input type="text" id="title" class="form-control" name="title" v-model="title" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content">Vsebina</label>
                                    <wysiwyg v-model="content" placeholder="Vnesi vsebino..."></wysiwyg>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="title">Slika</label>
                                        <picture-input
                                                ref="imageInput"
                                                width="300"
                                                height="300"
                                                margin="40"
                                                accept="image/jpeg,image/png"
                                                size="1.5"
                                                :zIndex="1"
                                                :prefill="existing_image"
                                                :removable="true"
                                                button-class="btn btn-primary"
                                                :custom-strings="{upload: '<h1>Neuspešno!</h1>', drag: 'Povleci sliko ali klikni na to okno', change: 'Zamenjaj', remove: 'Odstrani'}"
                                                @change="onChange"
                                                @remove="onRemove">
                                        </picture-input>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-5">
                    Shrani
                </button>
                <button v-on:click="openDeleteModal" type="button" class="btn btn-danger mb-5">
                    Izbriši
                </button>
            </div>
        </form>
        <deletemodal @close="closeDeleteModal" @delete="deletePost(id)">
                <template #header>
                    <h5 class="modal-title" id="exampleModalLongTitle">Izbriši objavo?</h5>
                </template>
                <template #body>
                    <b>ID: </b>{{ id }} <br>
                    <b>Naslov: </b>{{ title }}
                </template>
        </deletemodal>
    </div>
</template>

<script>

    import PictureInput from 'vue-picture-input'

    export default {

        data() {
            return {
                message: '',
                title: '',
                content: '',
                id: null,
                existing_image: null,
                image: null
            }
        },

        components: {
            PictureInput
        },

        mounted() {
            axios.get('posts/' + this.$route.params.id).then((response) => {
                this.title = response.data.title;
                this.content = response.data.content;
                this.id = this.$route.params.id;
                if ( response.data.image !== "" ) {
                    this.existing_image = response.data.image;
                }
            }).catch(error => console.log(error));
        },

        methods: {
            update() {
                Dashmix.block('state_loading', '#editPostBlock');
                let formData = new FormData()
                formData.append("_method", "PUT");
                formData.append('title', this.title)
                formData.append('content', this.content)
                if (this.image !== null) {
                    formData.append('image', this.image)
                }

                axios.post('posts/' + this.id, formData, {
                    headers: {
						'Content-Type': 'multipart/form-data'
					}
                }).then((response) => {
                    this.message = response.data;
                    Dashmix.block("state_normal", "#editPostBlock");
                }).catch((error) => {
                    console.log(error)
                });
            },

            onChange(image) {
                if (image) {
                    this.image = this.$refs.imageInput.file
                }
            },

            onRemove (image) {
                if (image) {
                    this.image = null;
                } else {
                }
            },

            openDeleteModal() {
                $("#deleteModal").modal("show");
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            },

            deletePost(id) {
                axios.post('posts/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.$router.push({ name: 'posts', params: { msg: response.data } }) 
                        this.closeDeleteModal();
                    }).catch((error) => {console.log(error)});
            }
        }
    }
</script>

<style scoped>

    label, h2 {
        color: #1C1C1C;
    }

</style>