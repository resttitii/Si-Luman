@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center align-items-start">
            <div class="col-xl-5 col-10 p-4 rounded mb-5 position-relative" style="background: #fff; top: 40px">
                <div>
                    <p>
                        <a href="{{ route('konsultasi') }}" class="text-dark" style="text-decoration: none"><i data-feather="arrow-left"></i> Kembali</a>
                    </p>
                    <h5 class="text-start">
                        <strong>{{ $title }}</strong>
                    </h5>

                    <hr style="border: 1px solid #bbb">

                    <p style="font-size: 14px">
                        Masih belum puas dengan jawaban dari pertanyaan anda? Klik tombol di bawah ini supaya kamu dapat langsung berkonsultasi dengan ahlinya.
                    </p>

                    <a href="https://wa.me/+6281231547257?text=Halo%2C%20saya%20ingin%20berkonsultasi%20lebih%20lanjut." target="_blank">
                        <button class="btn btn-warning mt-4" style="width: 100%; height: 50px;">
                            <strong>Konsultasi Sekarang</strong>
                        </button>
                    </a>
                    

                </div>
            </div>
        </div>
    </div>

@endsection
