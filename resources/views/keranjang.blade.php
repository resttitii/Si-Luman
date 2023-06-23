@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 15em;">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-10 card">
                <div class="card-body"  style="height: 80vh; overflow-y: auto">
                    <div class="col-12">
                        <a href="{{ route('toko') }}" class="text-dark text-decoration-none">
                            <i data-feather="arrow-left"></i>
                        </a>
                    </div>

                    @foreach($keranjang as $toko)
                        <div class="row mx-3 mt-4 mb-3 border-grey border-bottom border-1">
                            <div class=" mb-1">
                                <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                                <span class="ms-3">
                                            {{ $toko[0]->username }}
                                        </span>
                            </div>
                        </div>
                        @foreach($toko as $item)
                            <form action="/create_checkout" method="POST">
                                @csrf
                                <input type="hidden" name="{{ $item->keranjang_id }}" id="">
                                <div class="row mx-3 mb-3">
                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success rounded" style="height: 100px; width: 100px;">
                                                <img src="{{ asset('storage/images/'.$item->produk->image_produk) }}" class="rounded" style="width: 100%; height: 100%; object-fit: cover" alt="">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0">
                                                    {{ $item->produk->nama_produk }}
                                                </p>
                                                <p>
                                                    Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            @if ($item->stock == null)
                                                <span>0</span>
                                            @else
                                                {{ $item->stock }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                    @endforeach

                        @if ($keranjang->isEmpty())
                            <p class="text-center text-secondary">Keranjang anda masih kosong</p>
                        @endif
                    </div>

                    <div class="card-footer">
                        <div class="col-12 text-end my-4">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#confirm1" class="btn text-danger"><i data-feather="trash"></i></button>
                            <button data-bs-toggle="modal" type="button" data-bs-target="#confirm2" class="btn btn-success px-4">Beli</button>

                            <div class="modal fade" id="confirm2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <p class="text-center mb-0">
                                                Apakah anda yakin untuk membeli produk?
                                            </p>
                                        </div>
                                        <div class="d-flex my-3 justify-content-center">
                                            <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success px-3 ms-4">
                                                Beli
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                        <div class="modal fade" id="confirm1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body p-5">
                                        <p class="text-center mb-0">
                                            Yakin akan menghapus produk ini dari keranjang?
                                        </p>
                                    </div>
                                    <div class="d-flex my-3 justify-content-center">
                                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                        <form action="/hapus_keranjang" method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-danger px-3 ms-4">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
