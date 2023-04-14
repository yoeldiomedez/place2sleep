@extends('layouts.app')

@section('pagetitle', 'Dashboard')
@section('pagesubtitle', auth()->user()->cemetery_appellation)

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('home') }}">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Inicio</span>
        </li>
    </ul>
</div>

@if (session('status'))
    <div class="alert alert-info text-center" role="alert">
        <button class="close" data-close="alert"></button>
        <span role="alert">
            <strong>{{ session('status') }}</strong>
        </span>
    </div>
@endif

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green-meadow" 
            href="javascript:;" >
            <div class="visual">
                <i class="fa fa-road"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>∑ </span><span class="counter">{{ $pavilions }}</span>
                </div>
                <div class="desc">Pabellones</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" 
            href="javascript:;">
            <div class="visual">
                <i class="fa fa-building-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span><span class="counter">{{ $niches }}</span>
                </div>
                <div class="desc">Inhumados en Nichos</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow-crusta" 
            href="javascript:;">
            <div class="visual">
                <i class="fa fa-bank"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span>
                    <span class="counter">{{ $mausoleums }}</span>
                </div>
                <div class="desc">Inhumados en Mausoleos</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" 
            href="javascript:;">
            <div class="visual">
                <i class="fa fa-inbox"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>∑ </span>
                    <span class="counter">{{ $exhumations }}</span>
                </div>
                <div class="desc">Exhumados</div>
            </div>
        </a>
    </div>
</div>

@endsection

@push('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        jQuery(document).ready( function( $ ) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            })
        })
    </script>
@endpush