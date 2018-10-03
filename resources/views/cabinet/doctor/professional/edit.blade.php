@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
            <div class="account-line__main account-content">
                @include('cabinet.components.doctor.profile-header')
                <div class="account-content__body">
                    <div class="doc-prof-data">
                        <form method="post" class="form-with-editor">
                            {{ csrf_field() }}
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__data-lines">
                                    <div class="js-input-lines">
                                        <div class="doc-prof-data__line  account-content__repeat-line repeat-data-line">
                                            <div class="doc-prof-data__line-items doc-prof-data__line-items_close">
                                                <div class="doc-prof-data__data-item account-data-item">
                                                    <div class="account-data-item__name">Квалификация</div>
                                                    <div class="account-data-item__val">
                                                        @if($qualifications)
                                                            @foreach($qualifications as $qualification)
                                                                <label class="doc-prof-data__checkbox-line checkbox-line">
                                                                    <input type="checkbox" name="qualifications[][id]" value="{{ $qualification->id }}"
                                                                        {{ $doctor->checkQualification($qualification) == true ? 'checked':'' }}>
                                                                    <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                    <span class="checkbox-line__text">{{ $qualification->name }}</span>
                                                                </label>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    @if ($errors->has('qualifications'))<p class="error"> {{ $errors->first('qualifications') }} </p> @endif
                                                </div>
                                                <div class="doc-prof-data__data-item account-data-item">
                                                    <div class="account-data-item__name">Стаж работы</div>
                                                    <div class="account-data-item__val"><input type="text" value="{{ old('works_since_year') ? old('works_since_year'): $doctor->works_since_year }}" name="works_since_year" data-mask="С 9999" placeholder="Укажите год">
                                                    </div>
                                                </div>
                                                <div class="doc-prof-data__data-item account-data-item">
                                                    <label class="doc-prof-data__checkbox-line checkbox-line">
                                                        <input type="checkbox" name="child" {{ $doctor->child == 1 ? 'checked': ''}}>
                                                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                        <span class="checkbox-line__text">Детский врач</span>
                                                    </label>
                                                    <label class="doc-prof-data__checkbox-line checkbox-line">
                                                        <input type="checkbox" name="ambulatory" {{ $doctor->ambulatory == 1 ? 'checked': ''}}>
                                                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                        <span class="checkbox-line__text">Выезд на дом</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="doc-prof-data__data-lines js-input-add-container">
                                    <div class="js-input-lines">
                                        @php
                                            $key = 0;
                                        @endphp
                                        @if(count($doctor->skills))
                                            @foreach(($doctor->skills ?? []) as $key => $skill)
                                                <div class="doc-prof-data__line  account-content__repeat-line repeat-data-line js-input-add-entity">
                                                    <div class="doc-prof-data__line-items doc-prof-data__line-items_close">
                                                        <div class="doc-prof-data__data-item doc-prof-data__data-item account-data-item account-data-item_select">
                                                            <div class="account-data-item__name">Специальность</div>
                                                            <div class="account-data-item__val">
                                                                <select name="skills[{{ $key }}][id]" placeholder="Выберите специальность" class="js-simple-select">
                                                                    @if (!$skill)
                                                                        <option value="0">Выберите специальность</option>
                                                                    @endif
                                                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                                                    @if ($skills)
                                                                        @foreach($skills as $item)
                                                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="repeat-data-line__remove-btn js-input-remove-btn"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="doc-prof-data__line  account-content__repeat-line repeat-data-line js-input-add-entity">
                                                <div class="doc-prof-data__line-items doc-prof-data__line-items_close">
                                                    <div class="doc-prof-data__data-item doc-prof-data__data-item account-data-item account-data-item_select">
                                                        <div class="account-data-item__name">Специальность</div>
                                                        <div class="account-data-item__val">
                                                            <select name="skills[{{ $key }}][id]" placeholder="Выберите специальность" class="js-simple-select">
                                                                    <option value="0">Выберите специальность</option>
                                                                @if ($skills)
                                                                    @foreach($skills as $item)
                                                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="repeat-data-line__remove-btn js-input-remove-btn"><i class="fa fa-times" aria-hidden="true"></i></div>
                                            </div>
                                    @endif
                                    </div>
                                    <div class="doc-prof-data__add-input">
                                        <button type="button" class="js-input-add-btn input-add-btn">
                                            <span class="input-add-btn__icon">+</span>
                                            <span class="input-add-btn__text">Добавить специальность</span>
                                        </button>
                                    </div>
                                    <script type="application/javascript">
                                        var entityCount = {{ $key + 1 }};
                                    </script>
                                </div>
                            </div>
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">О себе</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__line-items">
                                            <div class="doc-prof-data__data-item doc-prof-data__data-item_grow account-data-item">
                                                <div class="account-data-item__name">Расскажите подробнее о себе</div>
                                                <div class="account-data-item__val">
                                                    <textarea class="editor" name="about_text">{!! old('about_text') ? old('about_text'):$doctor->about_text  !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Лечение</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__line-items">
                                            <div class="doc-prof-data__data-item doc-prof-data__data-item_grow account-data-item">
                                                <div class="account-data-item__name">Расскажите подробнее о том, какие заболевания вы лечите</div>
                                                <div class="account-data-item__val">
                                                    <textarea class="editor" name="treatment_text">{!! old('treatment_text') ? old('treatment_text'):$doctor->treatment_text  !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Опыт</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__line-items">
                                            <div class="doc-prof-data__data-item doc-prof-data__data-item_grow account-data-item">
                                                <div class="account-data-item__name">Расскажите подробнее о своем опыте</div>
                                                <div class="account-data-item__val">
                                                    <textarea class="editor" name="exp_text">{!! old('exp_text') ? old('exp_text'):$doctor->exp_text  !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Образование и квалификация</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__line-items">
                                            <div class="doc-prof-data__data-item doc-prof-data__data-item_grow account-data-item">
                                                <div class="account-data-item__name">Расскажите подробнее о своем образовании</div>
                                                <div class="account-data-item__val">
                                                    <textarea class="editor" name="grad_text">{!! old('grad_text') ? old('grad_text'):$doctor->grad_text !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Образование и квалификация</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__line-items">
                                            <div class="doc-prof-data__data-item doc-prof-data__data-item_grow account-data-item">
                                                <div class="account-data-item__name">Если у вас имеются сертификаты, вы можете прикрепить их здесь</div>
                                                <div class="account-data-item__val">
                                                    <textarea class="editor" name="certs_text">{!! old('certs_text') ? old('certs_text'):$doctor->certs_text !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__edit-data">
                                <button type="submit" class="btn btn_theme_usual submit-form-with-editor-button">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection