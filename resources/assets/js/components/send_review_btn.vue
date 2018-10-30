<template>
    <div>
        <slot name="send-review-btn">
            <a href="#comment__modal" class="btn btn_theme_usual popup-with-form" v-bind:class="{ active: isActive }" v-html="message">
            </a>
        </slot>
        <modal :user="comment_user" :type="comment_type" :ownerId="owner_id" :ownerType="owner_type"></modal>
    </div>
</template>

<script>
    import modal from './send_comment_modal.vue'
    export default {
        data: function () {
            return {
                isActive: false,
                message: 'Оставить отзыв',
                comment_user: this.user,
                comment_type: this.type,
                owner_id: this.ownerId,
                owner_type: this.ownerType,
            }
        },
        methods: {
            modal_open: function () {
            $('body').magnificPopup('open');
            }
        },
        props:['user', 'type', 'ownerType', 'ownerId'],
        components:{
            modal:modal
        },



    }
</script>

<style scoped>

</style>