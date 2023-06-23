@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-bottom: 5em"> 
    <div class="row justify-content-center align-items-center mt-4" style="font-size: 14px">
        <div class="col-xl-7 col-11 card p-0 mt-5">
            <div class="card-body px-4 py-4">
                <p>
                    <a href="{{ route('konsultasi') }}" class="text-dark" style="text-decoration: none"><i data-feather="arrow-left"></i> Kembali</a>
                </p>
                <div>
                    <h5 style="font-weight: 700">{{ $title }}</h5>
                </div>
                <hr style="border: 1px solid #ddd">
                
                <form action="{{ url('/buat_keluhan') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="question">Pertanyaan anda</label>
                        <textarea name="question" class="form-control @error('question') is-invalid @enderror" placeholder="Apa keluhan anda?" id="question" style="font-size: 14px" cols="30" rows="10">{{ old('question') }}</textarea>
                        @error('question')
                        <span class="text-danger" style="font-size: 12px">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-4">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection