<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'ktp_kia',
        'surat_sehat',
        'kartu_bpjs',
        'surat_balasan',
        'buku_tabungan',
        'lengkap',
    ];

    protected $casts = [
        'lengkap' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
