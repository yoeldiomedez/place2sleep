<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <title>{{ config('app.name', 'Laravel') }} | @yield('pagetitle')</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Metronic Admin Template" name="description" />
        <meta content="Yoel Diomedez" name="author" />
        @section('styles')
        <!-- BEGIN GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
        <!-- END GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        @show
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="text-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/place2sleep-logo.png') }}" alt="" /> 
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top: 0px;">

            @yield('content')
            
        </div>
        <div class="copyright font-white"> 
            © {{ date('Y') }} Yoel Diomedez Apps
        </div>
        <!--[if lt IE 9]>
        <script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
        <script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script> 
        <![endif]-->
        <!-- BEGIN CORE THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/auth.js') }}"></script>
        <script>
            $(document).ready( function () {
                $.backstretch(
                    [
                        "{{ asset('img/background/1.jpg') }}", 
                        "{{ asset('img/background/2.jpg') }}", 
                        "{{ asset('img/background/3.jpg') }}", 
                        "{{ asset('img/background/4.jpg') }}"
                    ],
                    {
                        fade: 1e3,
                        duration: 8e3
                    }
                )
            })
        </script>
        <!-- END CORE THEME GLOBAL SCRIPTS -->
        @stack('scripts')
    </body>
</html>