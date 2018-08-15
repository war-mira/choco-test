<template>

    <div class="session-app">
        <div class="active-sessions">
            <div class="card my-2" v-for="(user, id) in sessions">
                <div class="card-header">{{ user.user }} ({{ id }})</div>

                <div class="list-group list-group-flush" v-for="(device, csrf) in user.devices">
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1">{{ device.device }}</h3>
                        </div>

                        <div class="list-group list-group-flush">

                            <div v-for="socket in device.tabs" class="list-group-item socket-item" @click="current = socket" :class="{active:(current==socket)}">
                                <strong>
                                    <img :src="'https://avatars.dicebear.com/v2/identicon/'+socket.tabId+'.svg'" style="height:26px;">
                                    {{ socket.tabId }}</strong>
                                <p class="mb-1">{{ socket.page }}</p>
                                <small>{{ socket.address }} - {{ socket.socket}}</small>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="session-viewer">
            <div class="session-info" v-if="current">
                <div class="details pl-2">
                    <div><i class="fa-link fa"></i> <a :href="current.page" target="_blank">{{ current.page }}</a></div>
                    <div><small>{{ current.user_agent }}</small></div>
                </div>
                <div class="actions ">
                    <div class="p-1">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary">Вызвать чат</button>
                            <div class="btn-group" role="group">
                                <button id="sessionActions"
                                        type="button"
                                        class="btn btn-outline-secondary dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                >
                                    <!--Действия-->
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sessionActions">
                                    <a class="dropdown-item" href="#">Снимок экрана</a>
                                    <a class="dropdown-item" href="#" @click="login(10)">Авторизовать</a>
                                    <a class="dropdown-item" href="#" @click="redirect('https://dev.idoctor.kz/')">Перенаправить</a>
                                    <a class="dropdown-item" href="#">Отправить файл</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="session-control">
                <div class="module-block">

                    <div class="row">
                        <div class="col">

                            <div class="m-3">
                                <div class="input-group input-group-sm">
                                    <!--<select-user v-model="user"></select-user>-->
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" @click="login(user)">Авторизовать</button>
                                    </div>
                                </div>

                            </div>




                        </div>
                    </div>




                </div>
            </div>
        </div>

    </div>






</template>
<style>
    .session-app{
        display: flex;
        width: 100%;
        height: 100%;
    }
    .active-sessions{
        border-right: 1px solid #888;
    }

    .session-viewer{
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .session-viewer .details{
        flex-grow: 1;
    }

    .session-info{
        border-bottom: 1px solid #888;
        display: flex;
    }
    .socket-item{
        cursor: pointer;
    }
</style>
<script>
    import btn from './btn_ajax.vue'
    // import selectUser from './inp_selectUser.vue'
    export default{
        data(){
            return{
                sessions:collect([]),
                current:null,
                user:null
            }
        },
        mounted() {
            socket.on('active-sessions',(data)=>{
                this.sessions = collect(JSON.parse(data).items).values().groupBy(function (item) {
                    return item.user? item.user.id : null;
                }).transform(function (user, key) {
                    return {
                        'user': key > 0 ? user.items[0].user.username: 'Гость',
                        'devices': collect(user.items).groupBy('csrf').transform(function (device,csrf) {
                            return {
                                'device': csrf,
                                'tabs': device.items
                            }
                        }).items
                    }
                }).items;
            })
        },
        methods:{
            redirect:function (url){
                socket.emit('socket redirect',this.current.socket,url)
            }  ,
            login:function (uid){
                socket.emit('manual authorization',this.current.socket,uid)
            }
        },
        components:{
            'btn':btn,
            // 'select-user':selectUser
        },
    }
</script>
