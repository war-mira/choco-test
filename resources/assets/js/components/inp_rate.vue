<template>
    <span>
        <!--<a href="#" class="fa fa-angle-up"></a>-->
        <btn css="no-padding btn btn-link" :href="path" :data="{mark:1}" @ready="sent"><i class="fa fa-angle-up"></i></btn>
        <slot v-if="!val"></slot><span v-if="val">{{ val }}</span>
        <btn css="no-padding btn btn-link" :href="path" :data="{mark:-1}" @ready="sent"><i class="fa fa-angle-down"></i></btn>
    </span>
</template>
<style>
    .no-padding{
        padding: 0;
    }
</style>
<script>
    import btn from './btn_ajax.vue'
    export default{
        data(){
            return{
                val:null,
            }
        },
        computed:{
            path:function () {
                return `/api/${this.obj}/${this.id}/vote`
            }
        },
        mounted:function(){
            socket.emit('join',`${this.obj}:${this.id}`);
            socket.on('NewVoteEvent',function (msg) {
                console.log(msg);
                this.val = msg.vote;
            }.bind(this))
        },
        props:['obj','id','type'],
        components:{
            'btn':btn
        },
        methods:{
            sent:function (vote) {
                this.val = vote.karma;
            },
        },
    }
</script>
