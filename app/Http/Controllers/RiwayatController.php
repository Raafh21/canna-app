<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlasifikasiRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $training = DB::table('tb_training')->get();
        return view('riwayat.index', [
            'title' => 'Data Hasil Klasifikasi',
            'training' => $training
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('riwayat.create', [
            'title' => 'Klasifikasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Data Umum
            'no_pendaftaran' => 'required',
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

        // Nilai Rata-rata IPA
        $ipa_rata = ($request->nilai_ipa1 + $request->nilai_ipa2 + $request->nilai_ipa3 + $request->nilai_ipa4 + $request->nilai_ipa5) / 5;

        // Nilai Rata-rata Matematika
        $mtk_rata = ($request->nilai_mtk1 + $request->nilai_mtk2 + $request->nilai_mtk3 + $request->nilai_mtk4 + $request->nilai_mtk5) / 5;

        // Nilai Rata-rata IPS
        $ips_rata = ($request->nilai_ips1 + $request->nilai_ips2 + $request->nilai_ips3 + $request->nilai_ips4 + $request->nilai_ips5) / 5;

        // Nilai IPA Grade
        $ipa_grade = "";
        if ($ipa_rata < 75) {
            $ipa_grade = "C";
        } elseif ($ipa_rata >= 85) {
            $ipa_grade = "A";
        } else {
            $ipa_grade = "B";
        }

        // Nilai Matematika Grade
        $mtk_grade = "";
        if ($mtk_rata < 75) {
            $mtk_grade = "C";
        } elseif ($mtk_rata >= 85) {
            $mtk_grade = "A";
        } else {
            $mtk_grade = "B";
        }

        // Nilai IPS Grade
        $ips_grade = "";
        if ($ips_rata < 75) {
            $ips_grade = "C";
        } elseif ($ips_rata >= 85) {
            $ips_grade = "A";
        } else {
            $ips_grade = "B";
        }

        // Hasil
        $hasil = $mtk_rata + $ipa_rata + $ips_rata + $request->nilai_tes;
        if ($hasil < 340) {
            $hasil = "IPS";
        } else {
            $hasil = "IPA";
        }

        DB::table('tb_training')->insert([
            'nama_siswa' => $request->nama_siswa,
            'nama_sekolah' => $request->nama_sekolah,
            'mtk_1' => $request->nilai_mtk1,
            'mtk_2' => $request->nilai_mtk2,
            'mtk_3' => $request->nilai_mtk3,
            'mtk_4' => $request->nilai_mtk4,
            'mtk_5' => $request->nilai_mtk5,
            'mtk_rata' => $mtk_rata,
            'mtk_grade' => $mtk_grade,
            'ipa_1' => $request->nilai_ipa1,
            'ipa_2' => $request->nilai_ipa2,
            'ipa_3' => $request->nilai_ipa3,
            'ipa_4' => $request->nilai_ipa4,
            'ipa_5' => $request->nilai_ipa5,
            'ipa_rata' => $ipa_rata,
            'ipa_grade' => $ipa_grade,
            'ips_1' => $request->nilai_ips1,
            'ips_2' => $request->nilai_ips2,
            'ips_3' => $request->nilai_ips3,
            'ips_4' => $request->nilai_ips4,
            'ips_5' => $request->nilai_ips5,
            'ips_rata' => $ips_rata,
            'ips_grade' => $ips_grade,
            'minat' => $request->minat,
            'nilai_tes' => $request->nilai_tes,
            'hasil' => $hasil
        ]);

        return redirect()->route('riwayat.index')->with('status', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
