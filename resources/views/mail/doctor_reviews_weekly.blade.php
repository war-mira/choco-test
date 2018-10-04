@component('vendor.mail.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('vendor.mail.html.header', ['url' => config('app.url')])
            
        @endcomponent
    @endslot
        {{-- Body --}}
        <table>
            <tr>
                <div style="background-color: #ffffff;padding: 15px;">
                    <div style="text-align: center;width: 100%;">
                        <h1 style="font-size: 24px; color: #02A0F2; font-weight: bold;text-align: center;">Уважаемый(ая) {{ $name }}!</h1>
                    </div>
                </div>
            </tr>
            <tr>
                <div style="background-color:#ffffff; padding: 15px;">
                    <p style="color: #4E4E4E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: justify;">
                       На нашем сайте iDoctor.kz за эту неделю Вам было оставлено <strong>{{ $count }}</strong> отзывов. Ознакомиться с ними Вы можете в Вашем
                        <a href="{{ route('cabinet.doctor.feedback.index') }}">личном кабинете</a>.
                    </p>
                </div>
            </tr>
            <tr>
                <div style="padding: 15px;">
                    <p style="color: #02A0F2; font-size: 16px; line-height: 0.5em; margin-top: 0; text-align: justify;">Благодарим Вас за Ваш труд.</p>
                    <p style="color: #02A0F2; font-size: 16px; line-height: 0.5em; margin-top: 0; text-align: justify;">С Уважением,</p>
                    <b style="color: #02A0F2; font-size: 16px; line-height: 0.5em; margin-top: 0; text-align: justify;">команда iDoctor.</b>
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