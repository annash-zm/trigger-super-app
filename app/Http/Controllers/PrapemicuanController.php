<?php

namespace App\Http\Controllers;

use App\Imports\PraPemicuanImport;
use App\Models\Prapemicuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PrapemicuanController extends Controller
{
    //

    public function importPraPemicuan(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PraPemicuanImport, $request->file('excel'));
        return [
            'status' => true
        ];
    }


    public function addPemicuan(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|max:255',
            'tgl' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'jumlah_peserta' => 'required',
            'notulensi' => 'required|file|mimes:pdf',
            'dokumentasi.*' => 'required|image|mimes:jpeg,jpg,png, JPG, PNG, JPEG'
        ]);



        $fileDokumentasi = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $file->store('storage/dokumentasi/');
                $fileDokumentasi[] = $file->hashName();
            }
        }


        $notulen = $request->file('notulensi');
        $notulen->store('storage/notulen/');


        Prapemicuan::create([
            'kegiatan' => $request->kegiatan,
            'tgl' => $request->tgl,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'jumlah_peserta' => $request->jumlah_peserta,
            'notulensi' => $notulen->hashName(),
            'dokumentasi' => implode(';', $fileDokumentasi)
        ]);

        return [
            'status' => true
        ];
    }

    public function uploadDokumentasi(Request $request)
    {
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $file->storeAs('storage/dokumentasi/', $file->hashName());
            }
        }
    }
}
