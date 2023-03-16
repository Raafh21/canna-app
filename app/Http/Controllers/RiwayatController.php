<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
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
            'title' => 'Data Training',
            'training' => $training
        ]);
    }

    public function see2($id)
    {
        $training = DB::table('tb_training')->find($id);
        return view('riwayat.see2', [
            'title' => 'Data Training',
            'training' => $training
        ]);
    }

    public function edit($id)
    {
        $training = DB::table('tb_training')->find($id);

        return view('riwayat.edit', [
            'title' => 'Edit Data Training',
            'training' => $training
        ]);
    }

}
