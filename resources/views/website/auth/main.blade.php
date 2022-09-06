<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{asset('website/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
        <!-- font awesome  -->
        <link rel="stylesheet" href="{{asset('website/css/fontawesome.css')}}">
        <!-- style -->
        <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
        <!-- icon -->
        <link rel="icon" href="{{asset('website/img/Homzdepot-Logo.png')}}">
        <!-- cairo font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <!-- title -->
        <title>@yield('title')</title>
    </head>
<body>
    @yield('content')
                 
    <!-- bootsrap js -->
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/all.min.js')}}"></script>
    <!-- jquery -->
    <script src="{{asset('website/js/jquery-3.3.1.min.js')}}"></script>
    <!-- script -->
    <script src="{{asset('website/js/script.js')}}"></script>
 
</body>
</html>