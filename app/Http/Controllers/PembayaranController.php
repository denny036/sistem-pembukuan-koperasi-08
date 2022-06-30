<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pinjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Pembayaran = new Pembayaran();
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

        $data = [
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
            'pembayaran' => $this->Pembayaran->seeDataInIdPinjaman(Request()->id, Request()->user_id),
            'user_id' => Request()->user_id,
            'pinjaman_id' => Request()->id,
            'user_name' => User::find(Request()->user_id),
        ];

        return view('Pembayaran.Pembayaran', $data);
    }

    public function indexPembayaran()
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

        if (Auth::user()->role == 'admin') {
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'pembayaran' => $this->Pembayaran->seeData()
            ];
        } else {
            $data = [
                'date' => Carbon::now()->toDateTimeString(),
                'utang' => $utang,
                'pembayaran' => $this->Pembayaran->seeDataInId(Auth::user()->id),
            ];
        }

        return view('Pembayaran.AllPembayaran', $data);
    }

    public function v_tambahPembayaran()
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
            'user_id' => Request()->user_id,
            'pinjaman_id' => Request()->pinjaman_id,
            'user_name' => User::find(Request()->user_id),
        ];

        return view('Pembayaran.Halaman_tmPembayaran', $data);
    }

    public function addData()
    {
        $pinjaman = Pinjaman::find(Request()->pinjaman_id);
        if ($pinjaman->status == "Belum Lunas") {
            Request()->validate([
                'jumlah' => 'required',
                'tgl_bayar' => 'required',
                'gambar_bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            ], [
                'jumlah.required' => 'Harus di isi',
                'tgl_bayar.required' => 'Harus di isi',
                'gambar_bukti.required' => 'Harus Di Isi',
                'gambar_bukti.file' => 'Anda Hanya Dapat Upload File',
                'gambar_bukti.image' => 'Anda Hanya Dapat Upload Image',
                'gambar_bukti.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
                'gambar_bukti.max' => 'Berukuran MAX 2MB',
            ]);

            $file = Request()->file('gambar_bukti');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'Pinjaman/Pembayaran';
            $file->move($tujuan_upload, $nama_file);

            $data = [
                'user_id' => Request()->user_id,
                'pinjaman_id' => Request()->pinjaman_id,
                'jumlah' => Request()->jumlah,
                'tgl_bayar' => Request()->tgl_bayar,
                'gambar_bukti' => $nama_file,
            ];

            $this->Pembayaran->addData($data);

            $total = DB::table('pembayaran')->where('pinjaman_id', Request()->pinjaman_id)->sum('jumlah');
            $jmPinjaman = DB::table('pinjaman')->where('id', Request()->pinjaman_id)->get('besar_pinjaman');


            if ($total >= $jmPinjaman[0]->besar_pinjaman) {
                $pinjaman->status = "Lunas";
                $pinjaman->save();
            }

            return redirect()->route('dfpeminjam')->with('success', 'Berhasil Menambahkan pembayaran');
        }else{
            return redirect()->back()->with('warning', 'Sudah lunas tidak bisa menambah lagi');
        }
    }

    public function deleteData()
    {
        $this->Pembayaran->deleteData(Request()->id);

        return redirect()->route('dfpeminjam')->with('success', 'Berhasil hapus pembayaran');
    }

    public function v_editPembayaran($id)
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
            'pembayaran' => $this->Pembayaran->dataEdit($id),
        ];

        return view('Pembayaran.Halaman_edPembayaran', $data);
    }

    public function updateData()
    {
        $pembayaran = Pembayaran::find(Request()->id);

        if (
            $pembayaran->jumlah == Request()->jumlah &&
            $pembayaran->tgl_bayar == Request()->tgl_bayar
        ) {
            return redirect()->back()->with('info', 'Tidak ada data yang berubah');
        }

        Request()->validate([
            'jumlah' => 'required',
            'tgl_bayar' => 'required',
        ], [
            'jumlah.required' => 'Harus di isi',
            'tgl_bayar.required' => 'Harus di isi',
        ]);

        $pembayaran->jumlah = Request()->jumlah;
        $pembayaran->tgl_bayar = Request()->tgl_bayar;
        $pembayaran->save();

        return redirect()->route('dfpeminjam')->with('success', 'Berhasil edit pembayaran');
    }

    public function updateGambar()
    {
        $pembayaran = Pembayaran::find(Request()->id);

        if (Request()->gambar_bukti == null) {
            return redirect()->back()->with('info', 'Tidak ada gambar yang dimasukkan');
        }

        Request()->validate([
            'gambar_bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'gambar_bukti.required' => 'Harus Di Isi',
            'gambar_bukti.file' => 'Anda Hanya Dapat Upload File',
            'gambar_bukti.image' => 'Anda Hanya Dapat Upload Image',
            'gambar_bukti.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar_bukti.max' => 'Berukuran MAX 2MB',
        ]);

        $file_awal = $pembayaran->gambar_bukti;
        $pi = [
            'gambar_bukti' => $file_awal,
        ];
        Request()->gambar_bukti->move(public_path() . '/Pinjaman/Pembayaran', $file_awal);
        $pembayaran->update($pi);

        return redirect()->route('dfpeminjam')->with('success', 'Berhasil edit gambar pembayaran');
    }

    public function printAllPembayaran()
    {
        if (Auth::user()->role == 'admin') {
            $data = [
                'pembayaran' => $this->Pembayaran->seeData(),
                'total' => Pembayaran::select(DB::raw('SUM(jumlah) as total'))
                    ->get(),
            ];
        } else {
            $data = [
                'pembayaran' => $this->Pembayaran->seeDataInId(Auth::user()->id),
                'total' => Pembayaran::select(DB::raw('SUM(jumlah) as total'))
                    ->where('user_id', Auth::user()->id)
                    ->groupBy("user_id")
                    ->get(),
            ];
        }

        return view('Pembayaran.PrintSemuaPembayaran', $data);
    }

    public function printPembayaranInID($user_id, $pinjaman_id)
    {
        $data = [
            'pembayaran' => $this->Pembayaran->seeDataInIdPinjaman($pinjaman_id, $user_id),
            'user_name' => User::find($user_id),
            'total' => Pembayaran::select(DB::raw('SUM(jumlah) as total'))
                ->where('user_id', $user_id)
                ->where('pinjaman_id', $pinjaman_id)
                ->groupBy("user_id")
                ->get(),
        ];

        return view('Pembayaran.PrintPembayaran', $data);
    }
}
