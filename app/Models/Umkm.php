<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_usaha',
        'slug',
        'deskripsi',
        'alamat',
        'no_whatsapp',
        'latitude',
        'longitude',
        'foto_toko',
        'qr_code_path',
        'status_aktif',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'status_aktif' => 'boolean',
    ];

    /**
     * Get the user that owns the UMKM.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the products for the UMKM.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'umkm_id');
    }

    /**
     * Get the categories for the UMKM.
     */
    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(KategoriProduk::class, 'kategori_umkm', 'umkm_id', 'kategori_id');
    }
}
