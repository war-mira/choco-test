<template>
    <span @click.prevent="send" :class="css" style="cursor:pointer">
        <slot>Отправить</slot>
    </span>
</template>
<style>

</style>
<script>
    export default {
        data(){
            return{
                msg:''
            }
        },
        mounted() {

        },
        methods:{
          send:function () {
              this.$http[this.method](
                  this.href, this.data
              ).then(
                  (response) => {
                      toastr.success('Сохранено')
                      console.log(response)
                      this.$emit('ready',response.data)
                  },
                  (error) => {
                      this.$emit('failed',error)
                  }
              )
          }
        },
        props:{
            href:String,
            method:{
                type:String,
                default:'post'
            },
            data:{
                type:Object,
                default:function () {
                    return {}
                }
            },
            css:{
                type:String,
                default:''
            }
        }
    }
</script>
