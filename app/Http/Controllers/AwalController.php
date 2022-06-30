<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwalController extends Controller
{
    public function __construct(){
        $this->Berita = new Berita();
        $this->Pengumuman = new Pengumuman();
    }

    public function index(){
        $data = [
            'berita' => $this->Berita->seeDataHome(),
        ];

        return view('Index.HalamanAwal', $data);
    }

    public function v_informasi(){
        $data = [
            'berita' => $this->Berita->seeDataPaginate(),
        ];

        return view('Index.Informasi', $data);
    }

    public function v_bacaBerita($id){
        $data = [
            'berita' => $this->Berita->read($id),
            'lainnya' => $this->Berita->lainnya($id),
            'pengumuman' => $this->Pengumuman->seeDataArtc(),
        ];
        return view('Index.BacaArtikel', $data);
    }

    public function v_Pengumuman(){
        $data = [
            'pengumuman' => $this->Pengumuman->seeDataPaginate(),
            'berita' => $this->Berita->seeDataPe(),
        ];

        return view('Index.Pengumuman', $data);
    }

    public function v_bacaPengumuman($id){
        $data = [
            'berita' => $this->Berita->seeDataPe(),
            'lainnya' => $this->Pengumuman->lainnya($id),
            'pengumuman' => $this->Pengumuman->updateData($id),
        ];

        return view('Index.BacaPengumuman', $data);
    }

    public function v_about(){
        return view('Index.About');
    }
}
