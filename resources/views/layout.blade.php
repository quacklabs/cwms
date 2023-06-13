<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>@yield('title')</title>

        <!-- General CSS Files -->       
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">

        @yield('css')
    
    </head>
    <body>
        <div id="app">
            @auth
            <div class="main-wrapper main-wrapper-1">
                <!-- Content for authenticated users -->
                @include('partials.header')
                @include('partials.sidebar')
            @else
            <div class="">
            @endauth

                @yield('content')

                <footer class="main-footer">
                    <div class="footer-left">
                    Copyright &copy; {{ date('Y') }}
                    </div>
                    <div class="footer-right">
                    All Rights Reserved
                    </div>
                </footer>


            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/tooltip.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/stisla.js') }}"></script>
        
        @yield('js')

        <!-- Template JS File -->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>



