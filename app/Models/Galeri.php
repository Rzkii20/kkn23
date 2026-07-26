<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galeri';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'tipe',
        'file_path',
    ];
}
