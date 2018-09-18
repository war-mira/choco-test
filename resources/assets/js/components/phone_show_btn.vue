<template>
    <div class="phone__block">
        <p class="btn btn_theme_usual">
            <i class="fa fa-phone"></i>
            <slot name="phone-number">
                <span class="phone-number__short">+7 (777)</span>
                <a class="phone-number__show" v-bind:class="{ active: isActive }" @click.prevent="send" v-html="message">
                </a>
            </slot>
        </p>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                isActive: false,
                message: 'Показать номер',
            }
        },
        methods: {
            send: function () {
                this.$http.get(`/api/v2/${this.model}/${this.id}/clicks-count`)
                    .then(
                        (response) => {
                            console.log(response.data);
                            this.message = (response.data);
                            this.isActive = true;
                        },
                        (error) => {
                        }
                    );
            }
        },
        props: ['model', 'id'],


    }
</script>

<style scoped>

</style>