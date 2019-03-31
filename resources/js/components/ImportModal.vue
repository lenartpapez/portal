<template>
        <div class="modal bg-dark" id="importModal" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Predogled uvoza</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button @click="$emit('import')" class="btn btn-success mr-2">Uvozi</button>
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

</style>

