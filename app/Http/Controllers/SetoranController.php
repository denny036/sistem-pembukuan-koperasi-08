<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Setoran;
use App\Models\Simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Setoran = new Setoran();
        $this->User = new User();
        $this->Bulan = new Bulan();
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
            $utang = DB::table('pinjaman')->where('user_id',  Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        if(Auth::user()->role == 'admin'){
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'setoran' => $this->Setoran->seeData(1),
                'jumlahData' => Setoran::where('simpanan_id', '1')->count(),
            ];
        }else{
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'setoran' => $this->Setoran->seeDataInID(1, Auth::user()->id),
                'jumlahData' => Setoran::where('simpanan_id', '1')->where('user_id', Auth::user()->id)->count(),
            ];
        }

        return view('Admin.spm_wajib.SPM_Wajib', $data);
    }

    public function v_tambahSPMWajib()
    {
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

        return view('Admin.spm_wajib.Halaman_TambahSPMWajib', $data);
    }

    public function addData()
    {
        if (Request()->key_simpanan == 2) {
            Request()->validate([
                'user_id' => 'required|not_in:0',
                'jumlah_setoran' => 'required',
                'gambar_setoran' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            ], [
                'user_id.required' => 'Harus di isi',
                'user_id.not_in' => 'Harus di isi',
                'jumlah_setoran.required' => 'Harus di isi',
                'gambar_setoran.required' => 'Harus Di Isi',
                'gambar_setoran.file' => 'Anda Hanya Dapat Upload File',
                'gambar_setoran.image' => 'Anda Hanya Dapat Upload Image',
                'gambar_setoran.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
                'gambar_setoran.max' => 'Berukuran MAX 2MB',
            ]);
        } else {
            Request()->validate([
                'user_id' => 'required|not_in:0',
                'jumlah_setoran' => 'required',
                'tahun' => 'required',
                'setoran_untukBulan' => 'required',
                'gambar_setoran' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            ], [
                'user_id.required' => 'Harus di isi',
                'user_id.not_in' => 'Harus di isi',
                'jumlah_setoran.required' => 'Harus di isi',
                'setoran_untukBulan.required' => 'Harus di isi',
                'tahun.required' => 'Harus di isi',
                'gambar_setoran.required' => 'Harus Di Isi',
                'gambar_setoran.file' => 'Anda Hanya Dapat Upload File',
                'gambar_setoran.image' => 'Anda Hanya Dapat Upload Image',
                'gambar_setoran.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
                'gambar_setoran.max' => 'Berukuran MAX 2MB',
            ]);
        }

        $file = Request()->file('gambar_setoran');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'Gambar/Admin/Simpanan Wajib';
        $file->move($tujuan_upload, $nama_file);

        $simpanan = Simpanan::find(Request()->key_simpanan);

        if (Request()->jumlah_setoran >= $simpanan->total) {
            $status = "Lunas";
        } else {
            $status = "Belum Lunas";
        }

        if (Request()->key_simpanan == 2) {
            $data = [
                'simpanan_id' => Request()->key_simpanan,
                'user_id' => Request()->user_id,
                'jumlah_setoran' => Request()->jumlah_setoran,
                'status' => $status,
                'setoran_untukBulan' => "-",
                'tahun' => "-",
                'gambar_setoran' => $nama_file,
            ];
        } else {
            $data = [
                'simpanan_id' => Request()->key_simpanan,
                'user_id' => Request()->user_id,
                'jumlah_setoran' => Request()->jumlah_setoran,
                'status' => $status,
                'setoran_untukBulan' => Request()->setoran_untukBulan,
                'tahun' => Request()->tahun,
                'gambar_setoran' => $nama_file,
            ];
        }

        $this->Setoran->addData($data);

        if (Request()->key_simpanan == 1) {
            return redirect()->route('simpanan_wajib')->with('success', 'Berhasil Menambahkan Simpanan');
        } else if (Request()->key_simpanan == 2) {
            return redirect()->route('simpanan_pokok')->with('success', 'Berhasil Menambahkan Simpanan');
        } else if (Request()->key_simpanan == 3) {
            return redirect()->route('simpanan_sukarela')->with('success', 'Berhasil Menambahkan Simpanan');
        }
    }

    public function v_editSPMWajib($id)
    {
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
            'setoran' => $this->Setoran->updateData(1, $id),
            'user' => $this->User->seeDataAnggota(),
            'bulan' => $this->Bulan->seeData(),
        ];

        return view('Admin.spm_wajib.Halaman_EditSPMWajib', $data);
    }

    public function updateData()
    {
        $setoran = Setoran::find(Request()->id);

        if (Request()->key_simpanan == 2) {
            if (
                Request()->user_id == $setoran->user_id &&
                Request()->jumlah_setoran == $setoran->jumlah_setoran
            ) {
                return redirect()->back()->with('info', 'Tidak ada data yang berubah');
            }

            Request()->validate([
                'user_id' => 'required|not_in:0',
                'jumlah_setoran' => 'required',
            ], [
                'user_id.required' => 'Harus di isi',
                'user_id.not_in' => 'Harus di isi',
                'jumlah_setoran.required' => 'Harus di isi',
            ]);
        } else {
            if (
                Request()->user_id == $setoran->user_id &&
                Request()->tahun == $setoran->tahun &&
                Request()->jumlah_setoran == $setoran->jumlah_setoran &&
                Request()->setoran_untukBulan == $setoran->setoran_untukBulan
            ) {
                return redirect()->back()->with('info', 'Tidak ada data yang berubah');
            }

            Request()->validate([
                'user_id' => 'required|not_in:0',
                'jumlah_setoran' => 'required',
                'tahun' => 'required',
                'setoran_untukBulan' => 'required',
            ], [
                'user_id.required' => 'Harus di isi',
                'user_id.not_in' => 'Harus di isi',
                'jumlah_setoran.required' => 'Harus di isi',
                'setoran_untukBulan.required' => 'Harus di isi',
                'tahun.required' => 'Harus di isi',
            ]);
        }

        $simpanan = Simpanan::find(1);

        if (Request()->jumlah_setoran >= $simpanan->total) {
            $status = "Lunas";
        } else {
            $status = "Belum Lunas";
        }

        if (Request()->key_simpanan == 2) {
            $setoran->user_id = Request()->user_id;
            $setoran->status = $status;
            $setoran->jumlah_setoran = Request()->jumlah_setoran;
        } else {
            $setoran->user_id = Request()->user_id;
            $setoran->status = $status;
            $setoran->tahun = Request()->tahun;
            $setoran->jumlah_setoran = Request()->jumlah_setoran;
            $setoran->setoran_untukBulan = Request()->setoran_untukBulan;
        }

        $setoran->save();

        if (Request()->key_simpanan == 1) {
            return redirect()->route('simpanan_wajib')->with('success', 'Berhasil Mengedit Simpanan');
        } else if (Request()->key_simpanan == 2) {
            return redirect()->route('simpanan_pokok')->with('success', 'Berhasil Mengedit Simpanan');
        } else if (Request()->key_simpanan == 3) {
            return redirect()->route('simpanan_sukarela')->with('success', 'Berhasil Mengedit Simpanan');
        }
    }

    public function updateGambar()
    {
        $setoran = Setoran::find(Request()->id);

        if (Request()->gambar_setoran == null) {
            return redirect()->back()->with('info', 'Tidak ada gambar yang dimasukkan');
        }

        Request()->validate([
            'gambar_setoran' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'gambar_setoran.required' => 'Harus Di Isi',
            'gambar_setoran.file' => 'Anda Hanya Dapat Upload File',
            'gambar_setoran.image' => 'Anda Hanya Dapat Upload Image',
            'gambar_setoran.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar_setoran.max' => 'Berukuran MAX 2MB',
        ]);

        $gambar_awal = $setoran->gambar_setoran;
        $pi = [
            'gambar_setoran' => $gambar_awal,
        ];
        Request()->gambar_setoran->move(public_path() . '/Gambar/Admin/Simpanan Wajib', $gambar_awal);
        $setoran->update($pi);

        if (Request()->key_simpanan == 1) {
            return redirect()->route('simpanan_wajib')->with('success', 'Berhasil edit gambar');
        } else if (Request()->key_simpanan == 2) {
            return redirect()->route('simpanan_pokok')->with('success', 'Berhasil edit gambar');
        } else if (Request()->key_simpanan == 3) {
            return redirect()->route('simpanan_sukarela')->with('success', 'Berhasil edit gambar');
        }
    }

    public function deleteData()
    {
        $this->Setoran->deleteData(Request()->id);

        if (Request()->key_simpanan == 1) {
            return redirect()->route('simpanan_wajib')->with('success', 'Berhasil Hapus data');
        } else if (Request()->key_simpanan == 2) {
            return redirect()->route('simpanan_pokok')->with('success', 'Berhasil Hapus data');
        } else if (Request()->key_simpanan == 3) {
            return redirect()->route('simpanan_sukarela')->with('success', 'Berhasil Hapus data');
        }
    }

    public function print(){
        $data = [
            'setoran' => $this->Setoran->seeData(1),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->groupBy("simpanan_id")
            ->havingRaw('simpanan_id = 1')
            ->get(),
        ];

        return view('Admin.spm_wajib.Print_SPMWajib', $data);
    }

    public function printWajibInID(){
        $data = [
            'setoran' => $this->Setoran->seeDataInID(1, Auth::user()->id),
            'total' => Setoran::select(DB::raw('SUM(jumlah_setoran) as total'))
            ->where('simpanan_id',  1)
            ->where('user_id', Auth::user()->id)
            ->groupBy("simpanan_id")
            ->get(),
        ];

        return view('Anggota.Simpanan.PrintWajib', $data);
    }
}
