<template>
    <header id="page-header">
        <div class="content-header">
            <div>
                <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>
            <div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">{{$auth.user().name}}</span>
                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-2">
                            <a class="dropdown-item" href="#" @click.prevent="$auth.logout({ redirect: {name: 'login'} })">
                                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i>Odjava
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
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