@component('templates.profile-card')
    @slot('img','images/temp/120x120/user_avatar_1.jpg')
    @slot('title')
        <a href="#777" class="link-primary">Подгородецкий С. А.</a>
    @endslot
    @slot('extraTitle','Терапевт')
    @slot('content')
        <p><strong>Прием проведен</strong> 14 апреля 2017 в 14:30</p>
        <h3 class="profiles__rating">Пожалуйста, оцените работу врача:</h3>
        <span class="rating">
                <input type="radio" class="rating__input" id="rating-input-1-5"
                       name="rating-input-1">
                <label for="rating-input-1-5" class="rating__star"></label>
                <input type="radio" class="rating__input" id="rating-input-1-4"
                       name="rating-input-1">
                <label for="rating-input-1-4" class="rating__star"></label>
                <input type="radio" class="rating__input" id="rating-input-1-3"
                       name="rating-input-1">
                <label for="rating-input-1-3" class="rating__star"></label>
                <input type="radio" class="rating__input" id="rating-input-1-2"
                       name="rating-input-1">
                <label for="rating-input-1-2" class="rating__star"></label>
                <input type="radio" class="rating__input" id="rating-input-1-1"
                       name="rating-input-1">
                <label for="rating-input-1-1" class="rating__star"></label>
        </span>
    @endslot
@endcomponent