<div class="single-page-item__image">
    <div class="single-page-item__photo">
        {{-- <div class="single-page-item__favorite-btn">
             <i class="fa-icon fa-none"></i>
         </div>--}}
        <img src="{{asset($doctor['avatar'])}}" alt="">
    </div>
    <div class="single-page-item__ticker-bottom">
    </div>
</div>
<!-- /Image -->
<div class="single-page-item__ranking">
    <div class="ranking__rating-view">
        <div class="rating-view__rating-digit">{{round($doctor['avg_rate'],1)}}</div>
        <div class="rating-view__rating-stars ">
            @for($i=1;$i<=5;$i++)
                <i class=" view-rating-star{{$doctor['avg_rate'] >= ($i-1) ? $doctor['avg_rate'] >= ($i-0.5) ? '' : ' star--half': ' star--empty'}}"></i>
            @endfor
        </div>
    </div>
    <div class="ranking__feedbacks">
        <a class="ranking__feedbacks__link" href="#feedbacks">
            {{$doctor['comments_count']}} отзывов
        </a>
    </div>
    <div class="ranking__marks">
        <div class="ranking-marks positive-mark">{{$doctor['positive_comments_count']}}</div>
        <div class="ranking-marks negative-mark">{{$doctor['negative_comments_count']}}</div>
    </div>
</div>
<script>
    $(function () {
        $('.ranking__feedbacks__link').click(function () {
            $('.nav-tabs a[href="#feedbacks"]').tab('show');
            document.getElementById("profile-tabs-container").scrollIntoView();

            return false;
        })
    })
</script>