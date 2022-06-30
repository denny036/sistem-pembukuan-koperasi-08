<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'kategori'
    ];

    public function addData($data)
    {
        Kategori::create($data);
    }

    public function seeData()
    {
        return DB::table('kategori')->orderBy('updated_at', 'DESC')->get();
    }

    public function deleteKategori($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}
