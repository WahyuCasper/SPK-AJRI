<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'pendapatan',
        'kepemilikan_aset',
        'jumlah_tanggungan',
        'terdaftar_dkts',
    ];
}
