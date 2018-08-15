<template>
    <button @click.prevent="send" :class="css">
        <slot>Отправить</slot>
    </button>
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
                  (error) => { console.log(error)   }
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
                default:'btn red-btn'
            }
        }
    }
</script>
