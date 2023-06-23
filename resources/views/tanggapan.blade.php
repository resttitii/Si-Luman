@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-bottom: 5em"> 
    <div class="row justify-content-center align-items-center mt-4" style="font-size: 14px">
        <div class="col-xl-7 col-11 card p-0 mt-4" style="height: 80vh;">
            <div class="card-body px-4 py-4" style="overflow-y: auto">
                <div class="justify-content-between align-items-center">
                    <p>
                        <a href="{{ route('konsultasi') }}" class="text-dark" style="text-decoration: none"><i data-feather="arrow-left"></i> Kembali</a>
                    </p>
                    <div>
                        <h5 style="font-weight: bold">
                            Pertanyaan dari <span class="text-warning">{{ $keluhan->user->username }}</span>
                        </h5>
                        
                    </div>
                </div>
                
                <hr style="border: 1px solid #ddd">

                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/icon/'.$keluhan->user->role.'_profil.png') }}" width="40" style="border-radius: 100%" alt="">
                            <div class="ms-2 d-flex flex-column">
                                <span>{{ $keluhan->user->username }}</span>
                                <span class="text-light rounded @if($keluhan->user->role == 'pelanggan') bg-primary @endif px-2" style="@if($keluhan->user->role == 'peternak') background: brown; @endif font-size: 12px">{{ ucfirst($keluhan->user->role) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-2">
                        <p class="mb-0">
                            {{ $keluhan->question }}
                        </p>
                        <hr style="border: 1px solid #ddd">
                    </div>
                </div>

                <p style="font-weight: 700" class="text-muted">Tanggapan</p>
                @if(!$tanggapan->isEmpty())
                @foreach ($tanggapan as $item)
                <div class="col-12 ps-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/icon/'.$item->user->role.'_profil.png') }}" width="40" style="border-radius: 100%" alt="">
                            <div class="ms-2 d-flex flex-column">
                                <span>{{ $item->user->username }}</span>
                                <span class="text-light rounded @if($item->user->role == 'pelanggan') bg-primary @elseif($item->user->role == 'dokter') bg-success @endif text-center px-2" style="@if($item->user->role == 'peternak') background: brown; @endif font-size: 12px">{{ ucfirst($item->user->role) }}</span>
                            </div>
                        </div>
                        
                        @if (auth()->user()->user_id == $item->user_id)
                        
                        <div class="dropdown">
                            <button class="btn" type="button" style="font-size: 14px" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="info" style="width: 17px"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{ '#hapus_tanggapan'.$item->tanggapan_id }}">Hapus</a></li>
                                @if (auth()->user()->role == 'dokter')
                                <li><a href="{{ url('/edit_tanggapan/'.$item->tanggapan_id.'/'.$item->keluhan->keluhan_id) }}" class="dropdown-item">Edit</a></li>
                                @endif
                            </ul>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'hapus_tanggapan'.$item->tanggapan_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{ 'hapus_tanggapan'.$item->tanggapan_id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="{{ 'hapus_tanggapan'.$item->tanggapan_id }}Label">Perhatian</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus tanggapan anda?
                                        </div>
                                        
                                        <form action="{{ url('/hapus_tanggapan/'.$item->tanggapan_id) }}" method="POST">
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                <button type="submit" class="btn btn-danger">Yakin</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        @endif
                    </div>
                    
                    <div class="p-2">
                        <p class="mb-0">
                            {{ $item->comment }}
                        </p>
                        <hr style="border: 1px solid #ddd">
                    </div>
                </div>
                @endforeach
                
                @else
                
                <div class="col-12 text-center">
                    <img src="{{ asset('img/empty.svg') }}" width="300" alt="">
                    <p class="text-muted">Belum ada data tanggapan</p>
                </div>
                
                @endif
            </div>
            @if (auth()->user()->role != 'admin')
                
            <div class="card-footer text-end">
                <a href="{{ url('/tambah_tanggapan/'.$keluhan->keluhan_id) }}" class="btn btn-success px-3" style="font-size: 12px">+</a>
                @if (auth()->user()->role != 'dokter')
                <a href="{{ route('konsultasi_lanjutan') }}" class="btn btn-warning ms-1" style="font-size: 12px">Ingin konsultasi lanjutan?</a>
                @endif
            </div>
            
            @endif
        </div>
    </div>
</div>
@endsection