@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-bottom: 15em">
    <div class="row">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-6 px-0 rounded my-4" style="background: #A1B4AA;">
                <input type="text" class="text-center form-control p-1" style="background: none; border: none;" name="search_product" id="searchInput" placeholder="Produk pencarian">
            </div>
            <a href="{{ url('/keranjang') }}" class="ms-4 text-success text-decoration-none">
                <i data-feather="shopping-cart"></i>
            </a>
        </div>
    </div>

    <div class="row px-5 mt-4" style="row-gap: 50px" id="container">
        @foreach ($all_produk as $produk)
        <div class="col-md-4">
            <div class="card" data-searchable style="border: none; border-radius: 0; height: 45vh; background: #D9D9D9;">
                <a class="card-body text-dark text-decoration-none" href="{{ url('/detail_produk/'.$produk->produk_id) }}">
                    <div class="rounded" style="height: 25vh; background: #042806">
                        <img src="{{ asset('storage/images/'.$produk->image_produk) }}" class="rounded" alt="" style="width: 100%; height: 100%; object-fit: cover">
                    </div>
                    <div class="mt-4 text-center">
                        <p class="mb-2">{{ $produk->nama_produk }}</p>
                        <p>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                <a class="text-decoration-none card-footer d-flex justify-content-center align-items-center text-dark" href="{{ url('/detail_toko/' . $produk->user_id) }}">
                    <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                    <span class="ms-3">
                        Toko: {{ $produk->user->username }}
                    </span>
                </a>
            </div>
        </div>
        @endforeach

        @if ($all_produk->isEmpty())
            <p class="text-center text-secondary">Belum ada produk di sini.</p>
        @endif
    </div>
</div>

@endsection