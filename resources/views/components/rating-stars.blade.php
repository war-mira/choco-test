<span class="stars">
    @php
        $starItemsClasses = [];
        for($i=0;$i<5;$i+=1)
          {
              if($rating-$i>= 1)
                  $starItemsClasses[] ='';
              elseif($rating-$i >= 0.5)
                  $starItemsClasses[] ='stars__item--half';
              else
                  $starItemsClasses[] ='stars__item--empty';
          }
    @endphp
    @foreach($starItemsClasses as $starItemClass)
        <span class="stars__item {{$starItemClass}}"></span>
    @endforeach
</span>