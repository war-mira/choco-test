@foreach($docs_more as $doctor)
    <div class="doc-list__item entity-line doc-line">
        @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>250,'height'=>250])
        @endcomponent
    </div>
@endforeach