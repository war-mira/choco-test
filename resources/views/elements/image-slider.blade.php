@php
 $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $element_id = substr(str_shuffle(str_repeat($pool, 5)), 0, 10);
@endphp
<ul id="{{$element_id}}" class="bxslider">
    @foreach($banners as $banner)
        <li style="width: 100%">
            <div class="hidden-md hidden-lg"><a href="{{$banner->link}}"
                                                @if($banner->href[0] != '#') target="_blank" @endif><img
                            src="/{{$banner->image_file_mobile}}" alt="" width="100%"/></a></div>
            <div class="hidden-xs hidden-sm"><a href="{{$banner->link}}"
                                                @if($banner->href[0] != '#') target="_blank" @endif><img
                            src="/{{$banner->image_file_desktop}}" alt="" width="100%"/></a></div>
        </li>
    @endforeach
</ul>
<script type="text/javascript">
    @if(count($banners)>1)
    $('#{{$element_id}}').bxSlider({
        controls:false,
        minSlides:2,
        auto:true,
        autoHover: true,
        pause: 7000
    });
    @endif
</script>