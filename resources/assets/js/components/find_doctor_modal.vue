<template>
    <div>
        <slot name="modal">
            <div id="find-doctor-modal" class="white-popup mfp-hide">
                <form @submit.prevent="send">
                    <div class="leave-review__heading">Найти врача</div>
                    <br/>
                    <div class="find-doctor_message" v-bind:class="{ active: isActive }" v-html="message"></div>
                    <div class="leave-account-review__line">
                        <div class="explain-text">
                            Спасибо за обращение! На данный момент врач не принимает заявки на платформе idoctor.kz, но
                            наша команда усиленно работает над поиском лучших врачей для
                            вас. Вы можете оставить свой email, и мы уведомим вас о возможности записаться к врачу,
                            когда он
                            подключится к платформе.
                        </div>
                    </div>
                    <div class="leave-review__input-line">
                        <div class="leave-review__input-item" id="phone-group">
                            <input v-model="user_phone" placeholder="*Телефон" class="form-control" required name="phone"
                                   type="text" data-mask="+7 (999) 999-99-99">
                        </div>
                        <div class="leave-review__submit">
                            <button type="submit" class="btn btn_theme_usual">Оставить телефон</button>
                        </div>
                    </div>
                </form>
            </div>
        </slot>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                message: '',
                errors: [],
                user_phone: ''
            }
        },
        watch: {
            user_phone: function (newval, oldval) {
                console.log(newval);
                this.user_phone =val;
            }
        },
        methods: {
            send: function () {
                this.$http[this.method](
                    this.href, {params: {data: this.user_phone}}
                )
                    .then(
                        (response) => {
                            console.log(response.data);
                            this.message = (response.data);
                            this.isActive = true;
                        },
                        (error) => {
                        }
                    );
            }
        },
        props: {
            href: String,
            method: {
                type: String,
                default: 'get'
            },
            // data:{
            //     type:String,
            //     default:this.$refs.myTestField.value
            // }

        }


    }
</script>

<style scoped>

</style>