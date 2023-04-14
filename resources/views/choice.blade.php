@extends('layouts.auth')

@section('pagetitle', 'Choices')

@section('content')
<!-- BEGIN WELCOME -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light about-text" style="margin-bottom: 0px;padding-bottom: 0px;">
            <h3>
                <i class="fa fa-info"></i> Bienvenido
            </h3>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="list-unstyled margin-top-10 margin-bottom-10 text-center">
                        <li>
                            <i class="fa fa-user"></i> {{ Auth::user()->name }}
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i> {{ Auth::user()->email }}
                        </li>
                    </ul>
                </div>
            </div>
            <h3>
                <i class="fa fa-sitemap"></i> Cementerios
            </h3>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Cementerio</th>
                                <th class="text-center">Acceder</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (auth()->user()->cemeteries as $cemetery)
                                <tr>
                                    <td>{{ $cemetery->appellation }}</td>
                                    <td class="text-center">
                                        <a 
                                            href="{{ route('select', $cemetery->id) }}"
                                            type="button" 
                                            class="btn dark btn-outline">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>    
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Solicite la asignación de uno o más Cementerio(s)</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <a  type="button" 
            class="btn btn-primary uppercase btn-block" 
            href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="icon-logout"></i> Salir 
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
<!-- END WELCOME -->
@endsection
