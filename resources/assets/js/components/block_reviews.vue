<template>

    <div class="reviews-list">


        <div class="reviews-list__message" v-if="comments.length==0">
            <div class="account-data-item__val">Здесь пока нет вопросов =(</div>
        </div>
        <div class="btn btn-success" @click="load">load</div>



        <div class="reviews-list__item reviews-list-item" v-for="comment in comments">
            <div class="reviews-list-item__inner">
                <div class="reviews-list-item__line">
                    <div class="reviews-list-item__data-wr">
                        <div class="reviews-list-item__data">
                            <div class="reviews-list-item__data-item account-data-item">
                                <div class="account-data-item__name">Текст отзыва</div>
                                <div class="account-data-item__val">Новая модель организационной деятельности обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Не следует, однако забывать, что рамки и место обучения кадров требуют определения и уточнения форм развития. Значимость этих проблем настолько очевидна, что сложившаяся структура организации позволяет оценить значение форм развития.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="reviews-list-item__line">
                    <div class="reviews-list-item__data-wr">
                        <div class="reviews-list-item__data">
                            <div class="reviews-list-item__data-item account-data-item">
                                <div class="account-data-item__name">Прием</div>
                                <div class="account-data-item__val">#1435</div>
                            </div>
                            <div class="reviews-list-item__data-item account-data-item">
                                <div class="account-data-item__name">Пациент</div>
                                <div class="account-data-item__val">Протасова Марина Андреевна</div>
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
                                <div class="account-data-item__name">Дата приема</div>
                                <div class="account-data-item__val">25.01.2018</div>
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
            <span class="pagination__item pagination__item_active">1</span>
            <a href="#" class="pagination__item">2</a>
            <a href="#" class="pagination__item">3</a>
            <a href="#" class="pagination__item">4</a>
            <a href="#" class="pagination__item">5</a>
            <a href="#" class="pagination__item">Последняя</a>
        </div>
    </div>





</template>
<style>

</style>
<script>
    export default{
        data(){
            return{
                res: this.$resource('/api/my/reviews'),
                comments:[],

            }
        },
        mounted:function(){
            this.load()
        },
        methods:{
            load: function(){

                console.log('load!',this.comments)
                this.res.get().then((response) => {
                    this.comments = response.data;
                }, (response) => {  });

            },
            create: function() {
                this.res.save(this.group).then(
                    (response) => {
                        this.groups.push(response.data)
                        this.group = {
                            key:'system',
                            name:'',
                            description:''
                        };
                        toastr.success('Сохранено')
                    },
                    (error) => { console.log(error)   }
                )
            }
        }
    }
</script>
