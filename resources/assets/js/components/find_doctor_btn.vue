<template>
    <div>
    <slot name="link-to-modal">
        <a href="#find-doctor-modal" class="btn btn_theme_usual popup-with-form" v-bind:class="{ active: isActive }" v-html="message">
        </a>
    </slot>
        <modal :href="path"></modal>
    </div>
</template>

<script>
    import modal from './find_doctor_modal.vue'
    export default {
        data: function () {
            return {
                isActive: false,
                message: 'Найти врача'
            }
        },
        computed:{
            path:function () {
                return `/api/v2/${this.obj}/${this.id}/clicks-count`
            }
        },
        methods: {
            modal_open: function () {
            $('body').magnificPopup('open');
            }
        },
        props:['obj','id'],
        components:{
            modal:modal
        },



    }
</script>

<style scoped>

</style>