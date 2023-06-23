@extends('layouts.app')

<style>
    .custom-file-input input[type="file"] {
  display: none;
}

.custom-file-input label {
  padding: 20px;
  width: 100%;
  border: none;
  cursor: pointer;
  text-align: center;
}

</style>

@section('content')
    <div class="container-fluid" style="margin-bottom: 8em">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <a class="text-dark" href="{{ route('produk') }}">
                                    <i data-feather="arrow-left"></i>
                                </a>
                            </div>
                            <form action="@if($id_page == 19) {{ route('handleCreateProduk') }} @else {{ url('/update_produk/'.$produk->produk_id) }} @endif" class="col-12" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-5 justify-content-center align-items-center">
                                    <div class="mt-3 col-4 rounded" style="background: #042806; height: 25vh;">
                                        <div class="custom-file-input d-flex justify-content-center align-items-center" style="height: 100%">
                                            <label for="file-input">
                                                <img src="{{ asset('img/icon/upload.png') }}" alt="Preview Image" width="50" height="50">
                                                <br>
                                                <p class="file-name text-light">
                                                    @if ($id_page == 20)
                                                        {{ $produk->image_produk }}
                                                    @endif
                                                </p>
                                            </label>
                                            <input type="file" id="file-input" @if($id_page == 19) required @endif name="image_produk" class="file-input" accept=".png, .jpeg, .jpg">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" required class="form-control" name="nama_produk" id="nama_produk" style="background: #D9D9D9; border: 0; border-radius: 0;" placeholder="Masukkan nama produk" @if($id_page == 20) value="{{ $produk->nama_produk }}" @endif>
                                    </div>

                                    <div class="mt-4">
                                        <label for="harga">Harga Produk</label>
                                        <input type="number" required min="0" class="form-control" name="harga" id="harga" style="background: #D9D9D9; border: 0; border-radius: 0;" placeholder="Masukkan harga produk" @if ($id_page == 20) value="{{ $produk->harga }}" @endif>
                                    </div>

                                    <div class="mt-4">
                                        <label for="jenis">Jenis</label>
                                        <select class="form-control" required name="jenis" id="jenis" style="background: #D9D9D9; border: 0; border-radius: 0;">
                                            @if ($id_page == 20)
                                            <option value="{{ $produk->jenis }}">{{ ucfirst($produk->jenis) }}</option>
                                            @endif
                                            <option value="">Pilih Jenis Produk</option>
                                            <option value="hewan">Hewan</option>
                                            <option value="pupuk">Pupuk</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label for="berat">Berat</label>
                                        <input type="number" min="0" required class="form-control" name="berat" id="berat" style="background: #D9D9D9; border: 0; border-radius: 0;" placeholder="Satuan KG" @if($id_page == 20) value="{{ $produk->berat }}" @endif>
                                    </div>
                                   
                                    <div class="mt-4">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" required rows="6" class="form-control" placeholder="Masukkan deskripsi produk" style="background: #D9D9D9; border: 0; border-radius: 0;">@if($id_page == 20) {{ $produk->deskripsi }} @endif</textarea>
                                    </div>

                                    <div class="mt-4">
                                        <label for="status">Status Produk</label>
                                        <select class="form-control" required name="status" id="status" style="background: #D9D9D9; border: 0; border-radius: 0;">
                                            @if ($id_page == 20)
                                                <option value="{{ $produk->status }}">{{ ucfirst($produk->status) }}</option>
                                            @endif
                                            <option value="">Pilih Status Produk</option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                    </div>

                                    <p class="mt-4 mb-0 text-end">
                                        <button type="button" class="btn @if($id_page == 20) btn-info @else btn-success @endif" data-bs-toggle="modal" data-bs-target="#tambah_produk">@if($id_page == 20) Simpan @else Tambah @endif</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="tambah_produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-5">
                                                        <p class="text-center mb-0">
                                                            Apakah anda yakin untuk 
                                                            @if ($id_page == 20)
                                                                menyimpan perubahan?
                                                            @else
                                                                menambahkan produk?
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="d-flex my-3 justify-content-center">
                                                        <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn @if($id_page == 20) btn-info @else btn-success @endif px-3 ms-4">
                                                            @if ($id_page == 20)
                                                                Simpan
                                                            @else
                                                                Tambah    
                                                            @endif
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
            </div>
        </div>
    </div>
@endsection