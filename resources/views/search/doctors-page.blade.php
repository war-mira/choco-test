@foreach($doctors as $doctor)
    <div class="results d-result" data-type="doctor" data-id="{{$doctor->id}}" id="doctor-result-{{$doctor->id}}"
         style="float: right">
        <div class="list-group-item{{(isset($doctor['is_top_doc']) && $doctor['is_top_doc']) ? " pretty_profile" : "" }}">
            @component('model.doctor.profile-short',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null])
            @endcomponent
        </div>
    </div>
@endforeach
