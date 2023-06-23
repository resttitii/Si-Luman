@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 20em;">
        <div class="row justify-content-center mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Rekap Transaksi Keuangan</h5>

                        <div class="col-12 mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Pelanggan</th>
                                        <th class="text-center">Jumlah Harga</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($rekap as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer p-2">
                        <h6 class="text-end mb-0">
                            Total: <strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection