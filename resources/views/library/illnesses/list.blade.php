@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')

@section('breadcrumbs')
    @include('search.default',[
        'route'=>route('illness.search')
    ])
    {{ Breadcrumbs::render('illnesses.index',$query??'') }}
@endsection
@section('content')
    <section class="section pattern-bg doc-letter-search">
    <div class="container">
        @if(isset($letter))
        <div class="section-heading doc-letter-search__heading">
            <div class="section-heading__text">Заболевания на букву {{ $letter }}</div>
        </div>
            @else
            <div class="section-heading doc-letter-search__heading">
                <div class="section-heading__text">{{$meta['h1']}}</div>
            </div>
        @endif
        <div class="doc-letter-search__search illnesses-letter__search">
            <div class="doc-letter-search__nav">
                @if(isset($letters))
                    @if($letters)
                        @foreach($letters as $oneLetter)
                            <a href="{{ route('illnesses.index', $oneLetter) }}"
                               class="doc-letter-search__nav-item
                               @if($oneLetter == $letter)
                                       active
                                @elseif(!\App\Models\Library\Illness::getByLetter($oneLetter)->count())
                                       no-active
                                @endif">{{ $oneLetter }}</a>
                        @endforeach
                    @endif
                @endif
            </div>
            @if($illnesses)
                <div class="doc-letter-search__result">
                    @foreach($illnesses->chunk(ceil($illnesses->count()/4)) as $illnessesColumn)
                        <div class="doc-letter-search__result-column">
                            @foreach($illnessesColumn as $illness)
                                <a href="{{ route('illness', $illness->alias) }}" class="doc-letter-search__result-item">
                                    <span class="doc-letter-search__result-item-text">{{ $illness->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection