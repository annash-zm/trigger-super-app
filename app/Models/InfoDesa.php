<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoDesa extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'id_prapemicuans',
        'jumlah_rw',
        'pendidikan_warga',
        'pekerjaan_masyarakat',
        'kelembagaan_sosial',
        'nama_tokoh',
        'nomor_hp_tokoh'
    ];
}
