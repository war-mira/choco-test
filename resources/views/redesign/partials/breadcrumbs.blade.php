@if (count($breadcrumbs))
<div class="container">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $key => $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    @if($key != count($breadcrumbs) - 1) <span class="separator">/</span> @endif
                </li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
</div>
@endif