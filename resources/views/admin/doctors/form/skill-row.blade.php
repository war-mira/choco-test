<tr data-id="{{$id}}">
    <td>
        @component('components.form.number')
            @slot('field','skills['.$id.'][weight]')
            @slot('value',$skill['pivot']['weight'] ?? 0))
        @endcomponent
    </td>
    <td>
        @component('components.form.select2.single')
            @slot('id','skills-'.$id.'')
            @slot('field','skills['.$id.'][id]')
            @slot('value',$skill['id'] ?? 6)
            @slot('placeholder','Специализация')
            @slot('options',\App\Skill::orderBy('name')->get())
            @slot('search',true)
            @slot('idField','id')
            @slot('nameField','name')
        @endcomponent
    </td>
    <td style="vertical-align:middle;text-align: center;">
        <a href="#" class="delete-row" data-id="{{$id}}">Удалить</a>
    </td>
</tr>