<template>
    <div class="account-line__main account-content">



        <div class="account-content__head">
            <div class="account-content__page-name">Отзывы ({{ total }})</div>
        </div>





        <div class="account-content__body">
            <div class="reviews-list">


                <div class="reviews-list__message" v-if="comments.length==0">
                    <div class="account-data-item__val">Здесь пока нет вопросов =(</div>
                </div>


                <div class="reviews-list__item reviews-list-item"
                     v-for="comment in comments"
                     :class="{blur:(answer_review && !isActive(comment))}"
                     :id="'review-'+comment.id"
                >

                    <div class="reviews-list-item__inner">
                        <div class="reviews-list-item__line">
                            <div class="reviews-list-item__data-wr">
                                <div class="reviews-list-item__data" style="flex-direction: column">
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Текст отзыва</div>
                                        <div class="account-data-item__val">{{ comment.text }}</div>
                                    </div>
                                    <div v-if="comment.replies.length>0">
                                        <div class="reviews-list-item__data-item account-data-item" >
                                            <div class="account-data-item__name">Ответы</div>
                                            <div class="account-data-item__val with-border-row" v-for="reply in comment.replies">
                                                {{ reply.text }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reviews-list-item__line">
                            <div class="reviews-list-item__data-wr">
                                <div class="reviews-list-item__data">
                                    <!--<div class="reviews-list-item__data-item account-data-item">-->
                                    <!--<div class="account-data-item__name">Прием</div>-->
                                    <!--<div class="account-data-item__val">#1435</div>-->
                                    <!--</div>-->
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Автор</div>
                                        <div class="account-data-item__val">{{ comment.user_name }}</div>
                                    </div>
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Оценка</div>
                                        <div class="account-data-item__val">
                                            <div class="rating-line rating-line_blue">
                                                <div class="rating-line__stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Дата</div>
                                        <div class="account-data-item__val">{{ comment.created_at}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="reviews-list-item__action">
                                <a :href="'#review-'+comment.id"
                                   class="btn btn_theme_usual"
                                   :class="{'btn-cancel':isActive(comment)}"
                                   @click="toggleReply(comment)"
                                >{{ isActive(comment)?'Отмена':'Ответить' }}</a>
                            </div>
                        </div>
                    </div>


                    <transition name="slide-fade">
                        <div class="account-content__body" v-if="isActive(comment)">
                            <div class="account-content__body-heading">
                                <i class="fa fa-level-up" aria-hidden="true"></i>
                                <span>Ответ на отзыв</span>
                            </div>
                            <div class="leave-account-review">
                                <div class="leave-account-review__line">
                                    <div class="leave-account-review__input">
                                        <div class="account-data-item">
                                            <div class="account-data-item__name">Напишите ваш ответ</div>
                                            <div class="account-data-item__val">
                                                <textarea name="leave-account-review" v-model="answer"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="leave-account-review__aside">
                                        <button class="btn btn_theme_usual" @click='reply'>Отправить ответ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>

                </div>


                <div class="reviews-list__pagination pagination">

                    <span class="pagination__item"
                          :class="{pagination__item_active:(page==page_current)}"
                          v-for="page in page_total"
                          @click="page_current = page"
                    >{{ page }}</span>
                    <!--<a href="#" class="pagination__item">Последняя</a>-->
                </div>
            </div>


        </div>
    </div>


</template>
<style>
    .pagination__item{
        cursor: pointer;
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s ease;
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active до версии 2.1.8 */ {
        transform: translateY(40px);
        opacity: 0;
    }
    .btn{
        background: #00A8FF;
        transition: all .3s ease;
    }
    .btn-cancel{
        background:#ffc107;
        transition: all .3s ease;
    }
</style>
<script>
    export default {
        data() {
            return {
                res: this.$resource('/api/my/reviews{/id}'),
                comments: [],
                page_current: 1,
                page_total: 1,
                total: 0,
                answer_review: null,
                answer: '',
            }
        },
        mounted: function () {
            this.load()
        },
        watch: {
            page_current: function (value) {
                this.load();
            }
        },
        methods: {
            load: function () {

                this.res.get({page: this.page_current}).then((response) => {
                    this.comments = response.data.data;
                    this.page_total = response.data.last_page;
                    this.total = response.data.total;

                    window.scrollTo(0,0);
                }, (response) => {
                });

            },
            reply: function () {
                this.res.update({ id:this.answer_review.id },
                {
                    reply:this.answer
                }).then(
                    (response) => {
                        this.answer_review.replies.push(response.data);
                        this.answer='';
                        this.toggleReply(this.answer_review);
                        toastr.success('Сохранено')
                    },
                    (error) => {
                        console.log(error)
                    }
                )
            },
            toggleReply:function(elem){
                this.answer_review = this.isActive(elem)?null:elem;
            },
            isActive:function (elem) {
                return this.answer_review && this.answer_review.id == elem.id
            }

        }
    }
</script>
