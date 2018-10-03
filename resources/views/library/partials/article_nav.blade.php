@if($links)
    <div class="article-nav__block">
        <div class="article-nav__title">
            Содержание статьи
        </div>
        <div class="article-nav__list">
            <ul>
                @php
                    $lastKey = count($links);
                @endphp
                @foreach($links as $key => $link)
                    @if(!empty($link))
                        <li @if($key == $lastKey - 1) class="last" @endif><a href="#" class="article-nav__link js-anchor-link">{{ strip_tags($link) }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif