@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mx-2 justify-content-center align-items-start">
            <div class="col-xl-10 my-5 p-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center" style="font-weight: bold">{{ $title }}</h5>
                    
                        <div class="table-responsive">
                            <table class="table table-striped" id="users">
                                <thead>
                                    <tr style="white-space: nowrap; font-size: 14px">
                                        <th>No.</th>
                                        <th>Username</th>
                                        <th>Status Akun</th>
                                        <th>Role</th>
                                        <th>Upgrade to</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($users as $item)
                                    <tr style="vertical-align: middle; font-size: 14px; white-space: nowrap">
                                        <td>{{ $no++ . '.' }}</td>
                                        <td>{{ $item->username }}</td>
                                        @if ($item->email_verified_at != null)

                                        <td>
                                            <span class="rounded px-3 bg-success text-light">Verified</span>
                                        </td>
                                        
                                        @else
                                        <td>
                                            <span class="rounded px-3 bg-danger text-light">Not Verified</span>
                                        </td>
                                        @endif
                                        
                                        <td>{{ ucfirst($item->role) }}</td>

                                        @if ($item->email_verified_at != null)
                                        
                                        <td>
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="{{ '#change'.$item->user_id }}">
                                                <i class="text-info" data-feather="arrow-up-circle"></i>
                                            </button>
                                        </td>
                                        
                                        <div class="modal fade" id="{{ 'change'.$item->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: bold">Change Role</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <form action="{{ url('/change_role/'.$item->user_id) }}" method="POST">
                                                    @csrf
                                                        <div class="modal-body">
                                                            <select name="role" id="role" class="form-control">
                                                                <option value="">- Change Role -</option>
                                                                <option value="pelanggan">Pelanggan</option>
                                                                <option value="peternak">Peternak</option>
                                                                <option value="dokter">Dokter</option>
                                                            </select>
                                                            
                                                            <button class="mt-4 btn btn-primary" type="submit">
                                                                Change
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @else

                                        <td>
                                            <em>
                                                user belum melakukan verifikasi email.
                                            </em>
                                        </td>

                                        @endif
                                        
                                        <td>
                                            <button class="btn">
                                                <i data-feather="trash-2" class="text-danger" data-bs-toggle="modal" data-bs-target="{{ '#delete'.$item->user_id }}"></i>
                                            </button>
                                        </td>

                                        <div class="modal fade" id="{{ 'delete'.$item->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold">Hapus {{$item->username }}?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <form action="{{ url('/hapus_user/'.$item->user_id) }}" method="POST">
                                                    @csrf
                                                        <div class="modal-body">
                                                            <div class="p-2" style="border: 1px solid #eee; border-radius: 2px; font-size: 14px">
                                                                <p class="mb-0">Username: <strong>{{ $item->username }}</strong></p>
                                                                <p class="mb-0">Email: <strong>{{ $item->email }}</strong></p>
                                                            </div>
                                                            
                                                            <button class="mt-4 btn btn-danger px-3" type="submit">
                                                                Hapus
                                                            </button>
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
@endsection