<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AwalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PokokController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\SukarelaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('Index.LayoutAwal.Template');
// });
Route::get('/', [AwalController::class, 'index']);
Route::get('/infomasi', [AwalController::class, 'v_informasi'])->name('informasi');
Route::get('/informasi/baca/{id}', [AwalController::class, 'v_bacaBerita'])->name('bacaBerita');
Route::get('/pengumuman/baca/{id}', [AwalController::class, 'v_bacaPengumuman'])->name('bacaPengumuman');
Route::get('/pengumuman-index', [AwalController::class, 'v_Pengumuman'])->name('pengumumanIn');
Route::get('/about', [AwalController::class, 'v_About'])->name('about');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','CekLevel:admin']], function () {
    // Kategori Routes
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/tambah_kategori', [KategoriController::class, 'addData'])->name('tambah_kategori');
    Route::post('/edit_kategori', [KategoriController::class, 'updateKategori'])->name('edit_kategori');
    Route::post('/hapus_kategori', [KategoriController::class, 'deleteKategori'])->name('hapus_kategori');

    // Barita Routes
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/halaman_tambahBerita', [BeritaController::class, 'v_tambahBerita'])->name('halaman_tambahBerita');
    Route::get('/halaman_editBerita/{id}', [BeritaController::class, 'v_editKategori'])->name('halaman_editBerita');
    Route::post('/tambah_berita', [BeritaController::class, 'addData'])->name('tambah_berita');
    Route::post('/edit_dataBerita', [BeritaController::class, 'updateDataBerita'])->name('edit_dataBerita');
    Route::post('/edit_gambarBerita', [BeritaController::class, 'updateGambarBerita'])->name('edit_gambarBerita');
    Route::post('/hapus_berita', [BeritaController::class, 'deleteBerita'])->name('hapus_berita');

    // Pengumuman Routes
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/halaman_tambahPengumuman', [PengumumanController::class, 'v_tambahPengumuman'])->name('halaman_tambahPengumuman');
    Route::get('/halaman_editPengumuman/{id}', [PengumumanController::class, 'v_editPengumuman'])->name('halaman_editPengumuman');
    Route::post('/tambah_pengumuman', [PengumumanController::class, 'addData'])->name('tambah_pengumuman');
    Route::post('/edit_pengumuman', [PengumumanController::class, 'updateDataPengumuman'])->name('edit_pengumuman');
    Route::post('/hapus_pengumuman', [PengumumanController::class, 'deleteBerita'])->name('hapus_pengumuman');

    // Setoran Wajib Routes
    Route::get('/halaman_tambahSPMWajib', [SetoranController::class, 'v_tambahSPMWajib'])->name('Halaman_TambahSPMWajib');
    Route::get('/halaman_editSPMWajib/{id}', [SetoranController::class, 'v_editSPMWajib'])->name('halaman_editSPMWajib');
    Route::post('/tambah_simpananWajib', [SetoranController::class, 'addData'])->name('tambah_simpananWajib');
    Route::post('/edit_spmData', [SetoranController::class, 'updateData'])->name('edit_spmData');
    Route::post('/edit_spmGambar', [SetoranController::class, 'updateGambar'])->name('edit_spmGambar');
    Route::post('/hapus_spm', [SetoranController::class, 'deleteData'])->name('hapus_spm');
    Route::get('/simpanan_wajib/print', [SetoranController::class, 'print'])->name('printSPMW');

    // Setoran Pokok Route
    Route::get('/halaman_tambahSPMPokok', [PokokController::class, 'v_tambahSPMWajib'])->name('halaman_tambahSPMPokok');
    Route::get('/halaman_editSPMPokok/{id}', [PokokController::class, 'v_editSPMPokok'])->name('halaman_editSPMPokok');
    Route::get('/simpanan_pokok/print', [PokokController::class, 'print'])->name('printSPMP');

    // Setoran sukarela Route
    Route::get('/halaman_tambahSPMSukarela', [SukarelaController::class, 'v_tambahSPMWajib'])->name('halaman_tambahSPMSukarela');
    Route::get('/halaman_editSPMSukarela/{id}', [SukarelaController::class, 'v_editSPMPokok'])->name('halaman_editSPMSukarela');
    Route::get('/simpanan_sukarela/print', [SukarelaController::class, 'print'])->name('printSPMS');

    // anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
    Route::get('/tambah_anggota', [AnggotaController::class, 'v_tmAnggota'])->name('tambah_anggota');
    Route::get('/edit_anggota/{id}', [AnggotaController::class, 'v_aditAnggota'])->name('edit_anggota');
    Route::post('/updateDataAnggota', [AnggotaController::class, 'updateData'])->name('update_anggota');
    Route::post('/updateGambarAnggota', [AnggotaController::class, 'updateGambar'])->name('update_gambar');
    Route::post('/proses_tambahAnggota', [AnggotaController::class, 'addData'])->name('Protambah_anggota');

    // pinjaman
    Route::get('/pinjam', [PinjamanController::class, 'index'])->name('pinjaman');

    // pembayaran
    Route::get('/pembayaran/tambah', [PembayaranController::class, 'v_tambahPembayaran'])->name('tambahPembayaran');
    Route::get('/pembayaran/edit/{id}', [PembayaranController::class, 'v_editPembayaran'])->name('editPembayaran');
    Route::post('/pembayaran/proses', [PembayaranController::class, 'addData'])->name('tmpembayaran');
    Route::post('/pembayaran/hapus', [PembayaranController::class, 'deleteData'])->name('hapusPembayaran');
    Route::post('/pembayaran/editdata/proses', [PembayaranController::class, 'updateData'])->name('editDataPembayaran');
    Route::post('/pembayaran/editgambar/proses', [PembayaranController::class, 'updateGambar'])->name('editGambarPembayaran');
});

