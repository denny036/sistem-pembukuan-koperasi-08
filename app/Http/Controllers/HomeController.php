<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pembayaran;
use Carbon\Carbon;
use App\Models\Pinjaman;
use App\Models\Setoran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->Anggota = new Anggota();
        $this->Setoran = new Setoran();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id',  $id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = $this->Anggota->periksa($id);
        foreach ($data as $da) {
            if ($da == '') {
            } else {
                if(Auth::user()->role == 'admin'){
                    $tanggal = [
                        'date' => Carbon::now()->toDateTimeString(),
                        'utang' => $utang,
                        'totalWajib' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  1)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalPokok' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  2)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalSukarela' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  3)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalPinjaman' => Pinjaman::select(DB::raw('SUM(besar_pinjaman) as total'))
                            ->get(),
                        'totalBayar' => Pembayaran::select(DB::raw('SUM(jumlah) as total'))
                            ->get(),
                    ];
                }else{
                    $tanggal = [
                        'date' => Carbon::now()->toDateTimeString(),
                        'utang' => $utang,
                        'totalWajib' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  1)
                            ->where('user_id', Auth::user()->id)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalPokok' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  2)
                            ->where('user_id', Auth::user()->id)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalSukarela' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
                            ->where('simpanan_id',  3)
                            ->where('user_id', Auth::user()->id)
                            ->groupBy("simpanan_id")
                            ->get(),
                        'totalPinjaman' => Pinjaman::select(DB::raw('SUM(besar_pinjaman) as total'))
                            ->where('user_id', Auth::user()->id)
                            ->get(),
                        'totalBayar' => Pembayaran::select(DB::raw('SUM(jumlah) as total'))
                            ->where('user_id', Auth::user()->id)
                            ->groupBy("user_id")
                            ->get(),
                        'contoh' => $this->Setoran->contoh(),
                    ];
                }


                return view('Dashboard', $tanggal);
            }
        }

        $sim = [
            'user_id' => $id,
            'name' => $name,
        ];

        $this->Anggota->simAwal($sim);

        return view('Dashboard');
    }
}
