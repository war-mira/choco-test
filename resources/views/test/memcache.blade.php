<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<input type="text" id="memcache">
<script>
    var t = 0;
    var next;
    var wait = null;
    $('#memcache').on('keyup', function () {
        var value = $(this).val();
        if (wait)
            clearTimeout(wait);
        (function (value) {
            wait = setTimeout(function () {

                next = function (callback) {
                    var data = {
                        _token: '{{csrf_token()}}',
                        value: value
                    };
                    $.post('{{url('sandbox/memcache')}}', data, callback);
                }
            }, 50);
        })(value);
    });
    (function pullUpdates() {
        if (next) {
            var func = next;
            next = null;
            func(pullUpdates);

        }
        else {
            $.ajax({
                url: '{{url('sandbox/memcache')}}',
                method: 'GET',
                data: {t: t},
                statusCode: {
                    200: function (data) {
                        t = data.t;
                        $('#memcache').val(data.value);
                        setTimeout(pullUpdates, 50);
                    },
                    304: function () {
                        setTimeout(pullUpdates, 50);
                    }
                }
            });
        }

    })();
</script>
</body>
</html>