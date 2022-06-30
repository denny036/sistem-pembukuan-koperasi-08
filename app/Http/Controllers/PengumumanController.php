<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Pengumuman = new Pengumuman();
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
            'pengumuman' => $this->Pengumuman->seeData(),
            'jmPengumuman' => Pengumuman::count(),
        ];

        return view('Admin.Pengumuman.Pengumuman', $data);
    }

    public function v_tambahPengumuman(){
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
        ];

        return view('Admin.Pengumuman.Halaman_TambahPengumuman', $data);
    }

    public function addData(){
        Request()->validate([
            'judul' => 'required|min:5|max:220',
            'isi' => 'required|min:20'
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 5 characters',
            'judul.max' => 'Maximal 220 characters',
            'isi.required' => 'Harus di isi',
            'isi.min' => 'Minimal 20 characters',
        ]);

        $data = [
            'judul' => Request()->judul,
            'isi' => Request()->isi,
        ];

        $this->Pengumuman->addData($data);

        return redirect()->route('pengumuman')->with('success', 'Berhasil menambahkan pengumuman');
    }

    public function v_editPengumuman($id){
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
            'pengumuman' => $this->Pengumuman->updateData($id),
        ];

        return view('Admin.Pengumuman.Halaman_EditPengumuman', $data);
    }

    public function updateDataPengumuman(){
        $pengumuman = Pengumuman::find(Request()->id);

        if(Request()->judul == $pengumuman->judul &&
        Request()->isi == $pengumuman->isi){
            return redirect()->back()->with('info', 'Tidak ada data yang berubah');
        }

        Request()->validate([
            'judul' => 'required|min:5|max:220',
            'isi' => 'required|min:20',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 5 characters',
            'judul.max' => 'Maximal 220 characters',
            'isi.required' => 'Harus di isi',
            'isi.min' => 'Minimal 20 characters',
        ]);

        $pengumuman->judul = Request()->judul;
        $pengumuman->isi = Request()->isi;
        $pengumuman->save();

        return redirect()->route('pengumuman')->with('success', 'Berhasil edit pengumuman');
    }

    public function deleteBerita(){
        $this->Pengumuman->deleteData(Request()->id);

        return redirect()->back()->with('success', 'Berhasil hapus pengumuman');
    }
}
