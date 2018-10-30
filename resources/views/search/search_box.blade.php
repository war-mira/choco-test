<section class="search-bar-container pattern-bg">
    <div class="container">
        <div class="search-bar" style="background: transparent">
            {{--<form action="{{route('doctors.list',['skill'=>(isset($skill) ? $skill->alias : '')])}}" class="search-bar__line index-search-bar__line">--}}
                {{--<input type="hidden" name="sort" value="@if(isset($_GET['sort'])) {{$_GET['sort']}} @endif" />--}}
                {{--<input type="hidden" name="order" value="@if(isset($_GET['order'])) {{$_GET['order']}} @endif" />--}}
                {{--<input type="hidden" name="medc" value="@if(isset($skill)){{$skill->alias}}@endif" />--}}
                {{--<div class="search-bar__item search-bar__item_type">--}}
                    {{--<select name="type" placeholder="Поиск медцентра" class="js-simple-select js-type-select" data-select="action">--}}
                        {{--<option value="doctor" @if((!isset($_GET['type']) || ($_GET['type'] == 'doctor')) && !isset($skill->alias)) selected="selected" @endif>Найти врача</option>--}}
                        {{--<option value="medcenter" @if((isset($_GET['type']) && $_GET['type'] == 'medcenters') && (!isset($_GET['q']) || empty($_GET['q'])) || isset($skill->alias)) selected="selected" @endif>Найти медцентр</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="search-bar__item search-bar__item_search">--}}
                    {{--<input id="searchform" name="q" value="{{isset($query) && isset($query['q']) ? $query['q']:''}}" placeholder="Введите специальность или фамилию врача" class="js-search-input"  autocomplete="off">--}}
                    {{--<label for="searchform" class="input-block__icon"><img src="{{asset('/img/icons/search-inactive.png')}}" alt=""></label>--}}
                    {{--<div class="live-search">--}}
                        {{--<div class="live-search__inner" id="liveresults">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="search-bar__item search-bar__item_region">--}}
                    {{--<select name="district" class="js-simple-select js-select-region">--}}
                        {{--<option value="0">Выберите район</option>--}}
                        {{--@foreach(\App\Models\District::all() as $district)--}}
                            {{--<option {{ $district->id == request()->input('district') ? 'selected':'' }} value="{{ $district->id }}">{{ $district->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="search-bar__item search-bar__item_checkbox">--}}
                    {{--<label class="search-bar__checkbox-line checkbox-line">--}}
                        {{--<input type="checkbox" name="child" @if(isset($_GET['child']) && $_GET['child']) checked @endif  value="1"/>--}}
                        {{--<span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>--}}
                        {{--<span class="checkbox-line__text">Детский врач</span>--}}
                    {{--</label>--}}
                    {{--<label class="search-bar__checkbox-line checkbox-line">--}}
                        {{--<input type="checkbox" value="1" name="ambulatory" @if(isset($_GET['ambulatory']) && $_GET['ambulatory']) checked @endif />--}}
                        {{--<span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>--}}
                        {{--<span class="checkbox-line__text">Выезд на дом</span>--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="search-bar__item search-bar__item_submit">--}}
                    {{--<button class="btn">Найти</button>--}}
                {{--</div>--}}
            {{--</form>--}}
            <live-search model="Doctor-{{ \App\Helpers\SessionContext::city()->alias }}"></live-search>
        </div>


    </div>
</section>
