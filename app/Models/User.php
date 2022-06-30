<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Cache;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','foto_profil',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function seeData(){
        return DB::table('users')
        ->join('anggota', 'anggota.user_id', '=', 'users.id')
        ->select('anggota.name as name',
        'anggota.jenis_kelamin as jenis_kelamin',
        'anggota.no_tlp as no_tlp', 'anggota.no_tlpWali as no_tlpWali',
        'anggota.alamat as alamat', 'users.id as id', 'users.foto_profil as foto_profil',)
        ->where('users.role', 'anggota')
        ->orderBy('anggota.name', 'ASC')
        ->get();
    }

    public function addData($data2){
        User::create($data2);
    }

    public function lastId(){
        return User::orderBy('id', 'DESC')->Limit(1)->get('id');
    }

    public function seeDataAnggota(){
        return DB::table('users')->where('role', 'anggota')->orderBy('name', 'ASC')->get();
    }

    public function Editdata($id){
        return DB::table('users')->where('id', $id)->get();
    }

    public function SeeProfil(){
        return DB::table('users')->where('id', Auth::user()->id)->get();
    }
}
