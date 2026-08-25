<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturDesa extends Model
{
    use HasFactory;

    protected $table = 'struktur_desas';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'periode',
        'nomor_hp',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    /**
     * Scope untuk hanya mengambil data yang aktif, diurutkan berdasarkan urutan tampil.
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
