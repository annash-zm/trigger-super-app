<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prapemicuan extends Model
{
    //
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'village_id',
        'desa',
        'district_id',
        'kecamatan',
        'nama_kegiatan',
        'tanggal',
        'jumlah_dusun',
        'jumlah_rt',
        'jumlah_jiwa',
        'status'
    ];
}

