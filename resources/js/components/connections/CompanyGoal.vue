<template>
    <div>
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Podjetja</h1>
                </div>
            </div>
        </div>
        <div class="content">
                <h2 class="content-heading">Dodajanje ciljev</h2>
                <div class="row push">
                    <div class="col-xl-4 col-12">
                        <p class="text-muted">
                            Izberi podjetje, področje in cilj podjetja
                        </p>
                     </div>
                    <div class="col-xl-8 col-12">
                        <div class="js-wizard-simple block block-rounded block-bordered">
                            <form class="js-wizard-simple-form" @submit.stop.prevent="onSubmit">
                                <div class="block-content block-content-full tab-content" style="min-height: 200px;">
                                        <div class="form-group">
                                            <label for="wizard-simple-company">Podjetje</label>
                                            <select class="form-control" id="wizard-simple-company" v-model="selectedCompany" name="wizard-simple-company" required>
                                                <option value="">Izberi podjetje</option>
                                                <option v-for="company in companies" :key="company.id" :value="company.id">
                                                    {{ company.name }}
                                                </option>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label for="wizard-simple-srip">SRIP</label>
                                            <select class="form-control" id="wizard-simple-srip" v-model="selectedSrip" @change="getFields" name="wizard-simple-srip" required>
                                                <option value="">Izberi SRIP</option>
                                                <option value="1">SRIP 3</option>
                                                <option value="2">SRIP 4</option>
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
                                            <label for="wizard-simple-help">Pomanjkljivosti in potrebna pomoč</label>
                                            <textarea class="form-control" v-model="help" id="wizard-simple-help" name="wizard-simple-help" rows="4" placeholder="Dodatno..."></textarea>
                                        </div>
                                        <div class="form-group" >
                                            <label for="wizard-simple-investment-plan">Investicijski plan</label>
                                            <textarea class="form-control" v-model="investment_plan" id="wizard-simple-investment-plan" name="wizard-simple-investment-plan" rows="4" placeholder="Dodatno..."></textarea>
                                        </div>
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
                companies: [],
                fields: [],
                selectedCompany: "",
                selectedSrip: "",
                selectedField: "",
                selectedGoal: "",
                help: "",
                investment_plan: ""
            }
        },

        mounted() {
            this.getCompanies();
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

            getCompanies() {
                this.axios.get('/companies')
                .then(response => {
                    this.companies = response.data;
                });
            },

            getGoals() {
                this.axios.get('goals?field_id=' + this.selectedField)
                .then(response => {
                    this.goals = response.data;
                });
            },

            onSubmit() {
                this.axios.post('company_goal',
                    {
                        company_id: this.selectedCompany,
                        goal_id: this.selectedGoal,
                        help: this.help,
                        investment_plan: this.investment_plan
                    })
                .then((response) => { this.$router.push({ name: 'companies', params: { msg: response.data } }) })
                .catch((error) => { console.log(error)});
            }
        }
    }

</script>