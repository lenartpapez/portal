<template>
    <div>
        <form @submit.prevent="addComment">
            <div class="form-row mb-3">
                <div class="col">
                    <wysiwyg id="comments" v-model="comment" placeholder="Vnesi komentar..."></wysiwyg>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary postsBtn">Dodaj komentar</button>
                </div>
            </div>
        </form>
        <div class="container mt-4" style="min-height: unset; padding-top: unset; padding-bottom: unset;">
            <vue-element-loading spinner="line-scale" color="#1C3D5A" :active="isLoading"/>
            <div class="row mb-3" style="padding: 20px 30px; background: #f7f7f7; border: 1px solid #eee" v-for="comment in comments" :key="comment.id">
                <div class="media">
                    <div class="media-body">
                        <p class="mt-3"><b>{{ comment.created_at | format }}</b></p>
                        <p class="mt-0" style="font-size: 16px">{{ comment.user.name }}</p>
                        <p style="font-size: 16px">{{ comment.content }}</p>
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
                id: '',
                comment: '',
                comments: [],
                isLoading: true
            }
        },

        mounted() {
            setTimeout(function() {
                this.isLoading = false;
            }.bind(this), 1000);
            this.id = window.location.pathname.split('/').pop();
            this.getComments();
        },

        methods: {
            getComments() {
                axios.get(this.id + '/comments').then((response) => {
                    this.comments = response.data;
                }).catch(error => console.log(error));
            },

            addComment() {
                axios.post('addcomment', {
                    post_id: this.id,
                    comment: this.comment
                }).then((response) => {
                    setTimeout(function() {
                        this.getComments();
                    }.bind(this), 500);
                    this.comment = '';
                })
                    .catch((error) => { console.log(error)});
                this.isLoading = true;
                setTimeout(function() {
                    this.isLoading = false;
                }.bind(this), 1000);
            }
        },

        filters: {
            format: function (value) {
                value = value.split(" ");
                let date = value[0].split("-");
                let time = value[1].split(":");
                return date[2] + "." + date[1] + "." + date[0].slice(-2) + " " + time[0] + ":" + time[1];
            }
        },
    }
</script>

<style scoped>



</style>