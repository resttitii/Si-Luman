@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 70vh;">
            <div class="col-md-6 card" style="background: #D9D9D9; border-radius: 0;  border: none;">
                <div class="card-body">
                    <div class="col-12">
                        <a href="{{ url('/detail_toko/'.$user->user_id) }}" class="text-dark text-decoration-none">
                            <i data-feather="arrow-left"></i>
                        </a>
                    </div>

                    <div class="d-flex flex-column my-5 align-items-center justify-content-center">
                        <p class="my-4">
                            Silahkan tanyakan kepada pihak toko terkait!
                        </p>

                        <a target="_blank" href="{{ 'https://wa.me/+6282136616987'.$user->no_hp.'?text=Halo%20toko%20'.$user->username }}" class="btn mt-4 text-light" style="background: #88C097">
                            <i data-feather="phone"></i>
                            <span class="ms-2">Toko {{ $user->username }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection