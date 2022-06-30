<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Setoran extends Model
{
    protected $table = 'setoran';

    protected $fillable = [
        'simpanan_id','user_id','jumlah_setoran','status','setoran_untukBulan','tahun','gambar_setoran'
    ];

    public function addData($data){
        Setoran::create($data);
    }

    public function seeData($id){
        return DB::table('setoran')
        ->join('simpanan', 'simpanan.id', '=', 'setoran.simpanan_id')
        ->join('users', 'users.id', '=', 'setoran.user_id')
        ->select('users.name as name', 'setoran.jumlah_setoran as jumlah_setoran'
        ,'setoran.status as status', 'setoran.setoran_untukBulan as setoran_untukBulan','setoran.tahun as tahun'
        ,'setoran.created_at as created_at', 'setoran.id as id', 'setoran.gambar_setoran as gambar_setoran')
        ->where('setoran.simpanan_id', $id)
        ->orderBy('setoran.created_at', 'DESC')
        ->get();
    }

    public function seeDataInID($id, $user_id){
        return DB::table('setoran')
        ->join('simpanan', 'simpanan.id', '=', 'setoran.simpanan_id')
        ->join('users', 'users.id', '=', 'setoran.user_id')
        ->select('users.name as name', 'setoran.jumlah_setoran as jumlah_setoran'
        ,'setoran.status as status', 'setoran.setoran_untukBulan as setoran_untukBulan','setoran.tahun as tahun'
        ,'setoran.created_at as created_at', 'setoran.id as id', 'setoran.gambar_setoran as gambar_setoran')
        ->where('setoran.simpanan_id', $id)
        ->where('setoran.user_id', $user_id)
        ->orderBy('setoran.created_at', 'DESC')
        ->get();
    }

    public function updateData($id_simpanan, $id){
        return DB::table('setoran')
        ->join('simpanan', 'simpanan.id', '=', 'setoran.simpanan_id')
        ->join('users', 'users.id', '=', 'setoran.user_id')
        ->select('users.name as name', 'setoran.jumlah_setoran as jumlah_setoran'
        ,'setoran.status as status', 'setoran.setoran_untukBulan as setoran_untukBulan'
        ,'setoran.created_at as created_at', 'setoran.id as id','setoran.tahun as tahun'
        , 'setoran.gambar_setoran as gambar_setoran', 'users.id as user_id')
        ->where('setoran.simpanan_id', $id_simpanan)
        ->where('setoran.id', $id)
        ->orderBy('setoran.created_at', 'DESC')
        ->get();
    }

    public function contoh(){
        return DB::table('setoran')
        ->join('users', 'users.id', '=', 'setoran.user_id')
        ->select('setoran.id as name')
        ->where('setoran.setoran_untukBulan', '!=', 'September')
        ->orwhere('setoran.tahun', '!=', '2022')
        ->get();
    }

    public function deleteData($id){
        $setoran = Setoran::find($id);
        $setoran->delete();
    }
}
