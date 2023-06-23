@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="col-12">
                            <a href="{{ url('/detail_produk/'.$ulasan->produk->produk_id) }}" class="text-dark text-decoration-none">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>

                        <div class="row mt-3">
                            <p>Ulasan: <strong>{{ $ulasan->user->username }}</strong></p>

                            <div class="row mb-4 justify-content-center">
                                <div class="col-11 card" style="background: #ddd">
                                    <div class="card-body">
                                        {{ $ulasan->deskripsi }}
                                    </div>
                                </div>
                            </div>

                            <form action="@if($id_page == 29) {{ url('/create_balas_ulasan') }} @else {{ url('/update_balas_ulasan/'.$balas_ulasan->balasan_id) }} @endif" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $ulasan->ulasan_id }}" name="ulasan_id" id="">
                                <input type="hidden" name="produk_id" value="{{ $ulasan->produk->produk_id }}" id="">
                                <textarea name="deskripsi" placeholder="Masukkan ulasan anda mengenai produk ini" required class="form-control" id="" rows="6" style="background: #fff">@if($id_page == 30) {{ $balas_ulasan->deskripsi }} @endif</textarea>

                                <div class="mt-4">
                                    @if ($id_page == 30)
                                        
                                    <button class="btn btn-info">Update</button>
                                    
                                    @else
                                    
                                    <button class="btn btn-success">Simpan</button>
                                    
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection