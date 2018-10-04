@component('vendor.mail.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('vendor.mail.html.header', ['url' => config('app.url')])
            
        @endcomponent
    @endslot
        {{-- Body --}}
        <table style="width:100%; background-color: #02A0F2;">
            <tr>
                <div style="background-color: #02A0F2;padding: 15px 0; width:100%;">
                    <div style="text-align: center;width: 100%;">
                        <h1 style="font-size: 24px; color: #ffffff; font-weight: bold;text-align: center;">Вы получили ответ на вопрос!</h1>
                    </div>
                    <div style="text-align: center; width:100%;">
                        <div class="box-shadow-container" style="background-color:#ffffff;width: 200px; height: 200px; margin: auto;border-radius: 105px;overflow: hidden;border: 8px solid #ffffff;">
                            <a href="{{route('doctor.item',['alias'=>$doctor->alias])}} ">
                                <img border="0" width="100%" src="https://idoctor.kz/{{$doctor->getAvatar(200,200)}}" alt="iDoctor.kz - бесплатный сервис поиска врача">
                            </a>
                        </div>

                    </div>
                </div>
            </tr>
            <tr>
                <div style="background-color:#ffffff; padding: 15px 0;">
                    <h1 style="color: #4E4E4E; font-size: 19px; font-weight: bold; margin-top: 0; text-align: center;">
                        Доктор <span style="color:#02A0F2;">{{ $doctor->firstname }} {{ $doctor->lastname }} {{ $doctor->middlename }}</span> <br>ответил-(а) на Ваш вопрос:
                    </h1>
                    <p style="color: #4E4E4E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: justify;">
                        {{ $answer->text }}
                    </p>
                </div>
            </tr>
            <tr>
                <div style="background-color: #ffffff; width: 100%; text-align: center;">
                    <a href="{{route('doctor.item',['alias'=>$doctor->alias])}}" target="_blank" style="background-color:#02A0F2; color: #ffffff; padding: 15px;border-radius: 25px;font-weight: bold; text-decoration: none;">Записаться на приём</a>
                </div>
                <div style="background-color: #ffffff; width: 100%; text-align: center; margin-top: 30px;">
                    <a href="{{route('doctor.item',['alias'=>$doctor->alias])}}" target="_blank" style="background-color:#ffffff; color: #02A0F2; font-weight: bold; text-decoration: none;">Оставить отзыв</a>
                </div>
            </tr>
    </table>
        
    
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('vendor.mail.html.subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('vendor.mail.html.footer')
            {{ date('Y') }} © iDoctor.kz
        @endcomponent
    @endslot
@endcomponent