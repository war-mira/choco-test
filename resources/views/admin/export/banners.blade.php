<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Позиция</th>
        <th>Изображение</th>
        <th>Ссылка</th>
        <th>Всего переходов</th>
        <th>Уникальных переходов</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <td>{{$banner['id']}}</td>
            <td>{{\App\Banner::POSITION[$banner['position']]}}</td>
            <td>{{asset($banner['image_file_desktop'])}}</td>
            <td>{{$banner['href']}}</td>
            <td>{{$banner['clicks_count']}}</td>
            <td>{{$banner['unique_clicks_count']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>