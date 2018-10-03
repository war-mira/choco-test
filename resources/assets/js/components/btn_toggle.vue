<template>
    <div style="display: flex;">
        <input type="checkbox" :name="id" :id="id" v-model="dat" class="cmn-toggle cmn-toggle-round">
        <label :for="id"></label>
        <label :for="id"><slot></slot></label>
    </div>
</template>
<style>

</style>
<script>
    export default {
        data(){
            return{
                msg:'',
                id: Math.random().toString(36).substring(7)
            }
        },
        mounted() {

        },
        computed:{
            dat:{
                get:function () {
                    return  !!+this.value;
                },
                set:function (val) {

                    this.$http[this.method](
                        this.href, { [this.name]: +val }
                    ).then(
                        (response) => {
                            toastr.success('Сохранено')
                            console.log(response)
                            this.$emit('ready',response.data)
                        },
                        (error) => { console.log(error)   }
                    )



//                     this.$http.post(
//                         `/api/user/${this.user}/admin`,
//                         { isAdmin:val }
//                     ).then(
//                         (response) => {
//                             if(response.data.isAdmin)
//                                 toastr.success('Сохранено')
//                             else
//                                 toastr.warning('Не сохранено')
// //                            this.$emit('toast','Пользователь назначен администратором');
//
// //                            this.value = response.isAdmin;
//                         },
//                         (error) => { console.log(error)   }
//                     )
                }
            }
        },
        props:{
            href:String,
            method:{
                type:String,
                default:'post'
            },
            name:String,
            value:{
                default:0
            },
            css:{
                type:String,
                default:'btn red-btn'
            }
        }
    }
</script>
