<template>
        <div class="row no-gutters justify-content-center bg-primary-light-op">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                        <div class="mb-2 text-center">
                            <a class="link-fx font-w700 font-size-h1" href="/">
                                <span class="text-dark">Portal</span><span class="text-primary">admin</span>
                            </a>
                        </div>
                        <vue-element-loading :active="wasError">
                            <div class="alert alert-danger" v-if="error">
                                {{ msg }}
                            </div>
                        </vue-element-loading>
                        <form class="js-validation-signin" @submit.prevent="login()">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" v-model="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" v-model="password" placeholder="Password">

                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-hero-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                error: false,
                msg: 'Vnesli ste napačne podatke.',
                isActive: true,
                wasError: false
            }
        },
        methods: {
            login() {
                var app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: () => {
                        if(this.$auth.check('editor')) {
                            this.$router.push({name: 'posts'});
                        }
                    },
                    error: (error) => {
                        this.error = error;
                        this.msg = error.response.data.msg;
                        this.wasError = true;
                        setTimeout(function() {
                            this.wasError = false;
                        }.bind(this), 1500);
                    },
                    rememberMe: false,
                    redirect: '/',
                    fetchUser: true,
                });
            },
        },

        beforeRouteLeave(to, from, next) {
            to.params.isActive = true;
            next();
        }
    }
</script>

<style scoped>



</style>