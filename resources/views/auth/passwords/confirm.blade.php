@extends('layouts.app')

@section('pagetitle', 'Confirmation')
@section('pagesubtitle', 'Confirm Password')

@section('content')
                 
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="note note-info">
                    <p>{{ __('Please confirm your password before continuing.') }}</p>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="POST" action="{{ route('password.confirm') }}" class="form-horizontal" role="form">
                    @csrf
                    <div class="form-body">
                        <div class="form-group @error('password') has-error @enderror">
                            <label class="col-md-3 control-label bold">{{ __('Password') }}</label>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="help-block"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" id="confirm-btn" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Confirming">
                                    {{ __('Confirm Password') }}
                                </button>
    
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#confirm-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 2e3)
    })
})
</script>
@endpush