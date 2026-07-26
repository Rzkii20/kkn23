<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wisata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_wisata',
        'slug',
        'deskripsi',
        'alamat',
        'latitude',
        'longitude',
        'foto_wisata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
