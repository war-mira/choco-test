@component('vendor.mail.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('vendor.mail.html.header', ['url' => config('app.url')])

        @endcomponent
    @endslot
    {{-- Body --}}
    <table style="width:100%; background-color: #ffffff;">

        <tr>
            <div style="background-color:#ffffff; padding: 15px 0;">
                <p style="color: #4E4E4E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: justify;">
                    Письмо от: {{$email}}<br>
                    URL: {{$current_url}}<br>
                    ТЕКСТ ОШИБКИ: {{$text}}<br>
                </p>
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