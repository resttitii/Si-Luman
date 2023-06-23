@extends('layouts.app')

@section('content')
    <div class="contain-fluid" style="margin-bottom: 15em;">
        <div class="container mt-5">
            <div class="row">
                <p class="text-end">
                    <a href="{{ route('create_produk') }}" class="btn btn-success">+</a>
                </p>
                <div class="col-12">
                    <div class="card" style="background: #D9D9D9; border: none; border-radius: 0;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="data">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Status Produk</th>
                                            <th>Penilaian</th>
                                            <th></th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @foreach ($my_produk as $item)   
                                        <tr>
                                            <td>{{ $loop->iteration . '.' }} <a href="{{ url('/edit_produk/' . $item->produk_id) }}" class="text-decoration-none text-dark">{{ $item->nama_produk }}</a></td>
                                            <td>
                                                <em>{{ $item->status }}</em>
                                            </td>
                                            <td>
                                                <a href="{{ url('/rekap_penilaian/'.$item->produk_id) }}">Lihat</a>
                                            </td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="{{ '#hapus' . $item->produk_id }}">
                                                    <i data-feather="info"></i>
                                                </a>
                                            </td>

                                            <div class="modal fade" id="{{ 'hapus' . $item->produk_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5">
                                                            <p class="text-center mb-0">
                                                                apakah anda yakin untuk menghapus produk?
                                                            </p>
                                                        </div>
                                                        <form action="{{ url('/hapus_produk/'.$item->produk_id) }}" method="POST">
                                                            @csrf
                                                            <div class="d-flex my-3 justify-content-center">
                                                                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger px-3 ms-4">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection