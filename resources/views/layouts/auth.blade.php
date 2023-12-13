<!DOCTYPE html>
<html>
<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('backend/img/logo.png') }}" rel="icon">
    <title>{{ isset($title) ? $title .' | '. get_option('site_title') :  get_option('site_title') }}</title>
    <meta name="description" content="{{ isset($title) ? $title .' | '. get_option('site_title') :  get_option('site_title') }}">
    <meta name="author" content="Sadik Khan">

    <link rel='stylesheet' href='{{ asset('backend/css/css?family=Poppins:100,200,300,400,500,600,700,800,900') }}' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/stylesheet.css') }}">
</head>
<body>

    <div id="main-wrapper" class="oxyy-login-register">
        <div class="container-fluid px-0">
            <div style="position: absolute;top: 55%;left: 48%;z-index:100; display: none;" id="loader">
                <img src="{{asset('img/loading.gif')}}" alt="">
            </div>

            @section('auth')
            @show
        </div>
    </div>

    <script src="{{ asset('backend/js/jquery.min.js') }}"></script> 
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script> 
    <script src="{{ asset('backend/js/theme.js') }}"></script>
    <script src="{{ asset('backend/js/page.js') }}"></script>
    <script src="{{ asset('backend/js/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
  </body>
</html>