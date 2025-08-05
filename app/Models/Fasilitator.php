<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitator extends Model
{
    use HasFactory;
    protected $table = 'fasilitator';
    protected $fillable = [
        'id_prapemicuans',
        'rt',
        'rw',
        'jml_peserta',
        'jml_berlangganan',
        'usulan_rkm',
        'berkas',
        'dokumentasi',
    ];
}
