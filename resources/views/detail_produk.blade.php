@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="margin-bottom: 15em;">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <a href="{{ route('toko') }}" class="text-dark text-decoration-none">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>
                        <div class="col-12 mt-4 d-flex align-items-center">
                            <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                            <span class="ms-3" onclick="window.location.href='/detail_toko/{{ $produk->user_id }}'">
                                Toko: {{ $produk->user->username }}
                            </span>
                                                        
                        </div>

                        <div class="row my-4 px-3 justify-content-between" style="row-gap: 25spx">
                            <div class="col-md-5 px-0 bg-success rounded" style="height: 30vh">
                                <img src="{{ asset('storage/images/'.$produk->image_produk) }}" class="rounded" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                            </div>
                            <div class="col-md-6" style="font-size: 14px; height: 35vh; overflow-y: auto">
                                <p class="mb-3">Produk: {{ $produk->nama_produk }}</p>
                                <p class="mb-3">Harga: Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <p class="mb-3">Jenis: {{ $produk->jenis }}</p>
                                <p class="mb-3">Berat: {{ $produk->berat }} kg</p>
                                <p class="mb-3">Pengiriman: Banyuwangi</p>
                                <p class="mb-0">Deskripsi</p>
                                <p style="font-size: 13px">{{ $produk->deskripsi }}</p>
                            </div>
                        </div>

                        <div class="row px-1 mt-4">
                            <p><em>Penilaian:</em></p>

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

                                    @if (auth()->user()->role == 'peternak')
                                        @if ($produk->user->user_id == auth()->user()->user_id)
                                            <a href="{{ '/balas_ulasan/'.$item->ulasan_id }}" class="btn border border-dark mb-3" style="font-size: 12px">tambah ulasan</a>
                                        @endif
                                    @endif

                                    @foreach ($balasan as $balas)

                                        @if ($balas->ulasan_id == $item->ulasan_id)
                                            @if (!$balasan->isEmpty())
                                            <div class="p-1 mb-4 col-12 d-flex justify-content-between align-items-center" style="background: #DFB3B3;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('img/icon/peternak_profil.png') }}" width="40" style="border-radius: 100%;" alt="">
                                                    <span class="ms-3">
                                                        {{ $balas->deskripsi }}
                                                    </span>
                                                </div>
                                                @if (auth()->user()->role == 'peternak')
                                                    @if ($produk->user->user_id == auth()->user()->user_id)
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <a href="{{ '/balas_ulasan/' . $item->ulasan_id }}" class="text-dark text-decoration-none">
                                                                <i data-feather="plus"></i>
                                                            </a>
                                                        </div>
                                                        <div class="dropdown-center">
                                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 14px">
                                                            <i data-feather="info"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="{{ '/edit_balas_ulasan/'.$item->ulasan_id.'/'.$balas->balasan_id }}">Edit</a></li>
                                                            <li><a class="dropdown-item" data-bs-target="{{ '#confirm_hapus' . $balas->balasan_id }}" data-bs-toggle="modal">Hapus</a></li>

                                                        </ul>
                                                        </div>
                                                    </div>
                                                    @endif


                                                    <div class="modal fade" id="{{ 'confirm_hapus' . $balas->balasan_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-5">
                                                                    <p class="text-center mb-0">
                                                                        Apakah anda yakin untuk menghapus ulasan?
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex mt-1 mb-2 justify-content-center">

                                                                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                                                    <form action="{{ url('/hapus_balas_ulasan/'. $balas->balasan_id) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger px-3 ms-4">
                                                                            Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>

                                @if (auth()->user()->role == 'pelanggan')
                                    @if (auth()->user()->user_id == $item->user_id)
                                    <a href="" data-bs-toggle="modal" data-bs-target="#confirm_hapus_ulasan">
                                        <i data-feather="info"></i>
                                    </a>
                                    @endif
                                @endif
                            </div>


                            <div class="modal fade" id="confirm_hapus_ulasan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <p class="text-center mb-0">
                                                Apakah anda yakin untuk menghapus ulasan?
                                            </p>
                                        </div>
                                        <div class="d-flex mt-1 mb-2 justify-content-center">

                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>

                                            <form action="{{ url('/hapus_ulasan/'.$item->ulasan_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger px-3 ms-4">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            @endforeach
                        </div>

                        @if (auth()->user()->role == 'pelanggan')
                            <p class="text-end mt-3 mb-0">
                                <a class="btn" data-bs-toggle="modal" data-bs-target="#confirm" style="background: #B8D029">
                                    <strong>Tambah</strong>
                                </a>
                            </p>


                            <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <p class="text-center mb-0">
                                                apakah anda yakin untuk menambahkan produk ke keranjang?
                                            </p>
                                        </div>
                                        <div class="d-flex mt-1 mb-2 justify-content-center">

                                            <form action="{{ url('/create_keranjang') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="toko_id" value="{{ $produk->user->user_id }}">
                                                <input type="hidden" name="produk_id" value="{{ $produk->produk_id }}">

                                                <div class="mb-4">
                                                    <input type="number" min="1" max="5" value="1" name="stock" id="stock" class="form-control text-center" style="border-radius: 0; background: #D9D9D9;" required placeholder="Masukkan jumlah stok yang diinginkan">
                                                </div>

                                                <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success px-3 ms-4">
                                                    Simpan
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
