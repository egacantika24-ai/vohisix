<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedoman_pkl',
        'surat_permohonan',
        'surat_perizinan_orangtua',
    ];
}
