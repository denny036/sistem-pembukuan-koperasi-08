<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul','isi'
    ];

    public function addData($data){
        Pengumuman::create($data);
    }

    public function seeData(){
        return DB::table('pengumuman')->orderBy('created_at', 'DESC')->get();
    }

    public function seeDataPaginate(){
        return DB::table('pengumuman')->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function seeDataArtc(){
        return DB::table('pengumuman')->orderBy('created_at', 'DESC')->limit(5)->get();
    }

    public function lainnya($id){
        return DB::table('pengumuman')->where('id', '!=' ,$id)->orderBy('created_at', 'DESC')->limit(3)->get();
    }

    public function updateData($id){
        return DB::table('pengumuman')->where('id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function deleteData($id){
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
    }
}
