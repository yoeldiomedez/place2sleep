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
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- BEGIN HEAD -->
    <head>
        <title>{{ config('app.name', 'Laravel') }} | @yield('pagetitle')</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Sistema para la Administración de Cementerios" name="description" />
        <meta content="Yoel Diomedez" name="author" />
        @section('styles')
        <!-- BEGIN GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet"/>
        <!-- END GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        @show
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-fixed">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/place2sleep-logo-2.png') }}" alt="logo" class="logo-default" style="margin: 15px 0 0;"/> 
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->

                @include('layouts.topbarmenu')

            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            @include('layouts.sidebarmenu')

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <h3 class="page-title"> @yield('pagetitle')
                        <small>@yield('pagesubtitle')</small>
                    </h3>
                    <!-- END PAGE HEADER-->

                    @yield('content')

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 
                © {{ date('Y') }} {{ config('app.owner', 'Yoel Diomedez Apps') }}     
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN CORE THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/main.js') }}"></script>
        <!-- END CORE THEME GLOBAL SCRIPTS -->
        <script>
            function toastrMessage(type, message) {

                toastr.options = {
                    closeButton: true,
                    newestOnTop: true,
                    positionClass: 'toast-top-center'
                }

                switch (type) {
                    case 'info':
                        toastr.info(message)
                        break;
                    case 'success':
                        toastr.success(message)
                        break;
                    case 'warning':
                        toastr.warning(message)
                        break;
                    case 'error':
                        toastr.error(message)
                        break;
                    default:
                        console.log('Unknown toastr option')
                        break;
                }
            }

            function loading(button, option){
                if (option == 'start')
                    $(button).button('loading')
                else if (option == 'stop')
                    $(button).button('reset')
            }
        </script>
        @stack('scripts')
    </body>
</html>