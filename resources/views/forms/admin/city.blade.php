@component('components.bootstrap.row')
    @component('components.bootstrap.column',['class'=>'col-md-2'])
        @component('components.form.text')
            @slot('field','id')
            @slot('value',$seed['id'] ?? null)
            @slot('placeholder','Новый')
            @slot('label','Id')
            @slot('readonly',true)
        @endcomponent
    @endcomponent
    @component('components.bootstrap.column',['class'=>'col-md-4'])
        @component('components.form.bootstrap-select.single')
            @slot('field','parent_id')
            @slot('value',$seed['parent_id'] ?? null)
            @slot('placeholder','Страна')
            @slot('label','Страна')
            @slot('options',\App\City::where('parent_id',null)->whereNotIn('id',[$seed['id']??null]))
            @slot('idField','id')
            @slot('nameField','name')
        @endcomponent
    @endcomponent
    @component('components.bootstrap.column',['class'=>'col-md-2'])
        @component('components.form.bootstrap-select.single')
            @slot('field','status')
            @slot('value',$seed['status'] ?? 0)
            @slot('options',[0=>'Нет',1=>'Да'])
            @slot('placeholder','Виден')
            @slot('label','Виден')
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-4'])
            @component('components.form.bootstrap-select.text')
                @slot('field','name')
                @slot('value',$seed['name'] ?? null)
                @slot('placeholder','Название')
                @slot('label','Название')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-4'])
            @component('components.form.text')
                @slot('field','alias')
                @slot('value',$seed['alias'] ?? null)
                @slot('label','Ссылка')
            @endcomponent
        @endcomponent
    @endcomponent