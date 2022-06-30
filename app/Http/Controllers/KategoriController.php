<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Kategori = new Kategori();
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
            'kategori' => $this->Kategori->seeData(),
            'jmData' => Kategori::count(),
        ];

        return view('Admin.Kategori.Kategori', $data);
    }

    public function addData(){
        Request()->validate([
            'kategori' => 'required|unique:kategori|min:4|max:220',
        ],[
            'kategori.required' => 'Harus di isi',
            'kategori.unique' => 'Sudah digunakan',
            'kategori.min' => 'Minimal 4 characters',
            'kategori.max' => 'Maximal 220 characters',
        ]);

        $data = [
            'kategori' => Request()->kategori,
        ];

        $this->Kategori->addData($data);

        return redirect()->back()->with('success', 'Berhasil Menambahakan Kategori');
    }

    public function updateKategori(){
        $kategori = Kategori::find(Request()->id);

        if(Request()->kategori == $kategori->kategori){
            return redirect()->back()->with('info', 'Tidak ada data yang diubah');
        }

        Request()->validate([
            'kategori' => 'required|unique:kategori|min:4|max:220',
        ],[
            'kategori.required' => 'Harus di isi',
            'kategori.unique' => 'Sudah digunakan',
            'kategori.min' => 'Minimal 4 characters',
            'kategori.max' => 'Maximal 220 characters',
        ]);

        $kategori->kategori = Request()->kategori;
        $kategori->save();

        return redirect()->back()->with('success', 'Berhasil edit kategori');
    }

    public function deleteKategori(){
        $this->Kategori->deleteKategori(Request()->id);

        return redirect()->back()->with('success', 'Berhasil Hapus Kategori');
    }
}
