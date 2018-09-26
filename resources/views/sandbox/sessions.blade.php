<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Главная - iDoctor</title>
    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
</head>
<body>
<div class="main-wrap" id="app">

        <div class="container">
            <admin-sessions></admin-sessions>
        </div>
</div>

<script src="{{URL::asset("js/app.js")}}"></script>
</body>
</html>
