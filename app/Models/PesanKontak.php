<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pesan_kontak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
    ];
}
