@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
            <div class="account-line__main account-content">
                @include('cabinet.components.doctor.profile-header')
                <div class="account-content__body">
                    <div class="doc-prof-data">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__data-lines">
                                    <div class="js-input-lines">
                                        <div class="doc-prof-data__line  account-content__repeat-line repeat-data-line">
                                            <div class="doc-prof-data__line-items doc-prof-data__line-items_close">
                                                <div class="doc-prof-data__data-item account-data-item account-data-item_select">
                                                    <div class="account-data-item__name">Квалификация</div>
                                                    <div class="account-data-item__val">
                                                        <select name="qualification" placeholder="Выберите квалификацию" class="js-simple-select">
                                                            @if($doctor->qualification)
                                                                <option value="{{ $doctor->qualification }}">{{ $doctor->qualification }}</option>
                                                            @else
                                                                <option value="">Выберите квалификацию</option>
                                                            @endif
                                                            <option value="Врач">Врач</option>
                                                            <option value="Врач высшей категории">Врач высшей категории</option>
                                                            <option value="Кандидат медицинских наук">Кандидат медицинских наук</option>
                                                            <option value="Психолог высшей категории">Психолог высшей категории</option>
                                                            <option value="Врач терапевт высшей категории">Врач терапевт высшей категории</option>
                                                            <option value="Врач высшей категории, КМН">Врач высшей категории, КМН</option>
                                                            <option value="Врач второй категории">Врач второй категории</option>
                                                            <option value="Врач первой категории">Врач первой категории</option>
                                                            <option value="КМН, высшая категория">КМН, высшая категория</option>
                                                            <option value="Отличник здравоохранения">Отличник здравоохранения</option>
                                                            <option value="Магистр медицинских наук">Магистр медицинских наук</option>
                                                            <option value="Доктор медицинских наук">Доктор медицинских наук</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="doc-prof-data__data-item account-data-item">
                                                    <div class="account-data-item__name">Стаж работы</div>
                                                    <div class="account-data-item__val">
                                                        <input type="text" value="{{ $doctor->works_since_year }}" name="works_since_year" data-mask="9999" placeholder="Укажите год">
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
                                                    <textarea name="about_text">{!! $doctor->about_text  !!}</textarea>
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
                                                <div class="account-data-item__name">Расскажите подробнее о себе</div>
                                                <div class="account-data-item__val">
                                                    <textarea name="treatment_text" class="">{!! $doctor->treatment_text  !!}</textarea>
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
                                                <div class="account-data-item__name">Расскажите подробнее о себе</div>
                                                <div class="account-data-item__val">
                                                    <textarea name="exp_text">{!! strip_tags($doctor->exp_text)  !!}</textarea>
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
                                                <div class="account-data-item__name">Расскажите подробнее о себе</div>
                                                <div class="account-data-item__val">
                                                    <textarea name="grad_text">{!! $doctor->grad_text !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doc-prof-data__edit-data">
                                <button type="submit" class="btn btn_theme_usual">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection