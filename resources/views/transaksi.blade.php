@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 20em;">
       <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="height: 65vh; overflow-y: auto">
                    <div class="card-body">

                            <table class="table" id="data">
                                <thead>
                                    @if (auth()->user()->role == 'admin')
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Transaksi</th>
                                            <th>Pelanggan</th>
                                            <th>Toko/Pembelian</th>
                                            <th>Pembayaran</th>
                                            <th>Expired</th>
                                            <th>Status</th>
                                        </tr>

                                    @elseif(auth()->user()->role == 'peternak')
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Transaksi</th>
                                            <th>Username</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status Admin</th>
                                            <th>Status Pengiriman</th>
                                        </tr>

                                    @else
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Toko</th>
                                            <th class="text-center">Status Pembayaran</th>
                                            <th class="text-center">Status Pengiriman</th>
                                        </tr>
                                    @endif
                                </thead>

                                <tbody>
                                    @foreach ($transactions as $item)
                                        @if (auth()->user()->role == 'admin')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_transaksi }}</td>
                                            <td>{{ $item->cust_username }}</td>
                                            <td>{{ $item->toko_username }}</td>
                                            <td>{{ $item->status_pembayaran }}</td>
                                            <td>{{ $item->expiry }}</td>
                                            <td>
                                                <div class="dropdown-center" style="font-size: 13px">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"  style="font-size: 14px;">
                                                      @if ($item->status_admin == null)
                                                          -
                                                      @else
                                                      {{ ucfirst($item->status_admin) }}
                                                      @endif
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <form action="{{ url('/update_statusAdmin/'.$item->kode_transaksi) }}" method="POST">
                                                            @csrf
                                                            <li><button type="submit" class="dropdown-item" name="sukses">Sukses</button></li>
                                                            <li><button type="submit" class="dropdown-item" name="ditolak">Ditolak</button></li>
                                                            <li><button type="submit" class="dropdown-item" name="gagal">Gagal</button></li>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        @elseif(auth()->user()->role == 'peternak')
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('/detail_transaksi/'.$item->kode_transaksi) }}">{{ $item->kode_transaksi }}</a>
                                                </td>
                                                <td>{{ $item->username }}</td>
                                                <td>
                                                    <div class="dropdown-center" style="font-size: 14px">
                                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"  style="font-size: 14px;">
                                                          @if ($item->status_pembayaran == null)
                                                              -
                                                          @else
                                                          {{ ucfirst($item->status_pembayaran) }}
                                                          @endif
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <form action="{{ url('/update_statusPembayaran/'.$item->kode_transaksi.'/'.$item->toko_id) }}" method="POST">
                                                                @csrf
                                                                <li><button type="submit" class="dropdown-item" name="sukses">Sukses</button></li>
                                                                <li><button type="submit" class="dropdown-item" name="ditolak">Ditolak</button></li>
                                                                <li><button type="submit" class="dropdown-item" name="gagal">Gagal</button></li>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ ucfirst($item->status_admin) }}
                                                </td>
                                                <td>
                                                    <div class="dropdown-center" style="font-size: 13px">
                                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"  style="font-size: 14px;">
                                                          @if ($item->status_pengiriman == null)
                                                              -
                                                          @else
                                                          {{ ucfirst($item->status_pengiriman) }}
                                                          @endif
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <form action="{{ url('/update_statusPengiriman/'.$item->kode_transaksi.'/'.$item->toko_id) }}" method="POST">
                                                                @csrf
                                                                <li><button type="submit" class="dropdown-item" name="belum diproses">Belum diproses</button></li>
                                                                <li><button type="submit" class="dropdown-item" name="diproses">Diproses</button></li>
                                                                <li><button type="submit" class="dropdown-item" name="selesai">Selesai</button></li>
                                                                <li><button type="submit" class="dropdown-item" name="gagal">Gagal</button></li>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('/detail_transaksi/'.$item->kode_transaksi) }}">{{ $item->kode_transaksi }}</a>
                                                </td>
                                                <td>{{ $item->username }}</td>
                                                <td class="text-center">
                                                    @if ($item->status_pembayaran == 'sukses' && $item->status_pengiriman == 'selesai' && $item->status_admin == 'sukses')
                                                        <a href="{{ url('/ulasan/'.$item->produk_id) }}">Selesai</a>
                                                    @elseif($item->status_pembayaran == 'gagal' && $item->status_admin == 'gagal')
                                                        <a href="{{ url('/form_bayar/'.$item->kode_transaksi) }}">Gagal</a>    
                                                    @elseif ($item->status_admin != 'sukses' || $item->status_pembayaran != 'sukses' || $item->status_pengiriman != 'selesai')
                                                        <a href="{{ url('/form_bayar/'.$item->kode_transaksi) }}">Diproses</a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ ucfirst($item->status_pengiriman) }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if ($transactions->isEmpty())
                                        <p class="text-center text-secondary">Belum ada transaksi di sini</p>
                                    @endif
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
@endsection
