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

}
