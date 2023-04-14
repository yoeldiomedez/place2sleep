@extends('layouts.auth')

@section('pagetitle', 'Password Forgotten')

@section('content')
<!-- BEGIN FORGOT PASSWORD FORM -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    
    <h3 class="form-title font-dark">{{ __('¿Olvidaste tu contraseña?') }}</h3>

    @if (session('status'))
        <div class="alert alert-info text-center" role="alert">
            <button class="close" data-close="alert"></button>
            <span role="alert">
                <strong>{{ session('status') }}</strong>
            </span>
        </div>
    @endif

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">{{ __('E-Mail') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>
        @if ($errors->has('email'))
            <span class="help-block text-center bold"> {{ $errors->first('email') }} </span>
        @endif
    </div>

    <div class="form-actions">  
        <button type="submit" id="recovery-btn" class="btn blue uppercase btn-block" data-loading-text="Recuperando <i class='fa fa-circle-o-notch fa-spin'></i>">
            Recuperar <i class="icon-key"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#recovery-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 2e3)
    })
})
</script>
@endpush