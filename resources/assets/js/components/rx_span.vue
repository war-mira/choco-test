<template>
    <span>{{ value }}</span>
</template>

<script>
    export default {
        name: "rx_span",
        mounted:function(){
            socket.on('rx-'+this.name,function (msg) {
                this.value = msg;
            }.bind(this))
        },
        props:['value','name']
    }
</script>

<style scoped>

</style>