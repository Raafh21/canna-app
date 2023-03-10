<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    
    protected $table = 'tb_training';

    protected $fillable = [
        'nama_siswa',
        'nama_sekolah',
        'minat',
        'nilai_tes'
    ];
}
