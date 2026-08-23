<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_dokumen',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];
}
