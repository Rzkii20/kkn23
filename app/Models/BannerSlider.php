<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSlider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner_slider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'subjudul',
        'foto_banner',
        'urutan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'urutan' => 'integer',
    ];
}
