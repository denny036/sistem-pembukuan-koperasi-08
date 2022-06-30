<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'kategori_id', 'judul', 'headline', 'isi', 'gambar'
    ];

    public function addData($data)
    {
        Berita::create($data);
    }

    public function seeData()
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as is',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
                'berita.created_at as created_at'
            )
            ->orderBy('berita.created_at', 'DESC')
            ->get();
    }

    public function seeDataPe()
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as is',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
                'berita.created_at as created_at'
            )
            ->orderBy('berita.created_at', 'DESC')
            ->limit(3)
            ->get();
    }

    public function seeDataPaginate(){
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as is',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
                'berita.created_at as created_at'
            )
            ->orderBy('berita.created_at', 'DESC')
            ->paginate(6);
    }

    public function seeDataHome()
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as isi',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
                'berita.created_at as created_at'
            )
            ->orderBy('berita.created_at', 'DESC')
            ->limit(4)
            ->get();
    }

    public function lainnya($id)
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as isi',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
                'berita.created_at as created_at'
            )
            ->where('berita.id', '!=', $id)
            ->orderBy('berita.created_at', 'DESC')
            ->limit(3)
            ->get();
    }

    public function updateData($id)
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as isi',
                'berita.kategori_id as kategori_id',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
            )
            ->orderBy('berita.created_at', 'DESC')
            ->where('berita.id', $id)
            ->get();
    }

    public function read($id)
    {
        return DB::table('berita')
            ->join('kategori', 'kategori.id', '=', 'berita.kategori_id')
            ->select(
                'kategori.kategori as kategori',
                'berita.id as id',
                'berita.judul as judul',
                'berita.headline as headline',
                'berita.isi as isi',
                'berita.kategori_id as kategori_id',
                'berita.gambar as gambar',
                'berita.updated_at as updated_at',
            )
            ->orderBy('berita.created_at', 'DESC')
            ->where('berita.id', $id)
            ->get();
    }

    public function deleteData($id)
    {
        $berita = Berita::find($id);
        $berita->delete();
    }
}
