@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-bottom: 5em"> 
    <div class="row justify-content-center align-items-center mt-4" style="font-size: 14px">
        <div class="col-xl-7 col-11 card p-0 mt-4" style="height: 80vh; overflow-y: auto">
            <div class="card-body px-4 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" style="font-size: 14px" data-bs-toggle="dropdown" aria-expanded="false">
                          @if($id_page == 2)
                            Semua Keluhan
                          @elseif($id_page == 15) 
                            Telah Ditanggapi
                          @elseif($id_page == 16)
                            Belum Ditanggapi
                          @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('konsultasi') }}">Semua Keluhan</a></li>
                          <li><a class="dropdown-item" href="{{ route('ditanggapi') }}">Telah Ditanggapi</a></li>
                          <li><a class="dropdown-item" href="{{ route('belum_ditanggapi') }}">Belum ditanggapi</a></li>
                        </ul>
                    </div>

                    @if (auth()->user()->role == 'peternak' || auth()->user()->role == 'pelanggan')
                    <a href="{{ route('tambah_keluhan') }}" class="btn btn-success" style="border-radius: 100%">
                        +
                    </a>
                    @endif
                </div>
                <hr style="border: 1px solid #ddd">
                
                @if(!$keluhan->isEmpty())
                @foreach ($keluhan as $item)
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/icon/'.$item->user->role.'_profil.png') }}" width="40" style="border-radius: 100%" alt="">
                            <div class="ms-2 d-flex flex-column">
                                <span>{{ $item->user->username }}</span>
                                <span class="text-light rounded @if($item->user->role == 'pelanggan') bg-primary @endif px-2" style="@if($item->user->role == 'peternak') background: brown; @endif font-size: 12px">{{ ucfirst($item->user->role) }}</span>
                            </div>
                        </div>

                        @if (auth()->user()->user_id == $item->user_id)
                            
                        <div class="dropdown">
                            <button class="btn" type="button" style="font-size: 14px" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="info" style="width: 17px"></i></button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{ '#hapus_keluhan'.$item->keluhan_id }}">Hapus</a></li>
                            </ul>

                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'hapus_keluhan'.$item->keluhan_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{ 'hapus_keluhan'.$item->keluhan_id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="{{ 'hapus_keluhan'.$item->keluhan_id }}Label">Perhatian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus keluhan anda?
                                        </div>

                                        <form action="{{ url('/hapus_keluhan/'.$item->keluhan_id) }}" method="POST">
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
                            {{ $item->question }}
                        </p>
                        <p class="text-end mb-0 mt-2">
                            <a href="{{ url('/tanggapan/'.$item->keluhan_id) }}"><i class="text-muted" data-feather="message-square"></i></a>
                        </p>
                        <hr style="border: 1px solid #ddd">
                    </div>
                </div>
                @endforeach
               
               @else

               <div class="col-12 text-center">
                    <img src="{{ asset('img/empty.svg') }}" width="300" alt="">
                    <p class="text-muted">Belum ada data keluhan</p>
                </div>

               @endif
            </div>
        </div>
    </div>
</div>
@endsection