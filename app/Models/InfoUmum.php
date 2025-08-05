<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUmum extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'id_prapemicuans',
        'jml_spot_pembuangan',
        'foto_spot_pembuangan',
        'lokasi_spot_pembuangan',
        'iuran',
        'no_kontak_bumdes',
    ];

    // timestamps aktif (karena ada created_at dan updated_at)
    public $timestamps = true;

    // Relasi ke tabel prapemicuans (jika kamu punya)
    public function prapemicuan()
    {
        return $this->belongsTo(Prapemicuan::class, 'id_prapemicuans');
    }

}
