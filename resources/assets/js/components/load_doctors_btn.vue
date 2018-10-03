<template>
    <div class="doc-list__more">
        <slot name="load-doctors-link">
            <div class="hidden_more" v-html="html">

            </div>
            <a class="btn btn_theme_more" @click.prevent="send">Еще
                <span id="docsLeftText" v-html="quantity"></span> врачей</a>
        </slot>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                quantity: this.quantity,
                html: '',
                offset:this.visible,
                isActive:true
            }
        },
        methods: {
            send: function () {
                this.$http.get(`/api/v2/${this.model}/${this.id}/load-doctors`, {params: {offset: this.offset}})
                    .then(
                        (response) => {
                            console.log(response.data);
                            this.html = (response.data.view);
                            this.quantity = (response.data.left);
                            this.offset = (response.data.offset);

                            if(this.quantity <= 0){
                                this.isActive = false;
                            }
                        },

                        // $vm.$forceUpdate(),
                        // this.$set,
                        (error) => {
                        }
                    );
            }
        },
        props: ['model', 'id', 'visible', 'quantity'],
        // components:{
        //     phoneNumber:phoneNumber
        // },


    }
</script>

<style scoped>

</style>