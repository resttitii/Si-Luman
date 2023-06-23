@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mx-2 justify-content-center align-items-start">
            <div class="col-xl-10 mb-5 p-0" style="position: relative; top: 50px;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center" style="font-weight: bold">{{ $title }}</h5>
                    
                        <div class="table-responsive">
                            <table class="table table-striped" id="users">
                                <thead>
                                    <tr style="white-space: nowrap; font-size: 14px">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th>Status Email</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($users as $item)
                                    <tr style="font-size: 14px; white-space: nowrap">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        @if ($item->email_verified_at != null)

                                        <td>
                                            <span class="rounded px-3 bg-success text-light">Verified</span>
                                        </td>
                                        
                                        @else
                                        <td>
                                            <span class="rounded px-3 bg-danger text-light">Not Verified</span>
                                        </td>
                                            
                                        @endif
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