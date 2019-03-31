<template>
    <div>
        <div class="bg-image">
            <div class="bg-primary-light">
                <div class="content content-full justify-content-between d-flex">
                    <h1 class="font-size-h2 text-white my-0 d-inline-block">
                        {{ title }}
                    </h1>
                    <a class="btn btn-light" @click="$router.go(-1)">
                        <i class="fas fa-arrow-left"></i> Nazaj
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="block block-rounded block-bordered" id="createPostBlock">
                <div class="block-content">
                    <h2 class="content-heading pt-0">Vsebina</h2>
                    <div class="row push">
                        <div class="col-xl-3 col-12">
                            <p class="text-muted">
                                *img*
                            </p>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div v-html="content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <router-link :to="{ name: 'edit' }" class="btn btn-warning">Popravi</router-link>
                <button @click="showModal = true" class="btn btn-danger">
                    Izbriši
                </button>
        </div>
        <deletemodal v-if="showModal" @close="showModal = false" @delete="deletePost">Izbriši objavo? <br> ID: {{ $route.params.id }}</deletemodal>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                showModal: false,
                title: '',
                content: '',
                image: ''
            }
        },

        methods: {
            deletePost() {
                axios.post('posts/' + this.$route.params.id,{_method: 'delete'})
                    .then((response) => { this.$router.push({ name: 'posts', params: { msg: response.data[1] } }) })
                    .catch((error) => { console.log(error)});
            },
        },

        mounted() {
            axios.get('posts/' + this.$route.params.id).then((response) => {
                this.title = response.data.title;
                this.content = response.data.content;
                this.image = response.data.image;
            }).catch(error => console.log(error));
        },

    }
</script>