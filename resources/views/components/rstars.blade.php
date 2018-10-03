<div class="rating-line__stars">
    @php
        $starItemsClasses = [];
        for($i=0;$i<5;$i+=1)
          {
              if($rating-$i>= 1)
                  $starItemsClasses[] ='fa-star';
              elseif($rating-$i >= 0.5)
                  $starItemsClasses[] ='fa-star-half-o';
              else
                  $starItemsClasses[] ='fa-star-o';
          }
    @endphp
    @foreach($starItemsClasses as $starItemClass)
        <i class="fa {{$starItemClass}}" aria-hidden="true"></i>
    @endforeach
</div>