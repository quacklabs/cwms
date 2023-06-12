<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>@yield('title')</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">


        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    
    </head>
    <body>
        <div id="app">
            @auth
                <!-- Content for authenticated users -->
            @endauth

            @yield('content')
        </div>
    </body>

    

    



</html>



