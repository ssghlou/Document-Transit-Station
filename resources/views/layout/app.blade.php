<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>@yield('title','文件中转站')</title>
    <!-- 这里插入css -->
</head>
<body>
    @include('layout.header')
    <div>
        @yield('content')
    </div>

    <!-- 这里插入js -->
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
</body>
</html>