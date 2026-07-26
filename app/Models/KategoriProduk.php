<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriProduk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori_produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    /**
     * Get the products for this category.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    /**
     * Get the UMKM that belong to this category.
     */
    public function umkm(): BelongsToMany
    {
        return $this->belongsToMany(Umkm::class, 'kategori_umkm', 'kategori_id', 'umkm_id');
    }
}
