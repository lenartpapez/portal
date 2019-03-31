<template>
    <div>
        <div id="page-container" v-if="!$auth.check()">
            <main id="main-container" >
                <router-view></router-view>
            </main>
        </div>
        <div id="page-container" class="sidebar-o side-scroll page-header-fixed page-header-dark main-content-narrow" v-else>

            <sdbr></sdbr>
            <hdr></hdr>

            <main id="main-container">
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </main>
            <!-- END Main Container -->

        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
            }
        },

        mounted() {

        }

    }

</script>

<style>

    .fade-enter-active, .fade-leave-active {
    transition-property: opacity;
    transition-duration: .15s;
    }

    .fade-enter-active {
    transition-delay: .15s;
    }

    .fade-enter, .fade-leave-active {
    opacity: 0
    }
    
</style>