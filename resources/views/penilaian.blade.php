@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <a href="{{ route('produk') }}">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>

                        <div class="row mt-4">
                            @foreach ($ulasan as $item)
                            <div class="col-12 d-flex align-items-start">
                                <img src="{{ asset('img/icon/pelanggan_profil.png') }}" width="40" alt="">
                                
                                <div class="ms-2 col-12" style="font-size: 14px; width: 90%">
                                    <p class="mb-0">Rating: <i data-feather="star" style="color: orange;"></i> {{ $item->rating }}</p>
                                    <p>
                                        {{ $item->user->username }}
                                    </p>                                    
                                    <p>
                                        {{ $item->deskripsi }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>


                        @if ($ulasan->isEmpty())
                            <p class="text-center text-secondary">Belum ada penilaian dari pelanggan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection