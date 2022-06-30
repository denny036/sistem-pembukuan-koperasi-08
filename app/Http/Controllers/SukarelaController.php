<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Setoran;
use App\Models\Sukarela;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SukarelaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Setoran = new Setoran();
        $this->User = new User();
        $this->Sukarela = new Sukarela();
        $this->Bulan = new Bulan();
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
                'setoran' => $this->Setoran->seeData(3),
                'jumlahData' => Setoran::where('simpanan_id', '3')->count(),
            ];
        }else{
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'setoran' => $this->Setoran->seeDataInID(3, Auth::user()->id),
                'jumlahData' => Setoran::where('simpanan_id', '3')->where('user_id', Auth::user()->id)->count(),
            ];
        }

        return view('Admin.spm_sukarela.SPM_Sukarela', $data);
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
            'bulan' => $this->Bulan->seeData(),
        ];

        return view('Admin.spm_sukarela.Halaman_TambahSPMSukarela', $data);
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
            'setoran' => $this->Setoran->updateData(3, $id),
            'user' => $this->User->seeDataAnggota(),
            'bulan' => $this->Bulan->seeData(),
        ];

        return view('Admin.spm_sukarela.Halaman_EditSPMSukarela', $data);
    }

    public function print(){
        $data = [
            'setoran' => $this->Setoran->seeData(3),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->groupBy("simpanan_id")
            ->havingRaw('simpanan_id = 3')
            ->get(),
        ];

        return view('Admin.spm_sukarela.Print_SPMSukarela', $data);
    }

    public function printSukarelaInID(){
        $data = [
            'setoran' => $this->Setoran->seeDataInID(3, Auth::user()->id),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->where('simpanan_id',  3)
            ->where('user_id', Auth::user()->id)
            ->groupBy("simpanan_id")
            ->get(),
        ];

        return view('Anggota.Simpanan.PrintSukarela', $data);
    }
}
