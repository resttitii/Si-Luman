@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="container">
            <div class="row mt-5">
                <form action="{{ '/update_checkout/' . $detail_transaksi->kode_transaksi  }}" method="POST" class="card" style="background:#D9D9D9; border-radius: 2px; border: none;">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <a href="{{ route('transaksi') }}" class="col-12 text-dark text-decoration-none">
                                    <i data-feather="arrow-left"></i>
                                </a>
                            </div>
                            <div class="">
                                <span class="text-secondary">
                                    {{ $detail_transaksi->expiry }}
                                </span>
                            </div>
                        </div>

                        @foreach ($rincian as $item)
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <div class="col-md-4 d-flex">
                                    <span>{{ $loop->iteration . '.' }} </span>
                                    <div class="ms-2 d-flex flex-column">
                                        <p class="mb-0">{{ $item->produk->nama_produk; }}</p>
                                        <p class="mb-0">Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                                        <span class="ms-3">
                                            {{ $item->produk->user->username }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    x {{ $item->stock }}
                                </div>
                            </div>
                        </div>

                        <hr>
                        @endforeach

                        <div class="row mt-4 justify-content-between">
                            <div class="d-flex col-md-4 flex-column">
                                <p class="mb-0">Subtotal untuk produk</p>
                                <p class="mb-0">Biaya Ongkir</p>
                                <p>Biaya Layanan/Admin</p>
                            </div>
                            <div class="d-flex col-md-3 flex-column">
                                <p class="mb-0 text-success">: Rp. {{ number_format($detail_transaksi->total_harga, 0, ',', '.') }}</p>
                                <p class="mb-0">: <span style="font-size: 15px">Rp. {{ number_format($detail_transaksi->biaya_ongkir, 0, ',', '.') }}</span></p>
                                <p class="text-danger">: <span>Rp. {{ number_format($detail_transaksi->biaya_admin, 0, ',', '.') }}</span></p>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection