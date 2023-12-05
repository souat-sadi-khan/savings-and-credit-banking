<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Savings & Credit Co-Operative Management Software</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset(get_option('favicon')?'storage/logo/'.get_option('favicon'):'favicon.png')}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
           
            
            a.login-button {
    border: 0px;
    color: #fff;
    padding: 14px 36px !important;
    border-radius: 4px;
    background-color: #23D9B7;
}

.title.m-b-md {
    color: #23D9B7;
    font-weight: 500;
}

.copy-right-text {
    text-align: center;
    color: #23D9B7;
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="login-button" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @if(get_option('logo') != '') 
                        <img src="{{asset('storage/logo')}}/{{get_option('logo')}}" alt="">
                    @else 
                        <img src="{{asset('logo.png')}}" alt="Company Logo">
                    @endif
                    <br>
                    Savings & Credit Co-Operative Management Software
                </div>

                
            </div>
        </div>
        
        <div>
            <p class="copy-right-text"> &copy; 2019 All right reserved </p>
        </div>
    </body>
</html>
