@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center align-items-start mx-2">
            <div class="col-xl-5 p-4 mb-4 rounded" style="background: #fff; top: 40px; position: relative">
                <div>
                    <div class="d-flex @if(auth()->user()->role != 'admin') justify-content-between @else justify-content-center @endif">
                        <div></div>
                        <h5 class="text-center">
                            <strong>Profile</strong>
                        </h5>
                        @if (auth()->user()->role != 'admin')
                        
                        <div>
                            <a href="{{ url('/edit_profile/'.auth()->user()->user_id) }}" class="text-dark">
                                <i data-feather="edit"></i>
                            </a>
                        </div>
                            
                        @endif
                    </div>

                    <div class="mt-3">
                        <label for="name" style="font-size: 14px;">Nama</label>
                        <input disabled class="form-control" value="{{ auth()->user()->name }}" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                    </div>

                    <div class="mt-3">
                        <label for="name" style="font-size: 14px;">Username</label>
                        <input disabled class="form-control" value="{{ auth()->user()->username }}" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                    </div>

                    <div class="mt-3">
                        <label for="alamat" style="font-size: 14px">Alamat</label>
                        <textarea disabled class="form-control" style="border-radius:3px; font-size: 14px;" rows="4">{{ auth()->user()->alamat }}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="email" style="font-size: 14px;">Email</label>
                        <input disabled value="{{ auth()->user()->email }}" class="form-control" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;">
                    </div>

                    <div class="mt-3">
                        <label for="no_hp" style="font-size: 14px">Nomor HP</label>
                        <input disabled class="form-control" style="border-radius: 3px; font-size: 14px; border: 1px solid #ddd;" value="{{ auth()->user()->no_hp }}">
                    </div>
             </div>
            </div>
        </div>
    </div>

@endsection
