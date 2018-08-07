<div class="main-header__action-item main-header-location">
    <select name="location" class="js-header-location" placeholder="{{\App\Helpers\SessionContext::city()->name}}">
        @if(\App\City::active()->get())
            @foreach(\App\City::active()->get() as $city)
                <option value="{{ $city->id }}" {{\App\Helpers\SessionContext::cityId() == $city->id ? 'selected':''}}>{{ $city->name }}</option>
            @endforeach
        @endif
    </select>
</div>