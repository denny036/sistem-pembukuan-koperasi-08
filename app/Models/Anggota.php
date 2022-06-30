<?php

namespace App\Models;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'user_id','name','tanggal_lahir','jenis_kelamin','alamat','Status_diri','nik','no_tlp','no_tlpWali'
    ];

    public function addData($data1){
        Anggota::create($data1);
    }

    public function periksa($id){
        return DB::table('anggota')->where('user_id', $id)->get();
    }

    public function simAwal($sim){
        Anggota::create($sim);
    }

    public function seeDataEdit($id){
        return DB::table('anggota')->where('user_id', $id)->get();
    }

    public function SeeProfil(){
        return DB::table('anggota')->where('user_id', Auth::user()->id)->get();
    }
}
