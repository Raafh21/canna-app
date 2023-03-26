<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class KlasifikasiController extends Controller
{
    public function index()
    {
        
        return view('riwayat.create', [
            'title' => 'Klasifikasi'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Data Umum
            'nama_siswa' => 'required',
            'nama_sekolah' => 'required',
            'minat' => 'required',
            'nilai_tes' => 'required',

            // Matematika
            'nilai_mtk1' => 'required',
            'nilai_mtk2' => 'required',
            'nilai_mtk3' => 'required',
            'nilai_mtk4' => 'required',
            'nilai_mtk5' => 'required',

            // IPA
            'nilai_ipa1' => 'required',
            'nilai_ipa2' => 'required',
            'nilai_ipa3' => 'required',
            'nilai_ipa4' => 'required',
            'nilai_ipa5' => 'required',

            // IPS
            'nilai_ips1' => 'required',
            'nilai_ips2' => 'required',
            'nilai_ips3' => 'required',
            'nilai_ips4' => 'required',
            'nilai_ips5' => 'required'
        ]);

        DB::table('tb_training')->insert([
            'nama_siswa' => $request->nama_siswa,
            'nama_sekolah' => $request->nama_sekolah,
            'mtk_1' => $request->nilai_mtk1,
            'mtk_2' => $request->nilai_mtk2,
            'mtk_3' => $request->nilai_mtk3,
            'mtk_4' => $request->nilai_mtk4,
            'mtk_5' => $request->nilai_mtk5,
            'ipa_1' => $request->nilai_ipa1,
            'ipa_2' => $request->nilai_ipa2,
            'ipa_3' => $request->nilai_ipa3,
            'ipa_4' => $request->nilai_ipa4,
            'ipa_5' => $request->nilai_ipa5,
            'ips_1' => $request->nilai_ips1,
            'ips_2' => $request->nilai_ips2,
            'ips_3' => $request->nilai_ips3,
            'ips_4' => $request->nilai_ips4,
            'ips_5' => $request->nilai_ips5,
            'minat' => $request->minat,
            'nilai_tes' => $request->nilai_tes
        ]);

        return redirect()->route('riwayat.index')->with('status', 'Data Berhasil Ditambahkan!');
    }
}