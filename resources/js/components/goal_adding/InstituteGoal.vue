<template>
    <div>
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Inštitucije</h1>
                </div>
            </div>
        </div>
        <div class="content">
                <div v-if="message !== null" class="alert alert-success mb-3">
                    {{ message }}
                </div>
                <h2 class="content-heading">Dodajanje ciljev</h2>
                <div class="row push">
                    <div class="col-xl-4 col-12">
                        <p class="text-muted">
                            Izberi inštitut, področje in cilj inštituta
                        </p>
                     </div>
                    <div class="col-xl-8 col-12">
                        <div class="js-wizard-simple block block-rounded block-bordered">
                            <form class="js-wizard-simple-form" @submit.stop.prevent="onSubmit">
                                <div class="block-content block-content-full tab-content" style="min-height: 200px;">
                                        <div class="form-group">
                                            <label for="wizard-simple-institute">Inštitut</label>
                                            <select class="form-control" id="wizard-simple-institute" v-model="selectedInstitute" name="wizard-simple-institute" required>
                                                <option value="">Izberi inštitut</option>
                                                <option v-for="institute in institutes" :key="institute.id" :value="institute.id">
                                                    {{ institute.name }}
                                                </option>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label for="wizard-simple-srip">Fokusno področje</label>
                                            <select class="form-control" id="wizard-simple-srip" v-model="selectedSrip" @change="getFields" name="wizard-simple-srip" required>
                                                <option value="">Izberi FP</option>
                                                <option value="1">3. FP</option>
                                                <option value="2">4. FP</option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label for="wizard-simple-field">Področje</label>
                                            <select :disabled="selectedSrip === ''" class="form-control" @change="getGoals" v-model="selectedField" id="wizard-simple-field" name="wizard-simple-field" required>
                                                <option value="">Izberi področje</option>
                                                <option v-for="field in fields" :key="field.id" :value="field.id">
                                                    {{ field.name }}
                                                </option>
                                            </select>
                                        </div>
                                         <div class="form-group" >
                                            <label for="wizard-simple-goal">Cilj</label>
                                            <select :disabled="selectedField === ''" class="form-control" v-model="selectedGoal" id="wizard-simple-goal" name="wizard-simple-goal" required>
                                                <option value="">Izberi cilj</option>
                                                <option v-for="goal in goals" :key="goal.id" :value="goal.id">
                                                    {{ goal.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label for="wizard-simple-services">Storitve, ki jih nudijo *</label>
                                            <textarea class="form-control" v-model="services" id="wizard-simple-services" name="wizard-simple-services" rows="4" placeholder="Dodatno..."></textarea>
                                        </div>
                                        <div class="form-group" >
                                            <label for="wizard-simple-possibilities">Možnost aplikacije v prakso *</label>
                                            <textarea class="form-control" v-model="possibilities" id="wizard-simple-possibilities" name="wizard-simple-possibilities" rows="4" placeholder="Dodatno..."></textarea>
                                        </div>
                                        <p class="text-muted">* Vpis je obvezen. Če ni podatka, vnesite '/'</p>
                                </div>
                                <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-primary d-inline">
                                                <i class="fa fa-check mr-1"></i> Dodaj
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                goals: [],
                institutes: [],
                fields: [],
                selectedInstitute: "",
                selectedSrip: "",
                selectedField: "",
                selectedGoal: "",
                services: "",
                possibilities: "",
                message: null
            }
        },

        mounted() {
            this.getInstitutes();
        },

        methods: {

            getFields() {
                this.fields = [];
                if(this.selectedSrip !== "") {
                    axios.get('/fields?srip_id=' + this.selectedSrip)
                    .then(response => {
                        this.fields = response.data;
                    });
                }
            },

            getInstitutes() {
                this.axios.get('/institutes')
                .then(response => {
                    this.institutes = response.data;
                });
            },

            getGoals() {
                this.axios.get('goals?field_id=' + this.selectedField)
                .then(response => {
                    this.goals = response.data;
                });
            },

            onSubmit() {
                this.axios.post('institute_goal',
                    {
                        institute_id: this.selectedInstitute,
                        goal_id: this.selectedGoal,
                        services: this.services,
                        possibilities: this.possibilities
                    })
                .then((response) => { this.message = response.data })
                .catch((error) => { console.log(error)});
            }
        }
    }

</script>