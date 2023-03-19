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
            'title' => 'Perhitungan',
            'jumlahData' => $jumlahData,
            'jumlahIPA' => $jumlahIPA,
            'jumlahIPS' => $jumlahIPS,
            'entropyAll' => $entropyAll
        ]);
    }

    public function mining()
    {
        $jumlahData = DB::table('tb_latih')->count();
        $dataLatih = DB::table('tb_latih')->get();

        return view('mining', [
            'title' => 'Proses Mining',
            'jumlahData' => $jumlahData,
            'dataLatih' => $dataLatih,
        ]);
    }

    public function pohon()
    {
        $jumlahDataRule = DB::table('t_keputusan')->count();
        $dataRule = DB::table('t_keputusan')->get();
        return view('pohon', [
            'title' => 'Pohon Keputusan',
            'jumlahDataRule' => $jumlahDataRule,
            'dataRule' => $dataRule,
        ]);
    }
}