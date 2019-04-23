<template>
    <div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header"></slot>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="body"></slot>
                </div>
                <div class="modal-footer">
                    <button @click="$emit('delete')" class="btn btn-danger mr-2">Izbriši</button>
                    <button @click="$emit('close')" class="btn btn-info">Prekliči</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
            }
        },

        methods: {

        },
    }
</script>

<style scoped>

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }

    .modal-background {
        opacity: 0.4
    }
</style>

