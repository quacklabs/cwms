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
        <!-- <script src=""></script> -->
        <script src="{{ asset('js/pusher.js') }}"></script>
        <!-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
        @auth
        <script>
            
            $(function() {
                
            });

            const izitoastOptions = {
                
            }

            if("serviceWorker" in navigator) {
                navigator.serviceWorker.register(href="{{ route('serviceWorker') }}", { scope: "./"})
                .then((registration) => {

                    if (registration.installing) {
                        console.log("Service worker installing");
                    } else if (registration.waiting || registration.active) {
                        
                        const current_user = "{{ auth()->user()->id }}"
                        const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
                            url: "{{ route('api.register-notifications', ['user_id' => auth()->user()->id]) }}",
                            headers: {
                                "Authorization": "Bearer {{ $api_token }}",
                                "X-XSRF-TOKEN": "{{ $x_token }}",
                                "Content-Type": "application/json"
                            }
                        })

                        const beamsClient = new PusherPushNotifications.Client({
                            instanceId: "{{ env('BEAM_INSTANCE_ID') }}",
                            serviceWorkerRegistration: registration
                        })

                        beamsClient.start().then((beamsClient) => {

                            beamsClient.getUserId().then((user_id) => {
                                if(user_id == null) {
                                    beamsClient.setUserId(current_user, beamsTokenProvider)
                                } else {
                                    if (current_user !== user_id) {
                                        return beamsClient.stop();
                                    }
                                }
                            })
                            .catch((error) => { 
                                console.log(error)
                            })
                        })
                        .catch((error) => { 
                            console.log(error)
                        })                        
                    }

                }).catch((error) => {
                    console.log("failed with error" + error)
                })

                navigator.serviceWorker.addEventListener("message", (event) => {
                    iziToast.show({
                        title: event.data.title,
                        backgroundColor: "bg-success",
                        // message: event.data.message,
                        displayMode: 'replace',
                        timeout: 60000,
                        icon: '<svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 512 512"><style>svg{fill:#000000}</style><path d="M448 160H320V128H448v32zM48 64C21.5 64 0 85.5 0 112v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zM448 352v32H192V352H448zM48 288c-26.5 0-48 21.5-48 48v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48H48z"/></svg>',
                        progressBar: true,
                    })
                });

                
            } else {
                console.log('cannot init service worker')
            }
        </script>
            
        @endauth
    </body>
</html>



