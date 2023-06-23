@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="col-12">
                            <a href="{{ route('transaksi') }}" class="text-dark text-decoration-none">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>

                        <div class="row mt-3">
                            <p>Nama Produk: <strong>{{ $produk->nama_produk }}</strong></p>

                            <form action="{{ url('/create_ulasan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->produk_id }}" id="">
                                <textarea name="deskripsi" placeholder="Masukkan ulasan anda mengenai produk ini" required class="form-control" id="" rows="6" style="background: #fff"></textarea>
                                <p class="mt-4 mb-1">
                                    Rating: <select name="rating" required>
                                        <option value="">-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </p>

                                <div class="mt-4">
                                    <button class="btn btn-success">Buat Ulasan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection