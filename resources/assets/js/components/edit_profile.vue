<template>
    <div class="profile-line__main profile-edit-content">
        <div class="section-heading__text"></div>
        <div class="profile-edit-content__body">
            <form>
                <div class="row">
                    <div class="form-group">
                        <label for="name_edit">Имя</label>
                        <input type="text" class="form-control" id="name_edit"  :value="name">
                    </div>
                    <div class="form-group">
                        <label for="surname_edit">Фамилия</label>
                        <input type="text" class="form-control" id="surname_edit" :value="last_name">
                    </div>
                    <div class="form-group">
                        <label for="email_edit">E-mail</label>
                        <input type="email" class="form-control" id="email_edit" :value="email">
                    </div>
                    
                    <div class="form-group">
                        <div class="button-send-container">
                            <button type="button" class="btn btn_theme_usual" id="update_main-send">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="profile-edit-content__body">
            <form>
                <div class="row">
                    <div class="form-group">
                        <label for="old_password">Старый пароль</label>
                        <input type="password" class="form-control" id="old_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Новый пароль</label>
                        <input type="password" class="form-control" id="new_password">
                    </div>
                    <div class="form-group">
                        <label for="reply_password">Повторите пароль</label>
                        <input type="password" class="form-control" id="reply_password">
                    </div>
                    <div class="form-group">
                        <div class="button-send-container">
                            <button type="button" class="btn btn_theme_usual" id="update_password-send">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="profile-edit-content__body">
            <h3>Подтверждение мобильного номера</h3>
            <p>Для защиты Ваших личных данных и повышения безопасности мы введи обязательную привязку мобильного номера телефона к аккаунту. 
                Процедура займет у вас не более 3-х минут и совершенно бесплатна.
            </p>
            <form>
                <div class="row">
                    <div class="form-group">
                        <label for="confirmation_phone">Телефон</label>
                        <input type="password" class="form-control" id="confirmation_phone">
                    </div>
                    <div class="form-group">
                        <label for="confirmation_phone">Код подтверждения</label>
                        <input type="password" class="form-control" id="confirmation_phone">
                    </div>
                    <div class="form-group">
                        <div class="button-send-container">
                            <button type="button" class="btn btn_theme_usual" id="receive_code">Получить код</button>
                            <button type="button" class="btn btn_theme_usual" id="receive_cancel">Отмена</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                res: this.$resource('/api/me'),
                email: '',
                phone: '',
                name: '',
                last_name: '',
                city_name: ''
            }
        },
        mounted: function () {
            this.load()
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
            }
        }
    }
</script>
<style>
    .section-profile{
        width: 100%;
        max-width: 760px;
        margin: auto;
        padding: 20px;
        background: #fff;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.09);
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.09);
    }
    .profile-personal-data__data-line{
        margin: 10px 0;
    }
    .profile-personal-data__data-line label{
        font-size: 12px;
        color: #989898;
        margin-bottom: 5px;
    }
    .profile-content__body .btn_theme_usual{
        margin: 5px 0;
    }
</style>