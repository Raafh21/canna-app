<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        $jumlahData = DB::table('tb_training')->count();
        $jumlahIPA = DB::table('tb_training') 
            ->where('hasil', '<>', 'IPA')
            ->count();
            
        $jumlahIPS = DB::table('tb_training')
            ->where('hasil', '<>', 'IPS')
            ->count();

        $entropyAll = (-$jumlahIPA / $jumlahData) * log($jumlahIPA / $jumlahData, 2) + (-$jumlahIPS / $jumlahData) * log($jumlahIPS / $jumlahData, 2);
  
        return view('perhitungan', [
            'title' => 'Perhitungan C4.5',
            'jumlahData' => $jumlahData,
            'jumlahIPA' => $jumlahIPA,
            'jumlahIPS' => $jumlahIPS,
            'entropyAll' => $entropyAll
        ]);
    }

    public function pohon()
    {
        return view('pohon',[
            'title' => 'Pohon Keputusan',
        ]);
    }


}
