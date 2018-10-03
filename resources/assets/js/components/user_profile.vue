<template>
    <div class="profile-line__main profile-content">
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
            <a data-toggle="modal" href="" class="btn btn_theme_usual">Редактировать профиль</a>
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