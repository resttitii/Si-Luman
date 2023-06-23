    <div class="container-fluid">

    <div class="row p-2 justify-content-center align-items-center" style="background: #b1c39f">
        <a href="{{ route('beranda') }}" class="text-center">
            <img src="{{ asset('img/logo.png') }}" style="width: 200px" alt="logo">
        </a>
    </div>

    @if ($id_page != 'auth')
    
    <div class="row">
        <nav class="navbar navbar-expand-xl" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px; background: #C4D5B2; z-index: 10;">
            <div class="d-flex @auth justify-content-between @else justify-content-end @endauth navbar-collapse">
                @auth
                <button type="button" class="navbar-toggler" style="border: 0;" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-nav collapse navbar-collapse navbar-expand-xl mx-3" id="navbarCollapse">
                    <a href="{{ route('beranda') }}" class="nav-item nav-link text-center" @if($id_page == 1) style="font-weight: bold;" @endif>Beranda</a>
                    <a href="{{ route('konsultasi') }}" class="nav-item nav-link text-center" @if($id_page == 2 || $id_page == 11 || $id_page == 12 || $id_page == 13 || $id_page == 14) style="font-weight: bold;" @endif>Konsultasi</a>
                    <a href="{{ route('toko') }}" class="nav-item nav-link text-center" @if($id_page == 3) style="font-weight: bold;" @endif>Toko</a>
                </div>

                <div class="navbar-nav mx-3">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex justify-content-center align-items-center" style="height: 40px; width: 40px; border-radius: 100%;">
                                <img src="{{ asset('img/icon/'.auth()->user()->role.'_profil.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%;" alt="">
                            </div>
                          </a>

                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li style="border-bottom: 1px solid #eee">
                                <a class="dropdown-item disabled">
                                    <img src="{{ asset('img/icon/'.auth()->user()->role.'_profil.png') }}" style="width: 30px;object-fit: cover; border-radius: 100%;" alt="">
                                    {{ auth()->user()->username }}
                                </a>
                            </li>
                            <li><a class="dropdown-item @if($id_page == 4) active @endif" href="{{ route('profile') }}">Profile</a></li>

                            @if (auth()->user()->role == 'pelanggan')
                            
                            <li><a class="dropdown-item @if($id_page == 5) active @endif" href="{{ route('upgrade_role') }}">Upgrade Role</a></li>
                            
                            @endif

                            @if(auth()->user()->role == 'admin')

                            <li>
                                <a class="dropdown-item disabled">Role</a>
                                <ul>        
                                    <li><a href="{{ route('data_pelanggan') }}" class="dropdown-item @if($id_page == 7) active @endif">Pelanggan</a></li>
                                    <li><a href="{{ route('data_peternak') }}" class="dropdown-item @if($id_page == 8) active @endif">Peternak</a></li>
                                    <li><a href="{{ route('data_dokter') }}" class="dropdown-item @if($id_page == 9) active @endif">Dokter</a></li>
                                </ul>
                            </li>
                            
                            <li><a class="dropdown-item @if($id_page == 10) active @endif" href="{{ route('change_role') }}">Change Role</a></li>
                            
                            @endif

                            @if (auth()->user()->role == 'peternak')
                            <a class="dropdown-item disabled">Toko saya</a>
                              <ul>
                                <li><a class="dropdown-item @if($id_page == 18) active @endif" href="{{ route('produk') }}">Produk</a></li>                                
                                <li><a class="dropdown-item @if($id_page == 27) active @endif" href="{{ route('transaksi') }}">Transaksi</a></li>                                                                  
                                <li><a class="dropdown-item @if($id_page == 32) active @endif" href="{{ route('rekap_transaksi') }}">Rekap Transaksi</a></li>
                                <li><a class="dropdown-item @if($id_page == 22) active @endif" href="{{ route('rekap_produk') }}">Rekap Produk</a></li>                                    
                              </ul>
                            @endif

                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pelanggan')
                              <li><a class="dropdown-item @if($id_page == 27) active @endif" href="{{ route('transaksi') }}">@if(auth()->user()->role == 'admin') Status Transaksi @else Transaksi @endif</a></li>                                  
                            @endif

                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">Logout</a>
                            </li>
                          </ul>

                        </li>
                    </ul>

                </div>

                @else

                @if ($id_page != 'auth')
                
                <div class="navbar-nav mx-3">
                    <a href="{{ route('login') }}">
                        <button class="btn btn-success px-4">Login</button>
                    </a>
                </div>

                @endif

                @endauth
             </div>
        </nav>
    </div>
    @endif

</div>

<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin keluar dari sistem?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Ya</button>
          </form>
        </div>
      </div>
    </div>
</div>