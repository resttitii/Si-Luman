@extends('layouts.app')

@php
    $title = 'Reset Password';
    $id_page = 'auth';
@endphp

@section('content')

    <div class="container-fluid">
        <div class="row mx-2 justify-content-center align-items-start">
            <form class="col-xl-4 p-4 mb-5 position-relative rounded" style="top: 50px; background: #fff" action="{{ route('password.update') }}" method="POST">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <h5 class="text-center">
                        <strong>Reset Password</strong>
                    </h5>

                    <div class="mt-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ $email ?? old('email') }}" readonly placeholder="John Doe" class="form-control @error('email') is-invalid @enderror" style="font-size: 14px; height: 55px; border: 1px solid #ddd;">
                        @error('email')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" class="form-control @error('password') is-invalid @enderror" style="font-size: 14px; height: 55px; border: 1px solid #ddd;">
                        @error('password')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                 
                    <div class="mt-3">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="Konfirmasi password" class="form-control @error('password_confirmation') is-invalid @enderror" style="font-size: 14px; height: 55px; border: 1px solid #ddd;">
                        @error('password_confirmation')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <button class="btn py-2 px-4 mt-3 text-light btn-dark" style="width: 100%;" type="submit">
                        <strong>Reset Password</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
