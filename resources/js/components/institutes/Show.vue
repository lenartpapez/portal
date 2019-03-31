<template>
    <div>
        <div class="bg-image">
            <div class="bg-primary-light">
                <div class="content content-full justify-content-between d-flex">
                    <h1 class="font-size-h2 text-white my-0 d-inline-block">
                        {{ data.name }}
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
                    <div class="row push">
                        <div class="col-xl-3 col-12">
                            <h2 class="content-heading pt-0">Podatki</h2>
                        </div>
                        <div class="col-xl-9 col-12">
                            <h2 class="content-heading pt-0">Cilji</h2>
                        </div>
                    </div>
                    <div class="row push">
                        <div class="col-xl-3 col-12">
                            <p class="text">
                                Ime inštituta: <b>{{ data.name }}</b>
                            </p>
                             <p class="text">
                                Konktaktna oseba: <b>{{ data.contact_name }}</b>
                            </p>
                             <p class="text">
                                Kratica: <b>{{ data.short }}</b>
                            </p>
                             <p class="text">
                                Email: <b>{{ data.email }}</b>
                            </p>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div class="block block-rounded block-bordered block-mode-hidden" v-for="goal in data.goals" :key="goal.id">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">{{ goal.field.name }} <small> {{ goal.name }}</small></h3>
                                    <div class="block-options">              
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                                    </div>
                                </div>
                                <div class="block-content hide">
                                    <p>Storitve, ki jih nudijo: {{ goal.pivot.services }}</p>
                                    <p>Možnost aplikacije v prakso: {{ goal.pivot.possibilities }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <router-link :to="{ name: 'edit' }" class="btn btn-warning">Popravi</router-link>
                <button @click="showModal = true" class="btn btn-danger">
                    Izbriši
                </button>
        </div>
        <deletemodal v-if="showModal" @close="showModal = false" @delete="deleteInstitute">Izbriši objavo? <br> ID: {{ $route.params.id }}</deletemodal>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                showModal: false,
                data: []
            }
        },

        methods: {
            deleteInstitute() {
                axios.post('institutes/' + this.$route.params.id,{_method: 'delete'})
                    .then((response) => { this.$router.push({ name: 'institutes', params: { msg: response.data[1] } }) })
                    .catch((error) => { console.log(error)});
            },
        },

        mounted() {
            axios.get('institutes/' + this.$route.params.id).then((response) => {
                this.data = response.data;
            }).catch(error => console.log(error));
        },

    }
</script>