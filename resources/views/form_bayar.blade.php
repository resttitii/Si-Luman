@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 15em;">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card" style="background: #D9D9D9; border: none;">
                    <div class="card-body">
                        <div class="col-12">
                            <a href="{{ route('transaksi') }}" class="text-dark text-decoration-none">
                                <i data-feather="arrow-left"></i>
                            </a>
                        </div>
                        <div class="row my-4 p-4">
                            <div class="col-12 d-flex">
                                <div class="">
                                    <span class="mb-0 p-3 py-1 text-light bg-success" style="border-radius: 100%; font-weight: bold">1</span>
                                </div>
                                <div class="ms-2">
                                    <span>Pembayaran produk: Rp. {{ number_format($transaksi->biaya_ongkir + $transaksi->total_harga, 0, ',', '.') }} <span class="text-primary">(Biaya Ongkir + Total Harga Produk)</span></span>
                                    <p class="mb-0">Transfer ke nomor rekening 0987654321 an Sutrisno/BCA</p>
                                    <p class="mb-0">
                                        <a target="_blank" href="{{ 'https://wa.me/+6282136616987?text=Halo,%20peternak!%20saya%20mau%20meng-upload%20bukti%20pembayaran%20produk!' }}">Upload Bukti Pembayaran ke Peternak</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 d-flex mt-5">
                                <div class="">
                                    <span class="mb-0 p-3 py-1 text-light bg-success" style="border-radius: 100%; font-weight: bold">2</span>
                                </div>
                                <div class="ms-2">
                                    <span>Pembayaran layanan: Rp. {{ number_format($transaksi->biaya_admin, 0, ',', '.') }}</span>
                                    <p>Transfer ke nomor rekening 1234567890 an Anya Forger/BCA</p>
                                    <p class="mb-0">
                                        <a target="_blank" href="{{ 'https://wa.me/+6281231547257?text=Halo,%20Admin!%20saya%20mau%20meng-upload%20bukti%20pembayaran%20layanan!' }}">Upload Bukti Pembayaran ke Admin</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <span class="mb-0 p-3 py-1 text-light bg-success" style="border-radius: 100%; font-weight: bold;">3</span>
                                <span>Selesai! Pembelian akan diproses!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection