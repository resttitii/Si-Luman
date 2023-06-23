<?php
//menghubungkan serta mengatur model dan view agar dapat saling terhubung

namespace App\Http\Controllers;

use App\Models\BalasanUlasan;
use App\Models\Keluhan;
use App\Models\Keranjang;
use App\Models\OngkirDomisili;
use App\Models\Produk;
use App\Models\Tanggapan;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function beranda() //controller beranda => mengatur semua aktor
    {
        $data = [
            'title' => 'Beranda',
            'id_page' => 1,
        ];
        return view('beranda', $data);
    }

    public function konsultasi() //controller konsultasi => mengatur halaman konsultasi
    {
        $data = [
            'title' => 'Konsultasi',
            'id_page' => 2,
            'keluhan' => Keluhan::with('user')->get(),
        ];

        return view('konsultasi', $data);
    }

    public function toko() //controller toko => mengatur halaman toko
    {
        $data = [
            'title' => 'Toko',
            'id_page' => 3,
            'all_produk' => Produk::with('user')->where('status', 'tersedia')->get(), //akan ditampilkan produk yang tersedia saja
        ];

        return view('toko', $data);
    }

    public function profile() //controller profile => mengatur profile => semua aktor
    {
        $data = [
            'title' => 'Profile',
            'id_page' => 4,
        ];

        return view('profile', $data);
    }

    public function upgrade_role() //controller upgrade role => hanya untuk pelanggan
    {
        $data = [
            'title' => 'Upgrade Role',
            'id_page' => 5,
        ];

        return view('upgrade_role', $data);
    }

    public function edit_profile($user_id) //controller edit profile => semua aktor dapat edit profile
    {
        $data = [
            'title' => 'Edit Profile',
            'id_page' => 6,
            'user' => User::find($user_id),
        ];

        return view('edit_profile', $data);
    }

    public function update_profile(Request $req, $user_id)
    {
        $user = User::find($user_id);
    
        // Menambahkan validasi required
        $req->validate([
            'name' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);
    
        $user->name = $req->name;
        $user->username = $req->username;
        $user->alamat = $req->alamat;
        $user->no_hp = $req->no_hp;
    
        $user->save();
    
        return redirect()->route('profile')->with('success', 'Berhasil merubah data!');
    }
    

    public function data_pelanggan() //controller untuk data pelanggan => hanya untuk role pelanggan => admin
    {
        $data = [
            'title' => 'Data Pelanggan',
            'id_page' => 7,
            'users' => User::where('role', '=', 'pelanggan')->get(),
        ];

        return view('users', $data);
    }

    public function data_peternak() //controller untuk data peternak => hanya untuk role peternak => admin
    {
        $data = [
            'title' => 'Data Peternak',
            'id_page' => 8,
            'users' => User::where('role', '=', 'peternak')->get(),
        ];

        return view('users', $data);
    }

    public function data_dokter() //controller untuk data dokter => hanya untuk role dokter => admin
    {
        $data = [
            'title' => 'Data Dokter',
            'id_page' => 9,
            'users' => User::where('role', '=', 'dokter')->get(),
        ];

        return view('users', $data);
    }

    public function change_role() //semua role dapat dichange => kecuali admin
    {
        $data = [
            'title' => 'Change Role',
            'id_page' => 10,
            'users' => User::where('role', '!=', 'admin')->get()
        ];

        return view('changerole', $data);
    }


    public function update_role($user_id, Request $request) //controller update => admin yang ngelakuin
    {
        if ($request->filled('role')) {
            $user = User::find($user_id);
            $user->role = $request->role;

            $user->save();

            return redirect()->back()->with('success', 'User berhasil diupgrade!');
        } else {
            return redirect()->back()->with('warning', 'Inputan tidak boleh kosong!');
        }
    }

    public function hapus_user($user_id) //controller untuk admin apus user
    {
        $user = User::find($user_id);

        $user->delete();

        return redirect()->back()->with('info', 'Satu user berhasil dihapus!');
    }

    public function tambah_keluhan() //controller untuk menambahkan keluhan => hanya untuk pelanggan dan peternak
    {
        $data = [
            'title' => 'Tambah Keluhan',
            'id_page' => 11,
        ];

        return view('manipulasi_keluhan', $data);
    }

    public function buat_keluhan(Request $req) //validasi dari nambah keluhan
    {
        $this->validate($req, [
            'question' => 'required'
        ], [
            'question.required' => 'Kolom input keluhan tidak boleh kosong!'
        ]);
        $keluhan = new Keluhan();

        $keluhan->user_id = auth()->user()->user_id;
        $keluhan->question = $req->question;

        $keluhan->save();

        return redirect()->route('konsultasi')->with('success', 'Berhasil mengirim keluhan!');
    }

    public function hapus_keluhan($keluhan_id) //controller yang mengatur keluhan dihapus
    {
        $keluhan = Keluhan::find($keluhan_id);

        $keluhan->delete();

        return back()->with('info', 'Sukses! Keluhan anda berhasil dihapus!');
    }

    public function tanggapan($keluhan_id) //controller halaman tanggapan
    {
        $keluhan = Keluhan::find($keluhan_id);
        $data = [
            'title' => 'Tanggapan',
            'id_page' => 12,
            'keluhan' => $keluhan,
            'tanggapan' => Tanggapan::with('user')->where('keluhan_id', $keluhan->keluhan_id)->get()
        ];

        return view('tanggapan', $data);
    }

    public function tambah_tanggapan($keluhan_id) //controller menambahkan tanggapan
    {
        $data = [
            'title' => 'Tambah Tanggapan',
            'id_page' => 13,
            'keluhan' => Keluhan::find($keluhan_id),
        ];

        return view('manipulasi_tanggapan', $data);
    }

    public function buat_tanggapan(Request $req) //validasi tanggapan
    {
        $this->validate($req, [
            'comment' => 'required'
        ], [
            'comment.required' => 'Kolom input tanggapan tidak boleh kosong!'
        ]);
        $tanggapan = new Tanggapan();

        $tanggapan->user_id = auth()->user()->user_id;
        $tanggapan->keluhan_id = $req->keluhan_id;
        $tanggapan->comment = $req->comment;

        $tanggapan->save();

        return redirect('/tanggapan/' . $req->keluhan_id)->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function hapus_tanggapan($tanggapan_id)
    {
        $tanggapan = Tanggapan::find($tanggapan_id);

        $tanggapan->delete();

        return back()->with('info', 'Sukses! Tanggapan anda berhasil dihapus!');
    }

    public function konsultasi_lanjutan()
    {
        $data = [
            'title' => 'Konsultasi Lanjutan',
            'id_page' => 14,
        ];

        return view('konsultasi_lanjutan', $data);
    }

    public function ditanggapi()
    {
        $data = [
            'title' => 'Telah Ditanggapi',
            'id_page' => 15,
            'keluhan' => Keluhan::with('user')->whereHas('tanggapan')->get(),
        ];

        return view('konsultasi', $data);
    }


    public function belum_ditanggapi()
    {
        $data = [
            'title' => 'Belum Ditanggapi',
            'id_page' => 16,
            'keluhan' => Keluhan::with('user')->whereDoesntHave('tanggapan')->get(),
        ];

        return view('konsultasi', $data);
    }

    public function edit_tanggapan($tanggapan_id, $keluhan_id)
    {
        $data = [
            'title' => 'Edit Tanggapan',
            'id_page' => 17,
            'tanggapan' => Tanggapan::find($tanggapan_id),
            'keluhan' => Keluhan::find($keluhan_id),
        ];

        return view('manipulasi_tanggapan', $data);
    }

    public function update_tanggapan(Request $req, $tanggapan_id)
    {
        $tanggapan = Tanggapan::find($tanggapan_id);
        $old_comment = $tanggapan->comment;
    
        $validator = Validator::make($req->all(), [
            'comment' => 'required'
        ], [
            'comment.required' => 'Kolom input tanggapan tidak boleh kosong'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($old_comment != $req->comment) {
            $tanggapan->comment = $req->comment;
            $tanggapan->save();
    
            return redirect('/tanggapan/' . $req->keluhan_id)->with('info', 'Berhasil memperbarui tanggapan!');
        }
    
        return redirect('/tanggapan/' . $req->keluhan_id);
    }

    public function produk()
    {
        $data = [
            'title'     => 'Produk Saya',
            'id_page'   => 18,
            'my_produk' => Produk::where('user_id', auth()->user()->user_id)->get()
        ];

        return view('produk', $data);
    }

    public function create_produk()
    {
        $data = [
            'title'     => 'Tambah Produk',
            'id_page'   => 19
        ];

        return view('manipulasi_produk', $data);
    }

    public function handleCreateProduk(Request $request)
    {
        $produk = new Produk();
        $image = $request->file('image_produk');
        $image_produk = time() . '_' . $image->getClientOriginalName();

        Storage::putFileAs('public/images', $image, $image_produk);

        $produk->user_id  = auth()->user()->user_id;
        $produk->image_produk = $image_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->jenis = $request->jenis;
        $produk->berat = $request->berat;
        $produk->deskripsi = $request->deskripsi;
        $produk->status = $request->status;

        $produk->save();

        return redirect('/produk')->with('success', 'Berhasil Menambah Produk!');
    }

    public function edit_produk($user_id)
    {
        $data = [
            'title'     => 'Edit Produk',
            'id_page'   => 20,
            'produk'    => Produk::find($user_id)
        ];

        return view('manipulasi_produk', $data);
    }

    public function update_produk(Request $request, $produk_id)
    {
        $produk = Produk::find($produk_id);
        $old_img = $produk->image_produk;

        if ($request->hasFile('image_produk') && $request->image_produk == true) {
            $image = $request->file('image_produk');
            $image_produk = time() . '_' . $image->getClientOriginalName();
            Storage::putFileAs('public/images', $image, $image_produk);
            $produk->image_produk = $image_produk;

            if ($old_img != $image_produk) {
                Storage::delete('public/images' . $old_img);
            }
        }

        $produk->user_id  = auth()->user()->user_id;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->jenis = $request->jenis;
        $produk->berat = $request->berat;
        $produk->deskripsi = $request->deskripsi;
        $produk->status = $request->status;

        $produk->save();

        return redirect('/produk')->with('info', 'Berhasil Menyimpan Perubahan!');
    }

    public function hapus_produk($produk_id)
    {
        $produk = Produk::find($produk_id);
        $produk->delete();

        return redirect()->back()->with('warning', 'Berhasil Menghapus Produk!');
    }

    public function detail_toko($user_id)
    {
        $data = [
            'title'     => 'Detail Toko',
            'id_page'   => 21,
            'user'      => User::find($user_id),
            'produk'    => Produk::with('user')->whereHas('user', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->get(),
        ];

        return view('detail_toko', $data);
    }

    public function detail_produk($produk_id)
    {
        $data = [
            'title'     => 'Detail Produk',
            'id_page'   => 22,
            'produk'    => Produk::with('user')->find($produk_id),
            'ulasan'    => Ulasan::where('produk_id', $produk_id)->get(),
            'balasan'   => BalasanUlasan::all(),
        ];

        return view('detail_produk', $data);
    }

    public function kontak_peternak($user_id)
    {
        $data = [
            'title'     => 'Kontak Peternak',
            'id_page'   => 23,
            'user'      => User::find($user_id),
        ];

        return view('kontak_peternak', $data);
    }

    public function keranjang()
    {
        $data = [
            'title'     => 'Keranjang',
            'id_page'   => 24,
            'keranjang' => Keranjang::join('users','user_id','=','toko_id')->where('cust_id', auth()->user()->user_id)->where('status', 'keranjang')->get()->groupBy('toko_id')
        ];

        //return $data;

        return view('keranjang', $data);
    }

    public function create_keranjang(Request $request)
    {
        $count_produk = Keranjang::where('cust_id', '=', auth()->user()->user_id)->where('status', 'keranjang')->count();
        $count_unique = Keranjang::where('cust_id', '=', auth()->user()->user_id)->where('produk_id', $request->produk_id)->where('status', 'keranjang')->count();

        if ($count_unique == 0) {

            if ($count_produk < 5) {
                DB::table('keranjang')->insert([
                    'toko_id'   => $request->toko_id,
                    'produk_id' => $request->produk_id,
                    'cust_id'   => auth()->user()->user_id,
                    'stock'      => $request->stock,
                    'status'    => 'keranjang',
                ]);

                return redirect('/keranjang')->with('success', 'Berhasil menambahkan produk ke keranjang!');
            } else {

                return redirect()->back()->with('warning', 'Keranjang anda sudah penuh');
            }
        }

        // dd($count_unique);

        return redirect()->back()->with('warning', 'Produk ini sudah ada di keranjang anda!');
    }

    public function hapus_keranjang()
    {
        DB::table('keranjang')->where('cust_id', auth()->user()->user_id)->where('status', 'keranjang')->delete();
        return redirect()->back()->with('info', 'Produk berhasil dihapus!');
    }

    public function checkout($kode_transaksi)
    {
        $data = [
            'title'             => 'Checkout',
            'id_page'           => 25,
            'ongkir'            => OngkirDomisili::select(['alamat', 'harga'])->get(),
            // 'detail_produk'    => Keranjang::where('kode_transaksi', $kode_transaksi)->first(),
            'rincian'           => Keranjang::where('kode_transaksi', $kode_transaksi)->get(),
            'detail_transaksi'  => Transaksi::where('kode_transaksi', $kode_transaksi)->first(),
        ];

        return view('checkout', $data);
    }

    public function create_checkout(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $sum_stok = DB::table('keranjang')
            ->where('cust_id', auth()->user()->user_id)
            ->where('status', 'keranjang')
            ->sum('stock');

        $sum_harga = DB::table('keranjang')
            ->join('produk', 'keranjang.produk_id', '=', 'produk.produk_id')
            ->where('keranjang.cust_id', auth()->user()->user_id)
            ->where('keranjang.status', 'keranjang')
            ->sum('harga');

        DB::table('transaksi')->insert([
            'user_id'       => auth()->user()->user_id,
            'kode_transaksi' => 'SLMN' . '-' . time(),
            'expiry'        => null,
            'total_harga'   => $sum_stok * $sum_harga,
            'biaya_ongkir'  => null,
            'biaya_admin'   => 5000,
            'status_admin'  => '-',
            'status_pembayaran' => '-',
            'status_pengiriman' => 'Belum diproses',
            'created_at'    => now(),
        ]);

        DB::table('keranjang')->where('kode_transaksi', '=', null)->update(['kode_transaksi' => 'SLMN' . '-' . time()]);
        DB::table('keranjang')->where('status', 'keranjang')->update(['status' => 'checkout']);

        return redirect('/checkout/' . 'SLMN' . '-' . time())->with('Silahkan lanjutkan ke tahap pembayaran!');
    }

    public function update_checkout($kode_transaksi, Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = Keranjang::where('kode_transaksi', '=', $kode_transaksi)->count();
        if ($data == 1 || $data == 2) {
            $range = 1;
        } else if ($data == 3 || $data == 4 || $data == 5) {
            $range = 2;
        }

        $ongkir = $request->ongkir * $range;


        DB::table('transaksi')->where('biaya_ongkir', null)->update(['biaya_ongkir' => $ongkir]);
        DB::table('transaksi')->where('expiry', null)->update(['expiry' => date('y-m-d H:i', strtotime('+24 hours'))]);

        return redirect('/form_bayar/' . $kode_transaksi)->with('success', 'silahkan lakukan pembayaran!');
    }

    public function form_bayar($kode_transaksi)
    {
        $data = [
            'title'         => 'Lanjutkan Pembayaran',
            'id_page'       => 26,
            'rincian'       => Keranjang::where('kode_transaksi', $kode_transaksi)->first(),
            'transaksi'     => Transaksi::where('kode_transaksi', $kode_transaksi)->first(),
            'kontak_admin'  => User::where('role', 'admin')->value('no_hp')
        ];

        return view('form_bayar', $data);
    }

    public function transaksi()
    {
        $model = new Transaksi();

        if (auth()->user()->role == 'admin') {
            $transaksi = $model->getTransaksiAdmin();
        } else if (auth()->user()->role == 'peternak') {
            $transaksi = $model->getTransaksiPeternak();
        } else if (auth()->user()->role == 'pelanggan') {
            $transaksi = $model->getTransaksiPelanggan();
        }

        $data = [
            'title'         => 'Transaksi',
            'id_page'       => 27,
            'transactions'  => $transaksi,
        ];

        return view('transaksi', $data);
    }

    public function update_statusAdmin($kode_transaksi)
    {
        if (isset($_POST['sukses'])) {
            DB::table('transaksi')->where('kode_transaksi', $kode_transaksi)->update(['status_admin' => 'sukses']);
        } elseif (isset($_POST['ditolak'])) {
            DB::table('transaksi')->where('kode_transaksi', $kode_transaksi)->update(['status_admin' => 'ditolak']);
        } elseif (isset($_POST['gagal'])) {
            DB::table('transaksi')->where('kode_transaksi', $kode_transaksi)->update(['status_admin' => 'gagal']);
        }

        return redirect()->back();
    }
    public function update_statusPembayaran($kode_transaksi, $toko_id)
    {
        if (isset($_POST['sukses'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pembayaran' => 'sukses']);
        } elseif (isset($_POST['ditolak'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pembayaran' => 'ditolak']);
        } elseif (isset($_POST['gagal'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pembayaran' => 'gagal']);
        }

        return redirect()->back();
    }
    public function update_statusPengiriman($kode_transaksi, $toko_id)
    {
        if (isset($_POST['belum diproses'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pengiriman' => 'belum diproses']);
        } elseif (isset($_POST['diproses'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pengiriman' => 'diproses']);
        } elseif (isset($_POST['selesai'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pengiriman' => 'selesai']);
        } elseif (isset($_POST['gagal'])) {
            DB::table('transaksi')->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')->where('transaksi.kode_transaksi', $kode_transaksi)->where('keranjang.toko_id', '=', $toko_id)->update(['status_pengiriman' => 'gagal']);
        }

        return redirect()->back();
    }

    public function ulasan($produk_id)
    {
        $data = [
            'title' => 'Buat ulasan untuk produk ini',
            'id_page' => 28,
            'produk' => Produk::find($produk_id)
        ];

        return view('ulasan', $data);
    }

    public function create_ulasan(Request $request)
    {
        DB::table('ulasan')->insert([
            'user_id'      => auth()->user()->user_id,
            'produk_id'    => $request->produk_id,
            'deskripsi'    => $request->deskripsi,
            'rating'       => $request->rating,
        ]);

        return redirect('/detail_produk/' . $request->produk_id)->with('success', 'Berhasil menambahkan ulasan');
    }

    public function hapus_ulasan($ulasan_id)
    {
        $ulasan = Ulasan::find($ulasan_id);
        $ulasan->delete();

        return back()->with('info', 'Berhasil menghapus ulasan');
    }

    public function balas_ulasan($ulasan_id)
    {
        $data = [
            'title' => 'Balas Ulasan',
            'id_page' => 29,
            'ulasan'    => Ulasan::find($ulasan_id)
        ];

        return view('balas_ulasan', $data);
    }

    public function edit_balas_ulasan($ulasan_id, $balasan_id)
    {
        $data = [
            'title' => 'Edit Ulasan',
            'id_page' => 30,
            'ulasan'    => Ulasan::find($ulasan_id),
            'balas_ulasan'    => BalasanUlasan::find($balasan_id)
        ];

        return view('balas_ulasan', $data);
    }

    public function update_balas_ulasan($balasan_id, Request $request)
    {
        DB::table('balasan_ulasan')->where('balasan_id', '=', $balasan_id)->update(['deskripsi' => $request->deskripsi]);

        return redirect('/detail_produk/' . $request->produk_id)->with('success', 'Berhasil mengubah balasan ulasan');
    }

    public function create_balas_ulasan(Request $request)
    {
        DB::table('balasan_ulasan')->insert([
            'ulasan_id'     => $request->ulasan_id,
            'deskripsi'     => $request->deskripsi
        ]);
        return redirect('/detail_produk/' . $request->produk_id)->with('success', 'Berhasil membuat balasan ulasan');
    }

    public function hapus_balas_ulasan($balasan_id)
    {
        $balasan = BalasanUlasan::find($balasan_id);
        $balasan->delete();

        return redirect()->back()->with('info', 'Berhasil menghapus balasan ulasan');
    }

    public function detail_transaksi($kode_transaksi)
    {
        $data = [
            'title'             => $kode_transaksi,
            'id_page'           => 31,
            'rincian'           => Keranjang::where('kode_transaksi', $kode_transaksi)->get(),
            'detail_transaksi'  => Transaksi::where('kode_transaksi', $kode_transaksi)->first(),
        ];

        return view('detail_transaksi', $data);
    }

    public function rekap_transaksi()
    {
        $sum_harga = DB::table('keranjang')
            ->join('transaksi', 'keranjang.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->where('keranjang.toko_id', auth()->user()->user_id)
            ->where('keranjang.status', 'checkout')
            ->sum('transaksi.total_harga');

        $transaksi = new Transaksi();
        $data = [
            'title'     => 'Rekap Transaksi',
            'id_page'   => 32,
            'rekap'     => $transaksi->getRekapPeternak(),
            'total'     => $sum_harga
        ];

        return view('rekap_transaksi', $data);
    }

    public function rekap_penilaian($produk_id) 
    {
        $data = [
            'title'     => 'Rekap Penilaian',
            'id_page'   => 33,
            'ulasan'    => Ulasan::where('produk_id', $produk_id)->get()
        ];

        return view('penilaian', $data);
    }

    public function rekap_produk()
    {
        $sum_produk = DB::table('keranjang')
            ->join('transaksi', 'keranjang.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->where('keranjang.toko_id', auth()->user()->user_id)
            ->where('keranjang.status', 'checkout')
            ->sum('keranjang.stock');

        $produk = new Produk();
        $data = [
            'title'     => 'Rekap Produk',
            'id_page'   => 22,
            'rekap'     => $produk->getRekapPeternak(),
            'total'     => $sum_produk
        ];

        return view('rekap_produk', $data);
    }

    
}
