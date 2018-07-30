<button class="thumb-control__item" data-type="1">
    <span class="thumb-control__val">{{$doctor->like ? $doctor->like : 0}}</span>
    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
</button>
<button class="thumb-control__item down" data-type="2">
    <span class="thumb-control__val">{{$doctor->dislike ? $doctor->dislike : 0}}</span>
    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
</button>