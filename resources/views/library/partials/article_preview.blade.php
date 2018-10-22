<a href="{{  route('library.illnesses-group-article', [$group->alias, $article->alias])}}" style="height: 100%;" class="article_link">
    <div class="blog-item blog-list__list-item toning"
         style="background-image: url({{ URL::asset($article->image)}});">
        <div class="blog-item__name">{{$article->name}}</div>
        <div class="blog-item__bot-line">
            <a href="{{  route('library.illnesses-group-article', [$group->alias, $article->alias])}}"
               class="blog-item__link"><span>Читать целиком</span>
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            <div class="blog-item__date">
                <div>Дата публикации</div>
                <div>{{$article->created_at->format('Y-m-d')}}</div>
            </div>
        </div>
    </div>
</a>