<div class="search-result-item__name">{{ $doctor['name'] }}</div>

<div class="search-result-item__speciality">{{ $doctor['skills_list'] }}</div>

<div class="search-result-ticker">{{ $doctor['qualification'] }}</div>

<div class="search-result-description">
    <div class="search-result-description__params">
        <div class="row">
            <div class="col-4 col-sm-4">
                <div class="param__item">
                    <div class="param__icon"><img src="{{ asset("img/icons/exp.png") }}" alt=""></div>
                    <div class="param__text">
                        <div class="param__text__title">Стаж работы</div>
                        <div class="param__text__data">{{ $doctor['exp'] }}</div>
                    </div>
                </div>
            </div>
            <!-- /Param 1 -->

            <div class="col-4 col-sm-4">
                <div class="param__item">
                    <div class="param__icon"><img src="{{ asset("img/icons/away.png") }}" alt=""></div>
                    <div class="param__text">
                        <div class="param__text__title">Выезд на дом</div>
                        <div class="param__text__data">{{ $doctor['ambulatory'] ? 'Да' : 'Нет' }}</div>
                    </div>
                </div>
            </div>
            <!-- /Param 2 -->

            <div class="col-4 col-sm-4">
                <div class="param__item">
                    <div class="param__icon"><img src="{{ asset("img/icons/babydoc.png") }}" alt=""></div>
                    <div class="param__text">
                        <div class="param__text__title">Детский врач</div>
                        <div class="param__text__data">{{ $doctor['child'] ? 'Да' : 'Нет' }}</div>
                    </div>
                </div>
            </div>
            <!-- /Param 3 -->
        </div>

        <div class="row pt20">
            <div class="col-sm-12">
                <div class="single-page-item-description__text">
                    Специализируется на лечении и диагностике заболеваний иммунной
                    системы и аллергических заболеваний, хронических вирусных инфекций,
                    атопической бронхиальной астмы, иммунодефицитов
                </div>
                
                <a href="#" class="description__expand-link">Подробнее</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.description__expand-link').click(function () {
            $('.nav-tabs a[href="#about"]').tab('show');

            $('html, body').animate({
                scrollTop: $(".single-page-tabs-container").offset().top
            }, 300);
        });
    </script>
@endpush