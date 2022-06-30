<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kategori;

class BeritaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Berita = new Berita();
        $this->Kategori = new Kategori();
        $this->User = new User();
    }

    public function index(){
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id',  Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
            'berita' => $this->Berita->seeData(),
            'jmBerita' => Berita::count(),
            'user' => $this->User->seeData(),
        ];

        return view('Admin.Berita.Berita', $data);
    }

    public function v_tambahBerita(){
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id',  Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
            'kategori' => $this->Kategori->seeData(),
        ];

        return view('Admin.Berita.Halaman_TambahBerita', $data);
    }

    public function addData(){
        Request()->validate([
            'judul' => 'required|min:6|max:220',
            'headline' => 'required|min:20',
            'kategori_id' => 'required|not_in:0',
            'isi' => 'required|min:20',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 20 characters',
            'judul.max' => 'Maximal 220 characters',
            'headline.required' => 'Harus di isi',
            'headline.min' => 'Minimal 20 characters',
            'kategori_id.required' => 'Harus di isi',
            'kategori_id.not_in' => 'Harus dipilih',
            'isi.required' => 'Harus di isi',
            'isi.min' => 'Minimal 20 characters',
            'gambar.required' => 'Harus Di Isi',
            'gambar.file' => 'Anda Hanya Dapat Upload File',
            'gambar.image' => 'Anda Hanya Dapat Upload Image',
            'gambar.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar.max' => 'Berukuran MAX 2MB',
        ]);

        $file = Request()->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'Gambar/Berita';
        $file->move($tujuan_upload,$nama_file);

        $data = [
            'judul' => Request()->judul,
            'kategori_id' => Request()->kategori_id,
            'headline' => Request()->headline,
            'isi' => Request()->isi,
            'gambar' => $nama_file,
        ];

        $this->Berita->addData($data);

        return redirect()->route('berita')->with('success','Berhasil menambahkan Berita');
    }

    public function v_editKategori($id){
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id',  Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
            'berita' => $this->Berita->updateData($id),
            'kategori' => $this->Kategori->seeData(),
        ];

        return view('Admin.Berita.Halaman_EditBerita', $data);
    }

    public function updateDataBerita(){
        $berita = Berita::find(Request()->id);

        if(Request()->judul == $berita->judul &&
        Request()->kategori_id == $berita->kategori_id &&
        Request()->headline == $berita->headline &&
        Request()->isi == $berita->isi){
            return redirect()->back()->with('info','Tidak ada data yang berubah');
        }

        Request()->validate([
            'judul' => 'required|min:6|max:220',
            'headline' => 'required|min:20',
            'isi' => 'required|min:20',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 6 characters',
            'judul.max' => 'Maximal 220 characters',
            'headline.required' => 'Harus di isi',
            'headline.min' => 'Minimal 20 characters',
            'isi.required' => 'Harus di isi',
            'isi.min' => 'Minimal 20 characters',
        ]);

        $berita->judul = Request()->judul;
        $berita->kategori_id = Request()->kategori_id;
        $berita->headline = Request()->headline;
        $berita->isi = Request()->isi;
        $berita->save();

        return redirect()->route('berita')->with('success','Berhasil edit data berita');
    }

    public function updateGambarBerita(){
        $berita = Berita::find(Request()->id);

        if(Request()->gambar == null){
            return redirect()->back()->with('info','Tidak ada data yang berubah');
        }

        Request()->validate([
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'gambar.required' => 'Gambar Harus Di Isi',
            'gambar.file' => 'Anda Hanya Dapat Upload File',
            'gambar.image' => 'Anda Hanya Dapat Upload Image',
            'gambar.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar.max' => 'Gambar Berukuran MAX 2MB',
        ]);

        $gambar_awal = $berita->gambar;
        $pi = [
            'gambar' => $gambar_awal,
        ];
        Request()->gambar->move(public_path() . '/Gambar/Berita', $gambar_awal);
        $berita->update($pi);

        return redirect()->route('berita')->with('success','Berhasil ubah Gambar');
    }

    public function deleteBerita(){
        $this->Berita->deleteData(Request()->id);

        return redirect()->route('berita')->with('success','Berhasil hapus Berita');
    }
}
