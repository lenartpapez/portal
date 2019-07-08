<template>
    <nav id="sidebar">
        <div class="bg-header-dark">
            <div class="content-header bg-white-10">
                <router-link class="link-fx font-w600 font-size-lg text-white" :to="{ name: 'dashboard' }">
                    <span class="text-white-75">Admin</span>
                </router-link>
                <div>
                    <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                       href="javascript:void(0)">
                        <i class="fa fa-times-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <router-link class="nav-main-link" :to="{ name: 'dashboard' }">
                        <i class='nav-main-link-icon si si-home'></i>
                        <span class="nav-main-link-name">Domov</span>
                    </router-link>
                    <router-link v-if="$auth.check('super_admin')" class="nav-main-link" :to="{ name: 'users' }">
                        <i class='nav-main-link-icon si si-user'></i>
                        <span class="nav-main-link-name">Uporabniki</span>
                    </router-link>
                    <router-link v-if="$auth.check(['super_admin', 'editor'])" class="nav-main-link" :to="{ name: 'posts' }">
                        <i class='nav-main-link-icon si si-printer'></i>
                        <span class="nav-main-link-name">Novice</span>
                    </router-link>
                    <router-link v-if="$auth.check(['super_admin', 'editor'])" class="nav-main-link" :to="{ name: 'categories' }">
                        <i class='nav-main-link-icon si si-list'></i>
                        <span class="nav-main-link-name">Kategorije</span>
                    </router-link>
                    <router-link v-if="$auth.check(['super_admin', 'editor'])" class="nav-main-link" :to="{ name: 'links' }">
                        <i class='nav-main-link-icon si si-link'></i>
                        <span class="nav-main-link-name">Povezave</span>
                    </router-link>
                     <router-link v-if="$auth.check(['super_admin', 'admin'])" class="nav-main-link" :to="{ name: 'institutes' }">
                        <i class='nav-main-link-icon si si-graduation'></i>
                        <span class="nav-main-link-name">Institucije</span>
                    </router-link>
                    <router-link v-if="$auth.check(['super_admin', 'admin'])" class="nav-main-link" :to="{ name: 'companies' }">
                        <i class='nav-main-link-icon si si-briefcase'></i>
                        <span class="nav-main-link-name">Podjetja</span>
                    </router-link>
                    <a v-if="$auth.check(['super_admin', 'admin'])" class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-refresh"></i>
                        <span class="nav-main-link-name">Dodajanje ciljev</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                           <router-link class="nav-main-link" :to="{ name: 'companygoal' }">
                                <i class='nav-main-link-icon si si-arrow-right'></i>
                                <span class="nav-main-link-name">Podjetja</span>
                            </router-link>
                        </li>
                        <li class="nav-main-item">
                           <router-link class="nav-main-link" :to="{ name: 'institutegoal' }">
                                <i class='nav-main-link-icon si si-arrow-right'></i>
                                <span class="nav-main-link-name">Institucije</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>

    export default {
        data() {
            return {
            }
        },
        methods: {

        }
    }

</script>

<style scoped>


</style>