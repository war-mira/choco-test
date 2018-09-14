@php
    $banner = App\Banner::atPosition($position,false)->first();
@endphp
<div class="entity-content__banner">
    <a href="{{ $banner->href }}" target="_blank">
        <img src="{{asset($banner->image_file_desktop)}}" alt="">
    </a>
</div>