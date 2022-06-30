<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->User = new User();
        $this->Anggota = new Anggota();
    }

    public function index(){
        $date = DB::table('anggota')->where('user_id', Auth::user()->id)->get();
        $date = $date[0]->tanggal_lahir;

        if(Auth::user()->role == 'admin'){
            $utang = DB::table('pinjaman')
            ->join('users', 'users.id', '=', 'pinjaman.user_id')
            ->select('users.name as name', 'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan',
            'pinjaman.status as status')
            ->orderBy('tgl_pinjaman', 'DESC')->get();
        }else{
            $utang = DB::table('pinjaman')->where('user_id',  Auth::user()->id)->orderBy('tgl_pinjaman', 'DESC')->get();
        }

        // umur
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($date); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        $data = [
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
            'profil' => $this->User->SeeProfil(),
            'anggota' => $this->Anggota->SeeProfil(),
            'umur' => $age,
        ];

        return view('Profil.Profil', $data);
    }

    public function editProfilData(){
        $anggota = Anggota::where('user_id', Request()->id)->get();
        $user = User::find(Request()->id);

        if (
            Request()->name == $anggota[0]->name &&
            Request()->tanggal_lahir == $anggota[0]->tanggal_lahir &&
            Request()->jenis_kelamin == $anggota[0]->jenis_kelamin &&
            Request()->alamat == $anggota[0]->alamat &&
            Request()->Status_diri == $anggota[0]->Status_diri &&
            Request()->nik == $anggota[0]->nik &&
            Request()->no_tlp == $anggota[0]->no_tlp &&
            Request()->no_tlpWali == $anggota[0]->no_tlpWali
        ) {
            return redirect()->back()->with('info', 'Tidak ada data yang berubah');
        }

        Request()->validate([
            'name' => 'required|min:4|max:220',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required|not_in:0',
            'alamat' => 'required',
            'Status_diri' => 'required|not_in:0',
            'nik' => 'required|numeric',
            'no_tlp' => 'required',
            'no_tlpWali' => 'required',
        ], [
            'name.required' => 'Harus di isi',
            'name.min' => 'Minimal 4 characters',
            'name.max' => 'Maximal 220 characters',
            'tanggal_lahir.required' => 'Harus di isi',
            'jenis_kelamin.required' => 'Harus di isi',
            'jenis_kelamin.not_in' => 'Harus dipilih',
            'alamat.required' => 'Harus di isi',
            'Status_diri.required' => 'Harus di isi',
            'Status_diri.not_in' => 'Harus dipilih',
            'nik.required' => 'Harus di isi',
            'nik.numeric' => 'Berupa anggota',
            'no_tlp' => 'Harus di isi',
            'no_tlpWali.required' => 'Harus di isi',
        ]);

        $user->name = Request()->name;
        $anggota[0]->name = Request()->name;
        $anggota[0]->tanggal_lahir = Request()->tanggal_lahir;
        $anggota[0]->jenis_kelamin = Request()->jenis_kelamin;
        $anggota[0]->alamat = Request()->alamat;
        $anggota[0]->Status_diri = Request()->Status_diri;
        $anggota[0]->nik = Request()->nik;
        $anggota[0]->no_tlp = Request()->no_tlp;
        $anggota[0]->no_tlpWali = Request()->no_tlpWali;

        $anggota[0]->save();
        $user->save();

        return redirect()->route('profil')->with('success', 'Berhasil edit data');
    }

    public function editGambarProfil(){
        $user = User::find(Auth::user()->id);

        if (Request()->foto_profil == null) {
            return redirect()->back()->with('info', 'Tidak ada data yang berubah');
        }

        Request()->validate([
            'foto_profil' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto_profil.required' => 'Harus Di Isi',
            'foto_profil.file' => 'Anda Hanya Dapat Upload File',
            'foto_profil.image' => 'Anda Hanya Dapat Upload Image',
            'foto_profil.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'foto_profil.max' => 'Gambar Berukuran MAX 2MB',
        ]);

        if ($user->foto_profil == 'avatar-1.png') {
            $file = Request()->file('foto_profil');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'Gambar/New Akun';
            $file->move($tujuan_upload, $nama_file);

            $user->foto_profil = $nama_file;
            $user->save();
        } else {
            $gambar_awal = $user->foto_profil;
            $pi = [
                'foto_profil' => $gambar_awal,
            ];
            Request()->foto_profil->move(public_path() . '/Gambar/New Akun', $gambar_awal);
            $user->update($pi);
        }

        return redirect()->route('profil')->with('success', 'Berhasil Edit Gambar');
    }
}
