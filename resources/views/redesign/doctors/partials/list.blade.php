@foreach($doctors as $doctor)
    @component('redesign.doctors.partials.profile-card',compact('doctor'))
    @endcomponent
@endforeach