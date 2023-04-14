@extends('layouts.app')

@section('pagetitle', 'Verification')
@section('pagesubtitle', 'Verify Your Email Address')

@section('content')

@if (session('resent'))
<div class="alert alert-info text-center" role="alert">
    <button class="close" data-close="alert"></button>
    {{ __('A fresh verification link has been sent to your email address.') }}
</div>
@endif  
<div class="note note-info">
    <p>
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}:
    </p>
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link">
            <i class="fa fa-send"></i> {{ __('Click here to request another') }}
        </button>
    </form>
</div>
@endsection