Route::group(['middleware' => ['auth','CekLevel:admin,anggota']], function () {
    // profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/editProfil', [ProfilController::class, 'editProfilData'])->name('editProfilData');
    Route::post('/editGambarProfil', [ProfilController::class, 'editGambarProfil'])->name('editGambarProfil');

    // simpanan
    Route::get('/simpanan_wajib', [SetoranController::class, 'index'])->name('simpanan_wajib');
    Route::get('/simpanan_pokok', [PokokController::class, 'index'])->name('simpanan_pokok');
    Route::get('/simpanan_sukarela', [SukarelaController::class, 'index'])->name('simpanan_sukarela');

    // pinjaman
    Route::get('/tambah_pinjaman', [PinjamanController::class, 'v_tambahPinjaman'])->name('tambahPinjaman');
    Route::get('/download/{file}', [PinjamanController::class, 'download'])->name('download');
    Route::get('/edit_pinjaman/{id}', [PinjamanController::class, 'v_editPinjaman'])->name('editPinjaman');
    Route::get('/pinjaman/print', [PinjamanController::class, 'print'])->name('printPinjaman');
    Route::post('/proses_tambahPinjaman', [PinjamanController::class, 'addData'])->name('prostmPinjaman');
    Route::post('/proses_editData', [PinjamanController::class, 'updateData'])->name('prosedData');
    Route::post('/proses_editfile', [PinjamanController::class, 'updateFile'])->name('prosedfile');
    Route::post('/hapus_pinjaman', [PinjamanController::class, 'deleteData'])->name('hapus_pinjaman');

    // Pembayaran
    Route::get('/dfpeminjam', [PinjamanController::class, 'IndexInPay'])->name('dfpeminjam');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/semuaPembayaran', [PembayaranController::class, 'indexPembayaran'])->name('allPembayaran');
    Route::get('/print/semuaPembayaran', [PembayaranController::class, 'printAllPembayaran'])->name('printAllPembayaran');
    Route::get('/print/pembayaran/{user_id}/{pinjaman_id}', [PembayaranController::class, 'printPembayaranInID'])->name('printPembayaranInID');
});

Route::group(['middleware' => ['auth','CekLevel:anggota']], function () {
    // pinjaman
    Route::get('/anggota_pinjam', [PinjamanController::class, 'indexInID'])->name('AgPinjam');
    Route::get('/anggota_pinjam/print', [PinjamanController::class, 'printInID'])->name('AgPinjamPrint');

    // print
    Route::get('/anggota_pinjam/printWajib', [SetoranController::class, 'printWajibInID'])->name('AgPrintWajib');
    Route::get('/anggota_pinjam/printPokok', [PokokController::class, 'printPokokInID'])->name('AgPrintPokok');
    Route::get('/anggota_pinjam/printSukarela', [SukarelaController::class, 'printSukarelaInID'])->name('AgPrintSukarela');
});


Auth::routes();
