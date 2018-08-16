<div class="account-line__aside">
    <div class="account-nav">
        <a href="{{route('cabinet.doctor.personal.index')}}" class="account-nav__item">
            <span class="account-nav__item-icon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
            <span class="account-nav__item-text">Личные данные</span>
        </a>
        <a href="{{route('cabinet.doctor.questions.index')}}" class="account-nav__item">
            <span class="account-nav__item-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
            <span class="account-nav__item-text">Вопросы</span>
        </a>
        <a href="{{route('cabinet.doctor.feedback.index')}}" class="account-nav__item">
            <span class="account-nav__item-icon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
            <span class="account-nav__item-text">Мои отзывы</span>
        </a>
        <a href="{{ url('/logout') }}" class="button account-nav__item"
           onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
            <span class="account-nav__item-icon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
            <span class="account-nav__item-text">Выйти</span>
        </a>
    </div>
</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>