<div class="result-control-bar">
    <div class="container">
        <div class="result-control-bar__line">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-name">@if(!empty($meta['h1_title'])) {{$meta['h1_title']}} @endif</div>
                <div class="result-control-bar__query-count">найдено {{$service_count??0}} услуги</div>
            </div>
        </div>
    </div>
</div>