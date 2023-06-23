@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center align-items-start mx-2">
            <form class="col-xl-5 p-4 mb-3 rounded" style="background: #fff; position: relative; top: 30px" action="{{ url('/update_profile/'.$user->user_id) }}" method="POST">
            @csrf
                <div> 
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url('/profile') }}" class="text-dark">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>
                        <h5 class="text-center">
                            <strong>Edit Profile</strong>
                        </h5>
                        <div></div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="name" style="font-size: 14px;">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" value="{{ $user->name }}" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('name')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="username" style="font-size: 14px;">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" class="form-control" value="{{ $user->username }}" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                        @error('username')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="alamat" style="font-size: 14px">Alamat</label>
                        <textarea class="form-control" placeholder="Masukkan nama alamat" name="alamat" id="alamat" style="border-radius:3px; font-size: 14px;" rows="4">{{ $user->alamat }}</textarea>
                        @error('alamat')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="no_hp" style="font-size: 14px">Nomor HP</label>
                        <input type="number" placeholder="Masukkan nomor HP" min="0" name="no_hp" id="no_hp" class="form-control" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;" value="{{ $user->no_hp }}">
                        @error('no_hp')
                        <span class="text-danger" style="font-size: 13px">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                
                    <button class="btn btn-primary mt-4 px-3" style="font-size: 14px; height: 40px">
                        <strong>Update Profile</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
