<div class="result-control-bar">
    {{ Breadcrumbs::render($breadcrumb_route, $params)
         }}

    @if($service_count)
    <div class="container">
        <div class="result-control-bar__line">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-name">@if(!empty($meta['h1_title'])) {{$meta['h1_title']}} @endif</div>
                <div class="result-control-bar__query-count">Найдено {{$service_count??0}} услуги</div>
            </div>
        </div>
    </div>
        @endif
</div>