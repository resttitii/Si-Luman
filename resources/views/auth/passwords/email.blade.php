@extends('layouts.app')

@php
    $title = 'Email Confirm';
    $id_page = 'auth';
@endphp

@section('content')

    <div class="container-fluid">
        <div class="row mx-2 justify-content-center align-items-start">
            <form class="col-xl-4 p-4 mb-5 position-relative rounded" style="top: 50px; background: #fff" action="{{ route('password.email') }}" method="POST">
            @csrf
                <div>
                    <h5 class="text-start">
                        <strong>Lupa Password</strong>
                    </h5>

                    <p style="font-size: 13px" class="text-secondary">
                        Masukkan email yang terdaftar, lalu masuk ke kotak masuk/spam email untuk mendapatkan link reset password
                    </p>

                    <div class="mt-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror" style="font-size: 14px; height: 55px; border: 1px solid #ddd;">
                        @error('email')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn-dark py-2 px-4 mt-3 text-light" style="width: 100%;">
                        <strong>Selanjutnya</strong>
                    </button>
                    <p class="text-center">
                        <a href="{{ route('login') }}" class="text-center text-secondary" style="text-decoration: underline">
                            Kembali
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

@endsection
