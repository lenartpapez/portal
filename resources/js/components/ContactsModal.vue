<template>
        <div class="modal fade" id="contactsModal" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Kontakti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="contacts"></slot>
                    </div>
                    <div class="modal-footer">
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

<style>

    .modal-body {
        overflow-x: auto;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 900px !important;
        }
    }

</style>

