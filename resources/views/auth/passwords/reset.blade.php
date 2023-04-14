@extends('layouts.auth')

@section('pagetitle', 'Password Reset')

@section('content')
<!-- BEGIN RESET PASSWORD FORM -->
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <h3 class="form-title font-dark">{{ __('Restablecer Contraseña') }}</h3>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">{{ __('E-Mail') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="E-Mail" required>
        @if ($errors->has('email'))
            <span class="help-block text-center bold"> {{ $errors->first('email') }} </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">{{ __('Nueva Contraseña') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Nueva Contraseña" required>
        @if ($errors->has('password'))
            <span class="help-block text-center bold"> {{ $errors->first('password') }} </span>
        @endif
    </div>

    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{ __('Confirmar Contraseña') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
    </div>

    <div class="form-actions">
        <button type="submit" id="reset-btn" class="btn blue uppercase btn-block" data-loading-text="Restableciendo <i class='fa fa-circle-o-notch fa-spin'></i>">
            {{ __('Restablecer') }} <i class="icon-lock"></i>
        </button>
    </div>
</form>
<!-- END RESET PASSWORD FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#reset-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 4e3)
    })
})
</script>
@endpush