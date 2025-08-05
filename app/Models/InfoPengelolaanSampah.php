<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPengelolaanSampah extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'id_prapemicuans',
        'pengelolaan_sampah',
        'kondisi_geografis',
        'sarana_dan_prasarana_umum_desa',
        'layanan_kelola_sampah',
        'kegiatan_rutin',
        'waktu_keg_rutin',
        'kandidat_pic_kelola_sampah',
        'no_hp_pic',
        'lokasi_pemicuan',
        'lokasi_d2d',
        'tanggal_pemicuan',
        'jumlah_titik_pemicuan',
    ];
}
