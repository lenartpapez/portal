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
                            <div class="col-12">
                                <p class="text">
                                    Ime inštituta: <b>{{ data.name }}</b>
                                </p>
                                <p class="text">
                                    Kratica: <b>{{ data.short }}</b>
                                </p>
                                <h2 class="content-heading pt-0 mt-5">Kontaktne osebe:</h2>
                                <p class="text" v-for="contact in data.contacts" :data="contact" :key="contact.id">
                                    <b>{{ contact.contact_name }}</b>, {{ contact.email }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-9 col-12">
                            <h2 class="content-heading pt-0">Cilji</h2>
                            <div class="col-12">
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
            </div>
            <router-link :to="{ name: 'institutes.edit' }" class="btn btn-warning">Popravi</router-link>
                <button @click="openDeleteModal" class="btn btn-danger">
                    Izbriši
                </button>
        </div>
        <deletemodal  @close="closeDeleteModal" @delete="deleteInstitute(data.id)">
            <template #header>
                <h5 class="modal-title" id="exampleModalLongTitle">Izbriši inštitut?</h5>
            </template>
            <template #body>
                <b>ID: </b>{{ data.id }} <br>
                <b>Ime: </b>{{ data.name }}
            </template>
        </deletemodal>
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
            deleteInstitute(id) {
                axios.post('institutes/' + id,{_method: 'delete'})
                    .then((response) => { 
                        this.$router.push({ name: 'institutes', params: { msg: response.data } }) 
                        this.closeDeleteModal();
                    })
                    .catch((error) => { console.log(error)});
            },

            openDeleteModal() {
                $("#deleteModal").modal("show");
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            }
        },

        mounted() {
            axios.get('institutes/' + this.$route.params.id).then((response) => {
                this.data = response.data;
            }).catch(error => console.log(error));
        },

    }
</script>