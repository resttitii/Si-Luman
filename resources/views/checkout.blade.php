@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="container">
            <div class="row mt-5">
                <form action="{{ '/update_checkout/' . $detail_transaksi->kode_transaksi  }}" method="POST" class="card">
                    @csrf
                    <div class="card-body">
                        <a href="{{ route('keranjang') }}" class="col-12 text-dark text-decoration-none">
                            <i data-feather="arrow-left"></i>
                        </a>
                        <div class="col-12 text-center alert alert-danger mt-4">
                            Produk hanya dapat dikirimkan untuk wilayah besuki raya dan pengiriman dilakukan langsung oleh pihak toko!
                        </div>
                        <div class="col-12 mt-3">
                            <select name="ongkir" required class="form-control" id="">
                                <option value="">Pilih Alamat Tujuan</option>
                                @foreach ($ongkir as $item)
                                    <option value="{{ $item->harga }}">Banyuwangi/{{ $item->alamat }} (Rp. {{ number_format($item->harga, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
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
                                <p class="mb-0">: <span class="text-info" style="font-size: 13px">Sesuai dengan pilihan alamat tujuan</span></p>
                                <p class="text-danger">: <span>Rp. {{ number_format($detail_transaksi->biaya_admin, 0, ',', '.') }}</span></p>
                            </div>
                        </div>

                        <p class="text-end mt-4 mb-0">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#confirm" class="btn btn-success px-4">Bayar</button>
                        
                            <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <p class="text-center mb-0">
                                                Apakah anda yakin untuk melakukan pembayaran? Rentang waktu 1 x 24 jam!
                                            </p>
                                        </div>
                                        <div class="d-flex my-3 justify-content-center">
                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>        
                                            <button type="submit" class="btn btn-success px-3 ms-4">
                                                Bayar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection