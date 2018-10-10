<template>
    <div class="profile-content__body">
        <div class="profile-line__main profile-content" v-if="!edit_prof_show">
            <div class="section-heading__text"></div>
            <div class="profile-content__body">
                <div class="profile-personal-data__data-lines">
                    <div class="profile-personal-data__data-line">
                        <label>Имя: </label>
                        <p>{{ name + ' ' + last_name}}</p>
                    </div>
                    <div class="profile-personal-data__data-line">
                        <label>Телефон: </label>
                        <p>{{ phone }}</p>
                    </div>
                    <div class="profile-personal-data__data-line">
                        <label>E-mail: </label>
                        <p>{{ email }}</p>
                    </div>
                    <div class="profile-personal-data__data-line">
                        <label>Город: </label>
                        <p>{{ city_name }}</p>
                    </div>
                </div>
                <div class="form-group profile-btn-block">
                   <button v-on:click="edit_prof_show = !edit_prof_show" class="btn btn_theme_usual">Редактировать профиль</button> 
                </div>
                
            </div>
        </div>
        <transition name="fade">
            <div class="profile-line__main profile-edit-content" v-if="edit_prof_show">
                <div class="section-heading__text"></div>
                <div class="profile-edit-content__body profile_main_info">
                    <form id="update-main-form" @submit.prevent="updateMainProfile">
                        <h3 class="profile_delimiter">Основная информация</h3>
                        <div class="row">
                            <div class="form-group">
                                <label for="name_edit">Имя *</label>
                                <input type="text" class="form-control" name="new_name" v-model="name" required>
                            </div>
                            <div class="form-group">
                                <label for="surname_edit">Фамилия *</label>
                                <input type="text" class="form-control" name="new_surname" v-model="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email_edit">E-mail</label>
                                <input type="email" class="form-control" name="new_email" v-model="email">
                            </div>
                            <div class="form-group">
                                <div class="button-send-container">
                                    <button type="submit" class="btn btn_theme_usual" id="update_main-send">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="profile-edit-content__body">
                    <form @submit.prevent="updatePassword">
                        <h3 class="profile_delimiter">Пароль</h3>
                        <div class="row">
                            <div class="form-group">
                                <label for="new_password">Новый пароль</label>
                                <input type="password" class="form-control" name="new_password" v-model="new_password">
                            </div>
                            <div class="form-group">
                                <label for="reply_password">Повторите пароль</label>
                                <input type="password" class="form-control" name="reply_password" v-model="reply_password">
                            </div>
                            <div class="form-group">
                                <div class="button-send-container">
                                    <button type="submit" class="btn btn_theme_usual">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="profile-edit-content__body profile-edit-mobile">
                    <h3 class="profile_delimiter">Изменить номер телефона</h3>
                    <p>Для защиты Ваших личных данных и повышения безопасности мы введи обязательную привязку мобильного номера телефона к аккаунту. 
                        Процедура займет у вас не более 3-х минут и совершенно бесплатна.
                    </p>
                    <form @submit.prevent="changePhoneStepOne">
                        <div class="row">
                            <div class="form-group">
                                <label for="confirmation_phone">Телефон</label>
                                <input type="tel" id="profile_phone" class="form-control" v-model="phone" pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="phone" title="Телефон в формате +7 (XXX) XXX XX-XX">
                            </div>
                            <transition name="slide-fade">
                                <div class="form-group" v-if="show_mobile">
                                    <label for="confirmation_phone">Код подтверждения</label>
                                    <input type="text" class="form-control" v-model="code">
                                </div>
                            </transition>
                            <div class="form-group">
                                <div class="button-send-container">
                                    <button type="submit" class="btn btn_theme_usual" v-if="!show_mobile">Получить код</button>
                                    <button type="button" class="btn btn_theme_usual" v-if="show_mobile" v-on:click="changePhoneStepTwo">Отправить код</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </transition>
        <a href="#" v-if="edit_prof_show" v-on:click="edit_prof_show = !edit_prof_show" class="_link">Вернуться к профилю</a>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                edit_prof_show: false,
                show_mobile: false,
                res: this.$resource('/api/me'),
                email: '',
                phone: '',
                name: '',
                last_name: '',
                city_name: '',
                new_name: '',
                new_surname: '',
                new_email: '',
                new_password: '',
                reply_password: '',
                conf_phone: '',
                code: ''
                
            }
        },
        mounted: function () { 
            this.load()
        },
        watch:{
          edit_prof_show:function(val){
            setTimeout(function(){
                $('input[name="phone"]').mask('+7 (999) 999-9999');
            },1);
          }  
        },
        methods: {
            load: function () {
               this.res.get().then((response) => {
                    this.name = response.data.name;
                    this.last_name = response.data.lastname;
                    this.email = response.data.email;
                    this.phone = response.data.phone;
                    this.city_name = response.data.city.name;
                }, (response) => {
                    
                });
            },
            updateMainProfile: function () {
                this.$http.post(`/api/user/update`,{name: this.name, lastname: this.last_name, email: this.email})
                    .then(function (response){
                        if(response.status == 200){
                            toastr.success(response.data.msg);
                        }else{
                            console.log(response.json());
                        }
                        this.load()
                    }).catch(e => {
                        let res = JSON.parse(e.bodyText);
                        toastr.error(res.errors.phone[0]);
                    });
            },
            updatePassword: function () {
                if(this.new_password != this.reply_password){
                    toastr.error('Пароли не совпадают');
                }else{
                    this.$http.post(`/api/user/updatePassword`, {password: this.new_password, password_confirmation: this.reply_password })
                    .then(function (response){
                        if(response.status == 200){
                            toastr.success(response.data.msg);
                        }else{
                            toastr.error(response.data.msg);
                        }
                    }).catch(e => {
                        console.log(e);
                    });
                }
            }, 
            changePhoneStepOne: function(){
                this.$http.post(`/api/user/getCode`, {phone: this.phone})
                .then(function (response){
                    if(response.status == 200){
                        toastr.success(response.data.msg);
                        this.show_mobile = true;
                    }else{
                        toastr.error(response.data.msg);
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            changePhoneStepTwo: function(){
                this.$http.post(`/api/user/checkCode`, {phone: this.phone, code:this.code})
                    .then(function (response){
                        if(response.status == 200){
                            toastr.success(response.data.success.message);
                        }else{
                            toastr.error(response.data.error.message);
                        }
                    }).catch(e => {
                        toastr.error('Ошибка');
                    });
            }
        }
    }
</script>