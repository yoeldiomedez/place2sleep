@extends('layouts.default')
@section('pagetitle', 'Consultas')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    Búsqueda de Inhumados
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">                    
                            <div class="alert alert-info text-justify">
                            <i class="fa fa-info-circle"></i> 
                            Para la búsqueda de un 
                            <b>inhumado</b> seleccione entre el tipo de sepultura 
                            <b>Nicho o Mausoleo</b>; luego podrá <b>Filtrar</b> por el
                            <b>Número de DNI</b> del <b>inhumado</b>.
                        </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('search/niche') }}"><i class="fa fa-th"></i> Nicho</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('search/mausoleum') }}"><i class="fa fa-bank"></i> Mausoleo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection