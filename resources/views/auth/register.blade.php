@extends('layouts.app')

@php
    $title = 'Register';
    $id_page = 'auth';
@endphp

@section('content')

    <div class="container-fluid">
        <div class="row mx-1 justify-content-center align-items-start">
            <form class="col-xl-6 p-4 mb-5 rounded position-relative" style="background: #fff; top: 40px" action="{{ route('register') }}" method="POST">
            @csrf
                <div>
                    <h5 class="text-center">
                        <strong>Buat Akun</strong>
                    </h5>

                    <div class="mt-3">
                        <label for="name" style="font-size: 14px;">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama lengkap anda" class="form-control @error('name') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('name')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="username" style="font-size: 14px">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username anda" class="form-control @error('username') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('username')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="alamat" style="font-size: 14px">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat anda" style="border-radius:3px; font-size: 14px;" rows="4"></textarea>
                        @error('alamat')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="email" style="font-size: 14px;">Email</label>
                        <input type="text" name="email" id="email" placeholder="Masukkan email anda" class="form-control @error('email') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('email')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="no_hp" style="font-size: 14px">Nomor HP</label>
                        <input type="number" min="0" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP anda" class="form-control @error('no_hp') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('no_hp')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="password" style="font-size: 14px">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password anda" class="form-control @error('password') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('password')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="password-confirm" style="font-size: 14px">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="Konfirmasi password anda" class="form-control @error('password_confirmation') is-invalid @enderror" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('password_confirmation')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <button class="btn py-2 px-4 mt-5" style="width: 100%; background: #b1c39f">
                        <strong>Daftar Akun</strong>
                    </button>
                    <p class="text-center mb-0 mt-2" style="font-size: 13px">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini!</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection
