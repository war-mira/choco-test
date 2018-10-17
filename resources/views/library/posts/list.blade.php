@extends('redesign.layouts.inner-page')
@section('breadcrumbs')
    {{ Breadcrumbs::render('posts') }}
@endsection
@section('content')
    <div class="container">
        <div class="blog-list__list">
            <div class="library-list_heading blog-list__heading">
                <div class="section-heading__text">Блог</div>
            </div>
            @foreach($posts as $post)
            <a href="{{ route('post', [$post->alias])}}" style="height: 100%;">
                <div class="blog-item blog-list__list-item toning"
                     style="background-image: url({{ URL::asset($post->cover_image)}});">
                    <div class="blog-item__name">{{$post->title}}</div>
                    <div class="blog-item__bot-line">
                        <a href="{{  route('post', [$post->alias])}}"
                           class="blog-item__link"><span>Читать целиком</span>
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                        <div class="blog-item__date">
                            <div>Дата публикации</div>
                            <div>{{$post->created_at->format('Y-m-d')}}</div>
                        </div>
                    </div>
                </div>
                </a>
            @endforeach
        </div>
    </div>
    @if($posts->links() != "")
        <div class="text-center search-pagination posts-pagination" id="topPagination">
            {!! $posts->links() !!}
        </div>
    @endif
@endsection