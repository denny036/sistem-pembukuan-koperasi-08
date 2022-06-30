<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bulan extends Model
{
    protected $table = 'bulan';

    protected $fillable = [
        'name'
    ];

    public function seeData(){
        return DB::table('bulan')->orderBy('id', 'ASC')->get();
    }
}
