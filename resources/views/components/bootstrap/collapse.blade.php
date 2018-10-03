<div>
    <div class="collapse" id="{{$hiddenId}}" data-toggle="collapse">
        {{$hiddenContent}}
    </div>
    <button class="btn btn-default btn-block b show-{{$hiddenId}}" data-toggle="collapse"
            href="#{{$hiddenId}}"></button>
</div>
<style>
    .show-{{$hiddenId}}::before {
        content: '{{$openText}}'
    }

    .show-{{$hiddenId}}[aria-expanded='true']::before {
        content: '{{$hideText}}'
    }
</style>