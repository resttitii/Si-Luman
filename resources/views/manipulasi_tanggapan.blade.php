@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-bottom: 5em"> 
    <div class="row justify-content-center align-items-center mt-4" style="font-size: 14px">
        <div class="col-xl-7 col-11 card p-0 mt-5">
            <div class="card-body px-4 py-4">
                <p>
                    <a href="{{ url('/tanggapan/'.$keluhan->keluhan_id) }}" class="text-dark" style="text-decoration: none"><i data-feather="arrow-left"></i> Kembali</a>
                </p>
                <div>
                    <h5 style="font-weight: 700">{{ $title }}</h5>
                </div>
                <hr style="border: 1px solid #ddd">
                
                @if($id_page == 13) <form action="{{ url('/buat_tanggapan') }}" method="POST"> @endif
                @if($id_page == 17) <form action="{{ url('/update_tanggapan/'.$tanggapan->tanggapan_id) }}" method="POST"> @endif
                    @csrf
                    <div class="col-12">
                        <input type="hidden" name="keluhan_id" value="{{ $keluhan->keluhan_id }}" id="">
                        <label for="comment">Tanggapan anda</label>
                        <textarea name="comment"  class="form-control @error('comment') is-invalid @enderror" placeholder="Apa tanggapan anda?" id="comment" style="font-size: 14px" cols="30" rows="10">@if($id_page == 17){{ $tanggapan->comment }}@else{{ old('comment') }}@endif </textarea>
                        @error('comment')
                        <span class="text-danger" style="font-size: 12px">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="mt-4">
                            <button type="submit" class="btn @if($id_page == 17) btn-info @else btn-warning @endif px-4">@if($id_page == 17) Update @else Kirim @endif</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection