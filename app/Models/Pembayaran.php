<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pinjaman_id','user_id','jumlah','tgl_bayar','gambar_bukti'
    ];

    public function addData($data){
        Pembayaran::create($data);
    }

    public function seeDataInIdPinjaman($pinjaman_id, $user_id){
        return DB::table('pinjaman')
        ->join('pembayaran','pembayaran.pinjaman_id', '=', 'pinjaman.id')
        ->join('users', 'users.id', '=', 'pembayaran.user_id')
        ->select('users.name as name', 'pembayaran.jumlah as jumlah', 'pembayaran.tgl_bayar as tgl_bayar'
        ,'pembayaran.gambar_bukti as gambar_bukti', 'pembayaran.id as id')
        ->where('pembayaran.pinjaman_id', $pinjaman_id)
        ->where('pembayaran.user_id', $user_id)
        ->get();
    }

    public function seeData(){
        return DB::table('pinjaman')
        ->join('pembayaran','pembayaran.pinjaman_id', '=', 'pinjaman.id')
        ->join('users', 'users.id', '=', 'pembayaran.user_id')
        ->select('users.name as name', 'pembayaran.jumlah as jumlah', 'pembayaran.tgl_bayar as tgl_bayar'
        ,'pembayaran.gambar_bukti as gambar_bukti', 'pinjaman.tgl_pinjaman as tgl_pinjaman'
        ,'pembayaran.id as id')
        ->get();
    }

    public function seeDataInId($user_id){
        return DB::table('pinjaman')
        ->join('pembayaran','pembayaran.pinjaman_id', '=', 'pinjaman.id')
        ->join('users', 'users.id', '=', 'pembayaran.user_id')
        ->select('users.name as name', 'pembayaran.jumlah as jumlah', 'pembayaran.tgl_bayar as tgl_bayar'
        ,'pembayaran.gambar_bukti as gambar_bukti', 'pinjaman.tgl_pinjaman as tgl_pinjaman'
        ,'pembayaran.id as id')
        ->where('pembayaran.user_id', $user_id)
        ->get();
    }

    public function dataEdit($id){
        return DB::table('pinjaman')
        ->join('pembayaran','pembayaran.pinjaman_id', '=', 'pinjaman.id')
        ->join('users', 'users.id', '=', 'pembayaran.user_id')
        ->select('pembayaran.jumlah as jumlah', 'pembayaran.tgl_bayar as tgl_bayar'
        ,'pembayaran.gambar_bukti as gambar_bukti','pembayaran.id as id')
        ->where('pembayaran.id', $id)
        ->get();
    }

    public function deleteData($id){
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
    }
}
