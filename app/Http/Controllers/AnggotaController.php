<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->User = new User();
        $this->Anggota = new Anggota();
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
            'user' => $this->User->seeData(),
            'jmAnggota' => User::Where('role', 'anggota')->count(),
            'date' => Carbon::now()->toDateTimeString(),
            'utang' => $utang,
        ];

        return view('Admin.Anggota.Anggota', $data);
    }

    public function v_tmAnggota()
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
        ];

        return view('Admin.Anggota.Halaman_TambahAnggota', $data);
    }

    public function addData()
    {
        Request()->validate([
            'name' => 'required|min:4|max:220',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required|not_in:0',
            'alamat' => 'required',
            'Status_diri' => 'required|not_in:0',
            'nik' => 'required|numeric',
            'no_tlp' => 'required',
            'no_tlpWali' => 'required',
            'foto_profil' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Harus di isi',
            'name.min' => 'Minimal 4 characters',
            'name.max' => 'Maximal 220 characters',
            'email.required' => 'Harus di isi',
            'email.email' => 'Ini bukan Email',
            'email.unique' => 'Sudah digunakan',
            'password.required' => 'Harus di isi',
            'password.min' => 'Minimal 8 characters',
            'password.confirmed' => 'Harus sama',
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
            'foto_profil.required' => 'Harus Di Isi',
            'foto_profil.file' => 'Anda Hanya Dapat Upload File',
            'foto_profil.image' => 'Anda Hanya Dapat Upload Image',
            'foto_profil.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'foto_profil.max' => 'Gambar Berukuran MAX 2MB',
        ]);

        $file = Request()->file('foto_profil');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'Gambar/New Akun';
        $file->move($tujuan_upload, $nama_file);

        $data2 = [
            'name' => Request()->name,
            'email' => Request()->email,
            'foto_profil' => $nama_file,
            'password' => Hash::make(Request()->password),
        ];

        $this->User->addData($data2);

        $user_id = $this->User->lastId();

        foreach ($user_id as $id){
            $use_id = $id->id;
        }

        $data1 = [
            'name' => Request()->name,
            'user_id' => $use_id,
            'tanggal_lahir' => Request()->tanggal_lahir,
            'jenis_kelamin' => Request()->jenis_kelamin,
            'alamat' => Request()->alamat,
            'Status_diri' => Request()->Status_diri,
            'nik' => Request()->nik,
            'no_tlp' => Request()->no_tlp,
            'no_tlpWali' => Request()->no_tlpWali,
        ];

        $this->Anggota->addData($data1);

        return redirect()->route('anggota')->with('success', 'Berhasil menambahkan anggota');
    }

    public function v_aditAnggota($id)
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
            'anggota' => $this->Anggota->seeDataEdit($id),
            'user' => $this->User->Editdata($id),
        ];

        return view('Admin.Anggota.Halaman_EditAnggota', $data);
    }

    public function updateData()
    {
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

        return redirect()->route('anggota')->with('success', 'Berhasil edit data');
    }

    public function updateGambar()
    {
        $user = User::find(Request()->id);

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

        return redirect()->route('anggota')->with('success', 'Berhasil Edit Gambar');
    }
}
