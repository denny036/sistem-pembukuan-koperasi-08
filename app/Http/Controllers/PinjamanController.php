<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PinjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Pinjaman = new Pinjaman();
        $this->User = new User();
    }

    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id', Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'pinjaman' => $this->Pinjaman->seeData(),
            'jumlahData' => Pinjaman::count(),
            'utang' => $utang,
            'date' => Carbon::now()->toDateTimeString(),
        ];
        return view('Pinjaman.Pinjaman', $data);
    }

    public function indexInID()
    {
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id', Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'pinjaman' => $this->Pinjaman->seeDataInID(Auth::user()->id),
            'jumlahData' => Pinjaman::where('user_id', Auth::user()->id)->count(),
            'utang' => $utang,
            'date' => Carbon::now()->toDateTimeString(),
        ];
        return view('Anggota.Pinjaman.Pinjam', $data);
    }

    public function IndexInPay()
    {
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id', Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }


        if (Auth::user()->role == 'admin') {
            $data = [
                'pinjaman' => $this->Pinjaman->seeDataInPay(),
                'jumlahData' => Pinjaman::count(),
                'utang' => $utang,
                'date' => Carbon::now()->toDateTimeString(),
            ];
        } else {
            $data = [
                'pinjaman' => $this->Pinjaman->seeDataInPayID(Auth::user()->id),
                'jumlahData' => Pinjaman::where('user_id', Auth::user()->id)->count(),
                'utang' => $utang,
                'date' => Carbon::now()->toDateTimeString(),
            ];
        }

        return view('Pembayaran.DfPinjaman', $data);
    }

    public function v_tambahPinjaman()
    {
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id', Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'user' => $this->User->seeDataAnggota(),
            'utang' => $utang,
            'date' => Carbon::now()->toDateTimeString(),
        ];

        return view('Pinjaman.Halaman_TambahPinjaman', $data);
    }

    public function addData()
    {
        Request()->validate([
            'user_id' => 'required|not_in:0',
            'besar_pinjaman' => 'required',
            'tgl_pinjaman' => 'required',
            'tgl_pelunasan' => 'required',
            'fileBukti' => 'required',
        ], [
            'user_id.required' => 'Harus di isi',
            'user_id.not_in' => 'Harus di isi',
            'besar_pinjaman.required' => 'Harus di isi',
            'tgl_pinjaman.required' => 'Harus di isi',
            'tgl_pelunasan.required' => 'Harus di isi',
            'fileBukti.required' => 'Harus di isi'
        ]);

        $file = Request()->file('fileBukti');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'Pinjaman/Bukti Pinjam';
        $file->move($tujuan_upload, $nama_file);

        $data = [
            'user_id' => Request()->user_id,
            'besar_pinjaman' => Request()->besar_pinjaman,
            'tgl_pinjaman' => Request()->tgl_pinjaman,
            'tgl_pelunasan' => Request()->tgl_pelunasan,
            'fileBukti' => $nama_file,
        ];

        $this->Pinjaman->addData($data);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('pinjaman')->with('success', 'Berhasil menambah data');
        } else {
            return redirect()->route('AgPinjam')->with('success', 'Berhasil menambah data');
        }
    }

    public function v_editPinjaman($id)
    {
        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id', Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        $data = [
            'pinjaman' => $this->Pinjaman->updatedata($id),
            'user' => $this->User->seeDataAnggota(),
            'utang' => $utang,
            'date' => Carbon::now()->toDateTimeString(),
        ];

        return view('Pinjaman.Halaman_EditPinjaman', $data);
    }

    public function updateData()
    {
        $pinjaman = Pinjaman::find(Request()->id);

        if (
            $pinjaman->user_id == Request()->user_id &&
            $pinjaman->besar_pinjaman == Request()->besar_pinjaman &&
            $pinjaman->tgl_pinjaman == Request()->tgl_pinjaman &&
            $pinjaman->tgl_pelunasan == Request()->tgl_pelunasan
        ) {
            return redirect()->back()->with('info', 'Tidak ada data yang berubah');
        }

        Request()->validate([
            'user_id' => 'required|not_in:0',
            'besar_pinjaman' => 'required',
            'tgl_pinjaman' => 'required',
            'tgl_pelunasan' => 'required',
        ], [
            'user_id.required' => 'Harus di isi',
            'user_id.not_in' => 'Harus di isi',
            'besar_pinjaman.required' => 'Harus di isi',
            'tgl_pinjaman.required' => 'Harus di isi',
            'tgl_pelunasan.required' => 'Harus di isi',
        ]);

        $pinjaman->user_id = Request()->user_id;
        $pinjaman->besar_pinjaman = Request()->besar_pinjaman;
        $pinjaman->tgl_pinjaman = Request()->tgl_pinjaman;
        $pinjaman->tgl_pelunasan = Request()->tgl_pelunasan;
        $pinjaman->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('pinjaman')->with('success', 'Berhasil edit data');
        } else {
            return redirect()->route('AgPinjam')->with('success', 'Berhasil edit data');
        }
    }

    public function updateFile()
    {
        $pinjaman = Pinjaman::find(Request()->id);

        if (Request()->fileBukti == null) {
            return redirect()->back()->with('info', 'Tidak ada gambar yang dimasukkan');
        }

        Request()->validate([
            'fileBukti' => 'required',
        ], [
            'fileBukti.required' => 'Harus di isi'
        ]);

        $file_awal = $pinjaman->fileBukti;
        $pi = [
            'fileBukti' => $file_awal,
        ];
        Request()->fileBukti->move(public_path() . '/Pinjaman/Bukti Pinjam', $file_awal);
        $pinjaman->update($pi);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('pinjaman')->with('success', 'Berhasil edit file');
        } else {
            return redirect()->route('AgPinjam')->with('success', 'Berhasil edit file');
        }
    }

    public function deleteData()
    {
        $this->Pinjaman->deleteData(Request()->id);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('pinjaman')->with('success', 'Berhasil hapus data');
        } else {
            return redirect()->route('AgPinjam')->with('success', 'Berhasil hapus data');
        }
    }

    public function print()
    {
        $data = [
            'pinjaman' => $this->Pinjaman->seeData(),
            'total' => Pinjaman::select(DB::raw('SUM(besar_pinjaman) as total'))
                ->get(),
        ];

        return view('Pinjaman.Print_Pinjaman', $data);
    }

    public function printInID()
    {
        $data = [
            'pinjaman' => $this->Pinjaman->seeDataInID(Auth::user()->id),
            'total' => Pinjaman::select(DB::raw('SUM(besar_pinjaman) as total'))
                ->where('user_id', Auth::user()->id)
                ->get(),
        ];

        return view('Anggota.Pinjaman.Print', $data);
    }

    public function download($file)
    {
        return response()->download(public_path('Pinjaman/Bukti Pinjam/' . $file));
    }
}
