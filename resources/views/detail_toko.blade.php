@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="margin-bottom: 15em;">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <a href="{{ route('toko') }}" class="text-dark text-decoration-none">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>
                        <div class="col-12 mt-4 d-flex align-items-center justify-content-between">
                            <div class="">
                                <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                                <span class="ms-3">
                                    Toko: {{ $user->username }}
                                </span>
                            </div>
                            <a href="{{ url('/kontak_peternak/'.$user->user_id) }}" class="btn" style="background: #C2D83B">Hubungi Toko</a>
                        </div>

                        <div class="row my-4 px-5 justify-content-between" style="row-gap: 25px">
                            @foreach ($produk as $item)
                            <div class="col-md-6">
                                <a class="card text-decoration-none text-dark" href="{{ url('/detail_produk/' . $item->produk_id) }}" style="border: none; border-radius: 0; height: 45vh; background: #D9D9D9;">
                                    <div class="card-body">
                                        <div class="rounded" style="height: 25vh; background: #042806">
                                            <img src="{{ asset('storage/images/'.$item->image_produk) }}" alt="" class="rounded" style="width: 100%; height: 100%; object-fit: cover">
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-2">{{ $item->nama_produk }}</p>
                                            <p>Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection