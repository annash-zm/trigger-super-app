<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoDana extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'id_prapemicuans',
        'dana_konsumsi_desa',
        'dana_konsumsi_puskesmas',
        'dana_konsumsi_dinkes',
        'dana_konsumsi_bwihijau',
        'dana_honor_desa',
        'dana_honor_puskesmas',
        'dana_honor_dinkes',
        'dana_honor_bwihijau'
    ];
}
