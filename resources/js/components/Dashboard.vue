<template>
    <div>
        <div class="bg-white-90">
            <div class="content content-full">
                <div class="row">
                    <div class="col-md-6 d-md-flex align-items-md-center">
                        <div class="py-4 py-md-0 text-center text-md-left js-appear-enabled animated fadeIn" data-toggle="appear">
                            <h1 class="font-size-h2 mb-2">Dashboard</h1>
                            <h2 class="font-size-lg font-w400 text-muted mb-0">Informacijski portal</h2>
                        </div>
                    </div>
                    <div class="col-md-6 d-md-flex align-items-md-center">
                        <div class="row w-100 text-center">
                            <div class="col-6 col-xl-4 offset-xl-4 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="300">
                                <p class="font-size-h3 font-w600 text-body-color-dark mb-0">
                                    {{ instituteCount }}
                                </p>
                                <p class="font-size-sm font-w700 text-uppercase mb-0">
                                    <i class="si si-graduation text-muted mr-1"></i> Inštitutov
                                </p>
                            </div>
                            <div class="col-6 col-xl-4 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="600">
                                <p class="font-size-h3 font-w600 text-body-color-dark mb-0">
                                    {{ companyCount }}
                                </p>
                                <p class="font-size-sm font-w700 text-uppercase mb-0">
                                    <i class="si si-briefcase text-muted mr-1"></i> Podjetij
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-xl-3 js-appear-enabled animated fadeIn" data-toggle="appear">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <span class="js-sparkline js-sparkline-enabled" data-type="line" data-points="[340,330,360,340,360,350,370,360]" data-width="90px" data-height="40px" data-line-color="#82b54b" data-fill-color="transparent" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#82b54b" data-highlight-line-color="#82b54b" data-tooltip-suffix="Users"><canvas width="90" height="40" style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-muted mb-0">
                                    Področij
                                </p>
                                <p class="font-size-h3 font-w300 mb-0">
                                    {{  fieldCount }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="200">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <span class="js-sparkline js-sparkline-enabled" data-type="line" data-points="[21,17,19,25,24,25,18,27]" data-width="90px" data-height="40px" data-line-color="#e04f1a" data-fill-color="transparent" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#e04f1a" data-highlight-line-color="#e04f1a" data-tooltip-suffix="Tickets"><canvas width="90" height="40" style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-muted mb-0">
                                    Ciljev
                                </p>
                                <p class="font-size-h3 font-w300 mb-0">
                                    {{ goalCount }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="400">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <span class="js-sparkline js-sparkline-enabled" data-type="line" data-points="[7,9,5,2,3,4,8,3]" data-width="90px" data-height="40px" data-line-color="#3c90df" data-fill-color="transparent" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#3c90df" data-highlight-line-color="#3c90df" data-tooltip-suffix="Projects"><canvas width="90" height="40" style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-muted mb-0">
                                    Sodelujoči inštituti
                                </p>
                                <p class="font-size-h3 font-w300 mb-0">
                                    {{ connectedInstituteCount }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="600">
                    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <span class="js-sparkline js-sparkline-enabled" data-type="line" data-points="[68,25,36,62,59,80,75,89]" data-width="90px" data-height="40px" data-line-color="#343a40" data-fill-color="transparent" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#343a40" data-highlight-line-color="#343a40" data-tooltip-suffix="Sales"><canvas width="90" height="40" style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-muted mb-0">
                                    Sodelujoča podjetja
                                </p>
                                <p class="font-size-h3 font-w300 mb-0">
                                    {{ connectedCompaniesCount }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                postCount: 0,
                instituteCount: 0,
                connectedInstituteCount: 0,
                companyCount: 0,
                connectedCompaniesCount: 0,
                fieldCount: 0,
                goalCount: 0,
                loading: this.isActive
            }
        },

        props: {
            isActive: Boolean
        },

        mounted() {
            this.getPostCount();
            this.getInstituteCount();
            this.getCompanyCount();
            this.getFieldCount();
            this.getGoalCount();
            setTimeout(function() {
                this.loading = false;
            }.bind(this), 1000)
        },

        methods: {
            getPostCount() {
                this.axios.get('posts')
                    .then((response) => { this.postCount = response.data })
                    .catch((error) => { console.log(error)});
            },

            getInstituteCount() {
                this.axios.get('institutes?count')
                    .then((response) => { 
                        this.instituteCount = response.data.institutes;
                        this.connectedInstituteCount = response.data.connectedInstitutes;
                    })
                    .catch((error) => { console.log(error)});
            },

            getCompanyCount() {
                this.axios.get('companies?count')
                    .then((response) => { 
                        this.companyCount = response.data.companies;
                        this.connectedCompaniesCount = response.data.connectedCompanies;
                    })
                    .catch((error) => { console.log(error)});
            },

            getFieldCount() {
                this.axios.get('fields?count')
                    .then((response) => { 
                        this.fieldCount = response.data;
                    })
                    .catch((error) => { console.log(error)});
            },

            getGoalCount() {
                this.axios.get('goals?count')
                    .then((response) => { 
                        this.goalCount = response.data;
                    })
                    .catch((error) => { console.log(error)});
            }

        },

        /* beforeRouteEnter (to, from, next) {
            next(vm => {
                console.log(from);
                if(from.name === 'login') {
                    vm.isActive = true;
                    setTimeout(function() {
                        vm.isActive = false;
                    }.bind(this), 1000);
                }
            });
        }, */

    }

</script>

<style scoped>


</style>