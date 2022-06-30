<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sukarela extends Model
{
    protected $table = 'setoran';

    protected $fillable = [
        'simpanan_id','user_id','jumlah_setoran','status','setoran_untukBulan','gambar_setoran'
    ];

    public function seeData($id){
        return DB::table('setoran')
        ->join('simpanan', 'simpanan.id', '=', 'setoran.simpanan_id')
        ->join('users', 'users.id', '=', 'setoran.user_id')
        ->select('users.name as name', 'setoran.jumlah_setoran as jumlah_setoran'
        ,'setoran.status as status', 'setoran.setoran_untukBulan as setoran_untukBulan'
        ,'setoran.created_at as created_at', 'setoran.id as id', 'setoran.gambar_setoran as gambar_setoran')
        ->where('setoran.simpanan_id', $id)
        ->orderBy('setoran.created_at', 'DESC')
        ->get();
    }
}
