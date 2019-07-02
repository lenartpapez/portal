<template>
    <form method="post" @submit.stop.prevent="create">
        <div class="bg-image">
            <div class="bg-primary-light">
                <div class="content content-full justify-content-between d-flex">
                    <h1 class="font-size-h2 text-white my-0 d-inline-block">
                        <i class="fa fa-plus text-white-50 mr-1"></i> Dodaj inštitucijo
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
                                    <label for="title">Ime inštitucije</label>
                                    <input type="text" id="name" class="form-control" name="name" v-model="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="title">Kratica</label>
                                    <input type="text" id="short" class="form-control" name="short" v-model="short" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="title">Spletna stran</label>
                                    <input type="url" id="website" class="form-control" name="website" v-model="website">
                                </div>
                            </div>

                        </div>
                    </div>
                    <h2 class="content-heading pt-0">Kontakti</h2>
                    <div class="row push">
                        <div class="col-xl-4 col-12">
                            <p class="text-muted">
                                Podatki
                            </p>
                        </div>
                        <div class="col-lg-10 col-xl-8">
                            <button class="btn btn-secondary btn-sm" v-on:click="addContact" type="button">Dodaj</button>
                            <button class="btn btn-secondary btn-sm" v-on:click="removeContact" type="button">Odstrani</button>
                            <div class="form-group row mt-3" v-for="(con, index) in contacts" :key="index">
                                <div class="col-md-4">
                                    <label for="title">Ime kontakta</label>
                                    <input type="text" id="contact_name" class="form-control" name="contact_name" v-model="contacts[index].contact_name" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="title">Email naslov</label>
                                    <input type="email" id="contact_email" class="form-control" name="contact_email" v-model="contacts[index].email" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-lg-10 col-xl-8 offset-xl-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="fa fa-save"></i> Dodaj
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

    export default {

        data() {
            return {
                name: '',
                short: '',
                website: null,
                contacts: []
            }
        },

        methods: {

            create() {
                axios.post('institutes', {
                    name: this.name,
                    short: this.short,
                    website: this.website,
                    contacts: this.contacts
                }).then((response) => { this.$router.push({ name: 'institutes', params: { msg: response.data } }) })
                    .catch((error) => { console.log(error)});
            },

            addContact() {
                this.contacts.push({ 'contact_name': '', 'email': '' });
            },

            removeContact() {
                this.contacts.pop();
            }
        }
    }

</script>

<style>

</style>>

