@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
            <div class="account-line__main account-content">
                @include('cabinet.components.doctor.profile-header')
                <div class="account-content__body">
                <div class="doc-personal-data">
                    <div class="doc-personal-data__line">
                        <div class="doc-personal-data__img">
                            <div class="entity-thumb-img">
                                <div class="entity-thumb-img__img-wr">
                                    <img src="{{ url($doctor->avatar) }}" alt="" class="entity-thumb-img__img entity-thumb-img__img_shadow" height="200">
                                    <button class="entity-thumb-img__edit-img js-edit-img-modal"><i class="fa fa-camera" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="doc-personal-data__data-lines">
                            <div class="doc-personal-data__data-line">
                                <div class="doc-personal-data__data-item account-data-item">
                                    <div class="account-data-item__name">ФИО</div>
                                    <div class="account-data-item__val">{{ $doctor->firstname }} {{ $doctor->lastname }} {{ $doctor->middlename }}</div>
                                </div>
                            </div>
                            <div class="doc-personal-data__data-line">
                                <div class="doc-personal-data__data-item account-data-item">
                                    <div class="account-data-item__name">Дата рождения</div>
                                    <div class="account-data-item__val">{{ date('Y-m-d', strtotime($user->birthday) )}}</div>
                                </div>
                            </div>
                            <div class="doc-personal-data__data-line">
                                <div class="doc-personal-data__data-item account-data-item">
                                    <div class="account-data-item__name">Номер телефона</div>
                                    <div class="account-data-item__val">{{ $doctor->phone ? \App\Helpers\FormatHelper::phone($doctor->phone): \App\Helpers\FormatHelper::phone($user->phone) }}</div>
                                </div>
                                <div class="doc-personal-data__data-item account-data-item">
                                    <div class="account-data-item__name">Номер телефона для отображения</div>
                                    <div class="account-data-item__val">{{ $doctor->showing_phone }}</div>
                                </div>
                                <div class="doc-personal-data__data-item account-data-item">
                                    <div class="account-data-item__name">E-mail</div>
                                    <div class="account-data-item__val">{{$doctor->email ? $doctor->email: $user->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doc-personal-data__edit-data">
                        <a href="{{route('cabinet.doctor.personal.edit')}}" class="btn btn_theme_usual">Редактировать</a>
                    </div>
                </div>
            </div>
            </div>
    </div>
    @include('cabinet.components.doctor.modals.modal-upload')
@endsection