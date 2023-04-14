@section('styles')
    @parent
    <style type="text/css">
        @media (min-width: 358px) {
            .visible-ss {
                display: block !important;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .hidden-md {
                display: none !important;
            }
        }
        
        @media (min-width: 1200px) {
            .hidden-lg {
                display: none !important;
            }
        }
    </style>
@endsection
@extends('layouts.auth')

@section('pagetitle', 'Login')

@section('content')
<!-- BEGIN LOGIN FORM -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <h3 class="form-title font-dark">Iniciar Sesión</h3>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">{{ __('E-mail') }}</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block text-center bold"> {{ $errors->first('email') }} </span>
        @endif    
    </div>
    
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
    </div>

    <div class="form-actions text-center">

        <button type="submit" id="login-btn" class="btn blue uppercase btn-block" data-loading-text="Ingresando <i class='fa fa-circle-o-notch fa-spin'></i>">
            Ingresar <i class="icon-login"></i>
        </button>
        <br>

        <label class="rememberme check mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordar Sesión') }}
            <span></span>
        </label>

        <br class="visible-ss hidden-md hidden-lg">

        <a href="{{ route('password.request') }}" id="forget-password">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
    
    <div class="create-account bg-dark">
        @if (Route::has('register'))
        <p>
            <a href="{{ route('register') }}" class="uppercase bg-font-dark">
                Crea una cuenta
            </a>
        </p>
        @endif
    </div>

</form>
<!-- END LOGIN FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#login-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 3e3)
    })
})
</script>
@endpush