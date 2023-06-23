@extends('layouts.app')

@php
    $title = 'Verify';
    $id_page = 'auth';
@endphp

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="height: 100vh">
        <div class="col-xl-7 my-xl-5 my-0 d-flex flex-column align-items-center" style="border-radius: 15px; background: #fff">
            <div class="my-3">
                <h4 class="text-center" style="font-weight: bold">Verify Your Account</h4>  
                <img src="{{ asset('img/verify_ils.jpg') }}" width="350" alt="">
            </div>
            <p class="text-muted text-center mx-xl-5 mx-2">
                We have sent an account verification link to the email  you registered with. If the link is not in the inbox, please look at the spam page.
            </p>
        
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button type="submit" class="btn text-light px-4" style="height: 50px; background: #3D4141;">
                    <strong>Resend Verification Link</strong>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
