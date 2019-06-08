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
                    <transition name="fade">
                                <div v-if="message !== undefined" class="alert alert-success alert-dismissable d-flex align-items-center" role="alert">
                                    <div class="flex-fill ml-3">
                                        <p class="mb-0">{{ message }}</p>
                                    </div>
                                    <button type="button" class="close" @click="message = undefined" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </transition>
                    <div class="row push">
                        <div class="col-xl-5 col-12 mb-3">
                            <h2 class="content-heading pt-0">Podatki</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Ime podjetja:</label>
                                    <input type="text" id="name" class="form-control" v-model="data.name" />
                                </div>
                                <div class="form-group">
                                    <label for="short">Kratica:</label>
                                    <input type="text" id="short" class="form-control" v-model="data.short" />
                                </div>
                                <h2 class="content-heading pt-0 mt-5">Kontaktne osebe:</h2>
                                <div class="form-group row mt-3 mb-3" v-for="(con, index) in data.contacts" :key="index">
                                    <div class="col-md-5">
                                        <label for="contact_name">Ime kontakta</label>
                                        <input type="text" id="contact_name" class="form-control" v-model="data.contacts[index].contact_name" required>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="contact_email">Email naslov</label>
                                        <input type="email" id="contact_email" class="form-control" v-model="data.contacts[index].email" required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-secondary btn-sm" @click="addContact" type="button">Dodaj</button>
                                    <button class="btn btn-secondary btn-sm" @click="removeContact" type="button">Odstrani</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-12">
                            <h2 class="content-heading pt-0">Cilji</h2>
                            <div class="col-12">
                                <div class="block block-rounded block-bordered block-mode-hidden" v-for="goal in data.goals" :key="goal.id">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">{{ goal.field.name }} <small> {{ goal.name }}</small></h3>
                                        <div class="block-options">              
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle">
                                                <i class="si si-arrow-down"></i>
                                            </button>
                                            <button type="button" class="btn-block-option" v-on:click="deleteConnection(goal.id)" data-toggle="block-option" data-action="close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content hide">
                                        <div class="form-group">
                                            <label for="help">Pomanjkljivosti in potrebna pomoč:</label>
                                            <textarea class="form-control" id="help" rows="3" v-model="goal.pivot.help"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="investment_plan">Investicijski plan:</label>
                                            <textarea class="form-control" id="investment_plan" rows="3" v-model="goal.pivot.investment_plan"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button @click="onSave" class="btn btn-success mb-5">
                Shrani
            </button>
            <button @click="openDeleteModal" class="btn btn-danger mb-5">
                Izbriši
            </button>
        </div>
        <deletemodal @close="closeDeleteModal" @delete="deleteCompany(data.id)">
            <template #header>
                <h5 class="modal-title" id="exampleModalLongTitle">Izbriši podjetje?</h5>
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
                data: [],
                message: undefined
            }
        },

        methods: {
            deleteConnection(id) {
                axios.post('company_goal?company_id=' + this.$route.params.id + "&goal_id=" + id, { _method: 'delete' })
                    .then((response) => { this.message = response.data })
                    .catch((error) => { console.log(error)});
            },

            deleteCompany(id) {
                axios.post('companies/' + id, {_method: 'delete'})
                    .then((response) => {
                        this.$router.push({ name: 'companies', params: { msg: response.data } }) 
                        this.closeDeleteModal();
                    }).catch((error) => {console.log(error)});
            },

            addContact() {
                this.data.contacts.push({ 'contact_name': '', 'email': '' });
            },

            removeContact() {
                this.data.contacts.pop();
            },

            onSave() {
                axios.post('companies/' + this.data.id, {_method: 'put', data: this.data })
                    .then(response => {
                        this.message = response.data;
                    })
                    .catch(error => {
                        this.message = error;
                    });
            },

            openDeleteModal() {
                $("#deleteModal").modal("show");
            },

            closeDeleteModal() {
                $("#deleteModal").modal("hide");
            }

        },

        mounted() {
            axios.get('companies/' + this.$route.params.id).then((response) => {
                this.data = response.data;
            }).catch(error => console.log(error));
        },
        

    }
</script>

<style lang="sass">
    .block-content.hide p {
        font-size: .9rem;
    }
</style>