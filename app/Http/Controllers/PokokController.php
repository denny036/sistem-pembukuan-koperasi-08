<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Setoran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PokokController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Setoran = new Setoran();
        $this->User = new User();
        $this->Pokok = new Pokok();
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

        if(Auth::user()->role == 'admin'){
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'setoran' => $this->Setoran->seeData(2),
                'jumlahData' => Setoran::where('simpanan_id', '2')->count(),
            ];
        }else{
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'setoran' => $this->Setoran->seeDataInID(2, Auth::user()->id),
                'jumlahData' => Setoran::where('simpanan_id', '2')->where('user_id', Auth::user()->id)->count(),
            ];
        }
        return view('Admin.spm_pokok.SPM_Pokok', $data);
    }

    public function v_tambahSPMWajib(){
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
            'user' => $this->User->seeDataAnggota(),
        ];

        return view('Admin.spm_pokok.Halaman_TambahSPMPokok', $data);
    }

    public function v_editSPMPokok($id){
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
            'setoran' => $this->Setoran->updateData(2, $id),
            'user' => $this->User->seeDataAnggota(),
        ];

        return view('Admin.spm_pokok.Halaman_EditSPMPokok', $data);
    }

    public function print(){
        $data = [
            'setoran' => $this->Setoran->seeData(2),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->groupBy("simpanan_id")
            ->havingRaw('simpanan_id = 2')
            ->get(),
        ];

        return view('Admin.spm_pokok.Print_SPMPokok', $data);
    }

    public function printPokokInID(){
        $data = [
            'setoran' => $this->Setoran->seeDataInID(2, Auth::user()->id),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->where('simpanan_id',  2)
            ->where('user_id', Auth::user()->id)
            ->groupBy("simpanan_id")
            ->get(),
        ];

        return view('Anggota.Simpanan.PrintPokok', $data);
    }
}
