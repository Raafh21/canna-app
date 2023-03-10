<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingRequest;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $training = DB::table('tb_training')->get();

        return view('training.index', [
            'title' => 'Data Training',
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
        return view('training.create', [
            'title' => 'Tambah Data Training'
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
            'nama_siswa' => 'required',
            'nama_sekolah' => 'required',
            'minat' => 'required',
            'nilai_tes' => 'required'

            // // Matematika
            // 'nilai_mtk1' => 'required',
            // 'nilai_mtk2' => 'required',
            // 'nilai_mtk3' => 'required',
            // 'nilai_mtk4' => 'required',
            // 'nilai_mtk5' => 'required',

            // // IPA
            // 'nilai_ipa1' => 'required',
            // 'nilai_ipa2' => 'required',
            // 'nilai_ipa3' => 'required',
            // 'nilai_ipa4' => 'required',
            // 'nilai_ipa5' => 'required',

            // // IPS
            // 'nilai_ips1' => 'required',
            // 'nilai_ips2' => 'required',
            // 'nilai_ips3' => 'required',
            // 'nilai_ips4' => 'required',
            // 'nilai_ips5' => 'required'
        ]);

        DB::table('tb_tes')->insert([
            'nama_siswa' => $request->nama_siswa,
            'nama_sekolah' => $request->nama_sekolah,
            'minat' => $request->minat,
            'nilai_tes' => $request->nilai_tes
        ]);

        // Training::create([
        //     'nama_siswa' => $request->nama_siswa,
        //     'nama_sekolah' => $request->nama_sekolah,
        //     'mtk_1' => $request->mtk_1,
        //     'mtk_2' => $request->mtk_2,
        //     'mtk_3' => $request->mtk_3,
        //     'mtk_4' => $request->mtk_4,
        //     'mtk_5' => $request->mtk_5,
        //     'ipa_1' => $request->ipa_1,
        //     'ipa_2' => $request->ipa_2,
        //     'ipa_3' => $request->ipa_3,
        //     'ipa_4' => $request->ipa_4,
        //     'ipa_5' => $request->ipa_5,
        //     'ips_1' => $request->ips_1,
        //     'ips_2' => $request->ips_2,
        //     'ips_3' => $request->ips_3,
        //     'ips_4' => $request->ips_4,
        //     'ips_5' => $request->ips_5,
        //     'minat' => $request->minat,
        //     'nilai_tes' => $request->nilai_tes
        // ]);

        return redirect()->route('training.index')->with('status', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = DB::table('tb_tes')->find($id);

        return view('training.edit', [
            'title' => 'Edit Data Training',
            'training' => $training
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_siswa' => 'required',
            'nama_sekolah' => 'required',
            'minat' => 'required',
            'nilai_tes' => 'required'
        ]);

        DB::table('tb_tes')
            ->where('id', $id)
            ->update([
                'nama_siswa' => $request->nama_siswa
            ]);


        return redirect()->route('training.index')->with('status', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tb_tes')->where('id', $id)->delete();


        return redirect()->route('training.index')->with('status', 'Data Berhasil Dihapus!');
    }
}
