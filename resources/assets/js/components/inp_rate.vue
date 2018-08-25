<template>

    <div class="entity-thumb-img__thumb-control thumb-control">
        <span class="thumb-control__item" data-type="1">
            <span class="thumb-control__val">
                <slot name="likes" v-if="!updated"></slot><span v-if="updated">{{ val.likes }}</span>
            </span>
            <btn css="no-padding" :href="path" :data="{mark:1}" @failed="failed" @ready="sent"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></btn>
        </span>




        <span class="thumb-control__item down" data-type="2">
            <span class="thumb-control__val">
                <slot name="dislikes" v-if="!updated"></slot><span v-if="updated">{{ val.dislikes }}</span>
            </span>
            <btn css="no-padding" :href="path" :data="{mark:-1}" @failed="failed" @ready="sent"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></btn>
        </span>

    </div>

</template>
<style>

</style>
<script>
    import btn from './btn_ajax.vue'
    export default{
        data(){
            return{
                val:{
                    'rate':0,
                    'karma':0,
                    'likes':0,
                    'dislikes':0,
                },
                updated:false
            }
        },
        computed:{
            path:function () {
                return `/api/v2/${this.obj}/${this.id}/vote`
            }
        },
        mounted:function(){
            socket.emit('join',`${this.obj}:${this.id}`);
            socket.on('NewVoteEvent',function (msg) {
                // toastr.warning('vote');
                if(msg.obj == this.obj && msg.obj_id == this.id){
                    console.log(msg);
                    this.val = msg.values;
                    this.updated = true;
                }

            }.bind(this))
        },
        props:['obj','id','type'],
        components:{
            'btn':btn
        },
        methods:{
            sent:function (vote) {
                this.val = vote;
                this.updated = true;
            },
            failed:function (err) {
                if(err.status == 401)
                    toastr.error('Необходимо авторизоваться!')
            },
        },
    }
</script>
