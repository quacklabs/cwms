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
        <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">

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
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/tooltip.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/stisla.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/iziToast.min.js') }}"></script>

        @if(session('success'))
        <script>
            $(function() {
                swal({
                title: 'Successful',
                text: "{{ session('success') }}",
                icon: 'success'
                })
            })
        </script>
        @endif

        @if(session('error'))
        <script>
            $(function() {
                swal({
                title: 'Successful',
                text: "{{ session('error') }}",
                icon: 'warning'
                })
            })
        </script>
@endif
        
        @yield('js')
        <!--  -->

        <!-- Template JS File -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js"></script> -->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <!-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
        <script type="module">

        // import Echo from "{{ asset('js/echo.js') }}"

        import {Pusher} from "{{ asset('js/pusher.js') }}"

        // window.Pusher = Pusher

        var pusher = new Pusher('7faeac53b6a65e548387', {
            encrypted: true,
            cluster: 'eu'
        });

        var channel = pusher.subscribe('stock-create');
        
        channel.bind('StockCreationStarted', function(data) {
            alert(JSON.stringify(data));
        });
        // window.Echo = new Echo({
        //     broadcaster: 'pusher',
        //     key: "7faeac53b6a65e548387",
        //     wsHost: window.location.hostname,
        //     // wsPort: 6001,
        //     forceTLS: false,
        //     disableStats: true,
        // });

        // window.Echo.channel('your-channel')
        // .listen('your-event-class', (e) => {
        //         console.log(e)
        // })

        // console.log("websokets in use")

</script> 
        <!-- <script src="{{ asset('js/echo.js') }}"></script> -->
        <!-- <script src="{{ asset('js/pusher.js') }}"></script> -->
        <!-- <script>
            
        </script> -->
    </body>
</html>



