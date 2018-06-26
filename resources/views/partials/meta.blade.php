<!--Static metadata /-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

@if(!empty($meta['robots']))
    <!--Robots metadata /-->
    <meta name="robots" content="{{ $meta['robots']}}" />
@endif

<!--Common metadata /-->
@if(!empty($meta['title']))
    <title>{{ $meta['title']}}</title>
@else
    <title>iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием</title>
@endif

@if(!empty($meta['keywords']))
    <meta name="keywords" content="{{$meta['keywords']}}"/>
@else
    <meta name="keywords"
          content="поиск врача Алматы, врач, врачи Алматы, найти врача, поиск врачей, терапевт Алматы, врач по всем болезням, вызвать врача, домашний врач, зубной врач, частнопрактикующий врач, записаться на прием к врачу, врач высшей категории, главный врач, глазной врач, дежурный врач, детский врач, лечащий врач, участковый врач, восстановление здоровья, психическое здоровье, слабое здоровье, низкокалорийная диета, акушер-гинеколог, аллерголог, андролог, анестезиолог, венеролог, гастроэнтеролог, гематолог, гепатолог, гинеколог, гомеопат, дерматолог, диетолог, иммунолог, инфекционист, кардиолог, косметолог, логопед, лор, оториноларинголог, маммолог, мануальный, терапевт, массажист,нарколог, невролог, нефролог, окулист, офтальмолог,онколог, ортопед, педиатр, пластический, хирург, проктолог,психиатр,психолог,психотерапевт,пульмонолог, ревматолог, репродуктолог, эко, сексолог, стоматолог,терапевт, трихолог, узи-специалист, уролог, флеболог, хирург, эндокринолог."/>
@endif

@if(!empty($meta['description']))
    <meta name="description" content="{{$meta['description']}}"/>
@else
    <meta name="description"
          content="{{$meta['default_description']}}"/>
@endif

<!--Facebook Metadata /-->
@if(!empty($meta['image']))
    <meta property="og:image" content="{{ url($meta['image']) }}"/>
@else
    <meta property="og:image" content="{{asset('images/idoctor_newyear.jpg')}}"/>
@endif

@if(!empty($meta['description']))
    <meta property="og:description" content="{{ str_limit($meta['description'], $limit = 100, $end = '...') }}"/>
@else
    <meta property="og:description"
          content="iDoctor.kz - Сервис для поиска врача и бесплатной записи на прием. Мы собрали базу врачей в Алматы и Астане с рейтингами и отзывами наших клиентов."/>
@endif

@if(!empty($meta['title']))
    <meta property="og:title" content="{{ $meta['title'] }}"/>
@else
    <meta property="og:title" content="iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием"/>
@endif

<!--Google+ Metadata /-->
@if(!empty($meta['title']))
    <meta itemprop="name" content="{{ $meta['title'] }}">
@else
    <meta itemprop="name" content="iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием">
@endif
@if(!empty($meta['description']))
    <meta itemprop="description" content="{{ str_limit($meta['description'], $limit = 100, $end = '...') }}"/>
@else
    <meta itemprop="description"
          content="iDoctor.kz - Сервис для поиска врача и бесплатной записи на прием. Мы собрали базу врачей в Алматы и Астане с рейтингами и отзывами наших клиентов."/>
@endif
@if(!empty($meta['image']))
    <meta itemprop="image" content="{{ url($meta['image']) }}"/>
@else
    <meta itemprop="image" content="{{asset('images/idoctor_newyear.jpg')}}"/>
@endif

<!-- Twitter Metadata /-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:domain" content="idoctor.kz">

@if(!empty($meta['title']))
    <meta name="twitter:title" content="{{ $meta['title'] }}">
@else
    <meta name="twitter:title" content="iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием">
@endif

@if(!empty($meta['description']))
    <meta name="twitter:description" content="{{ str_limit($meta['description'], $limit = 100, $end = '...') }}"/>
@else
    <meta name="twitter:description"
          content="iDoctor.kz - Сервис для поиска врача и бесплатной записи на прием. Мы собрали базу врачей в Алматы и Астане с рейтингами и отзывами наших клиентов."/>
@endif

@if(!empty($meta['image']))
    <meta name="twitter:image" content="{{ url($meta['image']) }}"/>
@else
    <meta name="twitter:image" content="{{asset('images/idoctor_newyear.jpg')}}"/>
@endif