@component('vendor.mail.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('vendor.mail.html.header', ['url' => config('app.url')])
            
        @endcomponent
    @endslot
        {{-- Body --}}
        <table>
            <tr>
                <div style="background-color: #02A0F2;padding: 15px;">
                    <div style="text-align: center;width: 100%;">
                        <a href="https://idoctor.kz/" style="text-decoration:none;">
                            <img border="0" width="157" height="50" src="https://habrastorage.org/webt/p8/tu/ha/p8tuhav-qsbe08eaxbafigiatjw.png" alt="iDoctor.kz - бесплатный сервис поиска врача">
                        </a>
                        <h1 style="font-size: 24px; color: #ffffff; font-weight: bold;text-align: center;">Вы получили ответ на вопрос!</h1>
                    </div>
                    <div style="text-align: center; width:100%;">
                        <div class="box-shadow-container" style="background-color:#ffffff;width: 200px; height: 200px; margin: auto;border-radius: 105px;overflow: hidden;border: 8px solid #ffffff;">
                            <a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">
                                <img border="0" width="100%" src="{{$doctor->getAvatar(200,200)}}" alt="iDoctor.kz - бесплатный сервис поиска врача">
                            </a>
                        </div>

                    </div>
                </div>
            </tr>
            <tr>
                <div style="background-color:#ffffff; padding: 15px;">
                    <h1 style="color: #4E4E4E; font-size: 19px; font-weight: bold; margin-top: 0; text-align: center;">
                        Доктор <span style="color:#02A0F2;">Комаровская Марина Александровна</span> <br>ответила на Ваш вопрос:
                    </h1>
                    <p style="color: #4E4E4E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: justify;">
                        Здравствуйте, в первом триместре беременности рвота может быть следствием токсикоза, и результатом обострения хронических заболеваний желудочно-кишечного тракта. Причиной диареи может быть погрешность в питании, острые кишечные заболевания и обострение хронических заболеваний ЖКТ.При стойкой сохранении диареи нужно обязательно обратиться к врачу.
                    </p>
                </div>
            </tr>
            <tr>
                <div style="background-color: #ffffff; width: 100%; text-align: center;">
                    <a href="#" target="_blank" style="background-color:#02A0F2; color: #ffffff; padding: 15px;border-radius: 25px;font-weight: bold; text-decoration: none;">Записаться на приём</a>
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