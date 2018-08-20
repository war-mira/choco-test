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


                <div class="reviews-list__item reviews-list-item" v-for="comment in comments">
                    <div class="reviews-list-item__inner">
                        <div class="reviews-list-item__line">
                            <div class="reviews-list-item__data-wr">
                                <div class="reviews-list-item__data">
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Текст отзыва</div>
                                        <div class="account-data-item__val">{{ comment.text }}</div>
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
                                <a href="#" class="btn btn_theme_usual">Подробнее</a>
                            </div>
                        </div>
                    </div>
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
</style>
<script>
    export default {
        data() {
            return {
                res: this.$resource('/api/my/reviews'),
                comments: [],
                page_current: 1,
                page_total: 1,
                total: 0,
                responce: '',
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
            create: function () {
                this.res.save(this.responce).then(
                    (response) => {
                        // this.groups.push(response.data)
                        // this.group = {
                        //     key:'system',
                        //     name:'',
                        //     description:''
                        // };
                        toastr.success('Сохранено')
                    },
                    (error) => {
                        console.log(error)
                    }
                )
            }
        }
    }
</script>
