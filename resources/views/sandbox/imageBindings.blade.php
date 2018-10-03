<form method="post" action="{{route('sandbox.removeImages')}}">
    {{csrf_field()}}
    <table cellspacing="2" border="1" cellpadding="5" width="600">
        <tr>
            <th>

            </th>
            <th>
                Файл
            </th>
            <th>
                Размер
            </th>
            <th>
                В doctors
            </th>
            <th>
                В medcenters
            </th>
            <th>
                В tbl_images
            </th>
            <th>
                В banners
            </th>
        </tr>

        @foreach($bindings as $binding)
            <tr>

                <td><input type="checkbox" id="files-{{$loop->index}}" name="imgFiles[]" value="{{$binding['file']}}">
                </td>
                <td><label for="files-{{$loop->index}}">{{$binding['file']}}</label></td>
                <td><label for="files-{{$loop->index}}">{{$binding['size']}}</label></td>
                <td><label for="files-{{$loop->index}}">{{$binding['doctors']}}</label></td>
                <td><label for="files-{{$loop->index}}">{{$binding['medcenters']}}</label></td>
                <td><label for="files-{{$loop->index}}">{{$binding['images']}}</label></td>
                <td><label for="files-{{$loop->index}}">{{$binding['banners']}}</label></td>
            </tr>
        @endforeach
    </table>
    <input type="submit" name="delete" value="Удалить с сервера">
</form>