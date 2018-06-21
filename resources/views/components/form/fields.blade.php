@foreach($template as $row)
    <div class="row">
        @if(is_array($row))
            @foreach($row as $column)

                @if(is_array($column) && count($column) > 0)
                    <div class="{{$column[3] ?? $column[2]}}">
                        @if($column[0] == 'column')
                            @component('components.form.fields',['template'=>$column[1],'seed'=>$seed])
                            @endcomponent
                        @else
                            @component("components.form.".$column[0],$data = array_merge(
                            [
                                'field'=>$column[1],
                                'value'=> ($seed[$column[1]] ?? $column[4] ?? null),
                                'label'=>'keeek'
                            ],$column[2]))
                            @endcomponent
                        @endif

                    </div>
                @endif
            @endforeach
        @else
            <div class="{{$row[3]}}">
                @include("components.form.".$row[0],array_merge(['field'=>$row[1]],$row[2]))
            </div>
        @endif
    </div>
@endforeach