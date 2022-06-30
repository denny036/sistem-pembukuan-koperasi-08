<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'user_id','besar_pinjaman','tgl_pinjaman','tgl_pelunasan','fileBukti','status'
    ];

    public function addData($data){
        Pinjaman::create($data);
    }

    public function seeData(){
        return DB::table('pinjaman')
        ->join('users', 'users.id', '=', 'pinjaman.user_id')
        ->select('users.name as name', 'pinjaman.besar_pinjaman as  besar_pinjaman'
        ,'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan'
        ,'pinjaman.fileBukti as fileBukti', 'pinjaman.status  as status', 'pinjaman.id as id')
        ->orderBy('pinjaman.tgl_pinjaman', 'ASC')
        ->get();
    }

    public function seeDataInID($id){
        return DB::table('pinjaman')
        ->join('users', 'users.id', '=', 'pinjaman.user_id')
        ->select('users.name as name', 'pinjaman.besar_pinjaman as  besar_pinjaman'
        ,'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan'
        ,'pinjaman.fileBukti as fileBukti', 'pinjaman.status  as status', 'pinjaman.id as id')
        ->where('pinjaman.user_id', $id)
        ->orderBy('pinjaman.tgl_pinjaman', 'ASC')
        ->get();
    }

    public function seeDataInPay(){
        return DB::table('pinjaman')
        ->join('users', 'users.id', '=', 'pinjaman.user_id')
        ->select('users.name as name', 'pinjaman.besar_pinjaman as besar_pinjaman'
        ,'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan'
        ,'pinjaman.status  as status', 'pinjaman.id as id', 'users.id as user_id')
        ->get();
    }

    public function seeDataInPayID($id){
        return DB::table('pinjaman')
        ->join('users', 'users.id', '=', 'pinjaman.user_id')
        ->select('users.name as name', 'pinjaman.besar_pinjaman as  besar_pinjaman'
        ,'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan'
        ,'pinjaman.status  as status', 'pinjaman.id as id', 'users.id as user_id')
        ->where('pinjaman.user_id', $id)
        ->orderBy('pinjaman.tgl_pinjaman', 'ASC')
        ->get();
    }

    public function updatedata($id){
        return DB::table('pinjaman')
        ->join('users', 'users.id', '=', 'pinjaman.user_id')
        ->select('users.name as name', 'pinjaman.besar_pinjaman as  besar_pinjaman'
        ,'pinjaman.tgl_pinjaman as tgl_pinjaman', 'pinjaman.tgl_pelunasan as tgl_pelunasan'
        ,'pinjaman.fileBukti as fileBukti', 'pinjaman.status  as status', 'pinjaman.id as id'
        ,'users.id as user_id')
        ->where('pinjaman.id', $id)
        ->orderBy('pinjaman.tgl_pinjaman', 'ASC')
        ->get();
    }

    public function deleteData($id){
        $setoran = Pinjaman::find($id);
        $setoran->delete();
    }
}
