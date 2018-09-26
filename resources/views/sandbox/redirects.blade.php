<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="main-wrap" id="app">

    <div class="container">

    </div>
</div>

<script src="{{URL::asset("js/app.js")}}"></script>
</body>
</html>
