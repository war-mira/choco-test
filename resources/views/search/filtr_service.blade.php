<div class="result-control-bar">
    {{ Breadcrumbs::render($breadcrumb_route, $params)
         }}


    <div class="container">
        <div class="result-control-bar__line">
            <div class="result-control-bar__query">
                <h1 class="result-control-bar__query-name text-center">@if(!empty($meta['h1'])) {{$meta['h1']}} @endif</h1>
                @if($service_count)
                <div class="result-control-bar__query-count">Найдено {{$service_count??0}} услуги</div>
                @endif
            </div>
        </div>
    </div>

</div>