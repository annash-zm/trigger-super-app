<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Fasilitator;
use App\Models\Prapemicuan;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FasilitatorController extends Controller
{
    //
    public function index()
    {
        $desaPemicuan = count(Prapemicuan::all());
        $data = [
            'title' => 'Fasilitator',
            'desaPemicuan' => $desaPemicuan
        ];
        return view('fasilitator.dFasilitator', $data);
    }

    public function listdesa()
    {
        $kegiatan =  Prapemicuan::paginate(6);
        $prapemicuan = [];
        $z = 0;
        foreach ($kegiatan as $r) {
            $village = Villages::where('name', 'like', '%' . $r['desa'] . '%')->first();
            $district = Districts::where('id', '=', $village['district_id'])->first();
            $prapemicuan[$z] = [
                'id' => $r['id'],
                'tanggal' => $r['tanggal'],
                'desa' => $r['desa'],
                'district_name' => $district['name'],
                'status' => !empty(Fasilitator::where('id_prapemicuans', $r['id'])->first()) ? '1' : '0'
            ];
            $z++;
        }
        $data = [
            'title' => 'List Desa Pemicuan',
            'kegiatan' => $prapemicuan,
            'page' => $kegiatan,
        ];
        return view('fasilitator.listDesa', $data);
    }

    public function tohasilpemicuan(String $id)
    {
        $id_prapemicuan = Crypt::decrypt($id);
        $getPemicuan = Fasilitator::where('id_prapemicuans', $id_prapemicuan)
            ->first();
        $data = [
            'title' => 'Input Hasil Pemicuan',
            'idPemicuan' => $id,
            'data' => empty($getPemicuan) ? [] : $getPemicuan,
            'desa' => Prapemicuan::where('id', $id_prapemicuan)->first() 
        ];
        return view('fasilitator.inputHasil', $data);
    }

    public function hasilPemicuan(Request $request)
    {
        $request->validate([
            'rt' => 'required',
            'rw' => 'required',
            'jml_peserta' => 'required',
            'jml_berlangganan' => 'required',
            'usulan_rkm' => 'required',
            'berkas.*' => 'required|file|mimes:pdf,jpg,jpeg,png, JPG, PNG, JPEG',
            'dokumentasi.*' => 'required|image|mimes:jpeg,jpg,png, JPG, PNG, JPEG',
        ]);

        $cek = Fasilitator::where('id_prapemicuans', Crypt::decrypt($request->idpemicuan))
            ->first();

        $fileDokumentasi = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {

                $file->store('storage/dokumentasi/');
                $fileDokumentasi[] = [
                    'fileId' => $file->hashName(),
                    'fileName' => $file->getClientOriginalName()
                ];
            }
        }

        $berkas = [];
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $file) {
                $file->store('storage/berkas/');
                $berkas[] = [
                    'fileId' => $file->hashName(),
                    'fileName' => $file->getClientOriginalName()
                ];
            }
        }

        if (empty($cek)) {
            Fasilitator::create([
                'id_prapemicuans' => Crypt::decrypt($request->idpemicuan),
                'rt' => $request->rt,
                'rw' => $request->rw,
                'jml_peserta' => $request->jml_peserta,
                'jml_berlangganan' => $request->jml_berlangganan,
                'usulan_rkm' => $request->usulan_rkm,
                'berkas' => json_encode($berkas),
                'dokumentasi' => json_encode($fileDokumentasi)
            ]);
        } else {
            //data berkas dan dokumentasi
            $dataBerkas = json_decode($cek['berkas'], true);
            $berkas != [] && $dataBerkas = array_merge($dataBerkas, $berkas);

            $dataDokumentasi = json_decode($cek['dokumentasi'], true);
            $fileDokumentasi != [] && $dataDokumentasi = array_merge($dataDokumentasi, $fileDokumentasi);

            Fasilitator::where('id_prapemicuans', Crypt::decrypt($request->idpemicuan))
                ->update([
                    'id_prapemicuans' => Crypt::decrypt($request->idpemicuan),
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'jml_peserta' => $request->jml_peserta,
                    'jml_berlangganan' => $request->jml_berlangganan,
                    'usulan_rkm' => $request->usulan_rkm,
                    'berkas' => json_encode($dataBerkas),
                    'dokumentasi' => json_encode($dataDokumentasi)
                ]);
        }


        return [
            'status' => true,
            'url' => empty($cek) ? 'back' : 'reload'
        ];
    }

    public function search(Request $request)
    {
        $input = $request->input('query');
        $kegiatan = $input == '' ? Prapemicuan::paginate(6) : Prapemicuan::all();
        $prapemicuan = [];
        $z = 0;
        foreach ($kegiatan as $r) {
            $village = Villages::where('name', 'like', '%' . $r['desa'] . '%')->first();
            $district = Districts::where('id', '=', $village['district_id'])->first();
            $prapemicuan[$z] = [
                'id' => $r['id'],
                'tanggal' => $r['tanggal'],
                'desa' => $r['desa'],
                'district_name' => $district['name'],
                'status' => !empty(Fasilitator::where('id_prapemicuans', $r['id'])->first()) ? '1' : '0'
            ];
            $z++;
        }

        //search by array result
        
        $keywords = explode(' ', strtolower($input));

        $results = collect($prapemicuan)->filter(function ($item) use ($keywords) {
            $village = strtolower($item['desa']);
            $district   = strtolower($item['district_name']);

            // Semua keyword harus cocok di fileName atau fileId
            foreach ($keywords as $word) {
                if (stripos($village, $word) === false && stripos($district, $word) === false) {
                    return false;
                }
            }

            return true;
        })->values()->all();

        $data = [
            'title' => 'List Desa Pemicuan',
            'kegiatan' => $results,
            'page' => $input == '' ? $kegiatan : [],
        ];

        return view('fasilitator.search_result', $data);
    }

    public function deleteFile(Request $request)
    {
        $idpemicuan = Crypt::decrypt($request->idpemicuan);
        $fileId = $request->fileId;
        $type = $request->type;

        if ($type == 'berkas') {
            $filePath = public_path('storage/berkas/'.$fileId);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $berkas = Fasilitator::where('id_prapemicuans', $idpemicuan)->first();
            $databerkas = json_decode($berkas['berkas'], true); // jadi array

            // Filter yang tidak cocok
            $files = array_filter($databerkas, fn($file) => $file['fileId'] !== $fileId);

            // Reindex array dan encode ulang
            $newJson = json_encode(array_values($files));

            Fasilitator::where('id_prapemicuans', $idpemicuan)->update([
                'berkas' => $newJson
            ]);
        }
        else {
            $filePath = public_path('storage/dokumentasi/'.$fileId);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $dokumentasi = Fasilitator::where('id_prapemicuans', $idpemicuan)->first();
            $datadokumentasi = json_decode($dokumentasi['dokumentasi'], true); // jadi array

            // Filter yang tidak cocok
            $files = array_filter($datadokumentasi, fn($file) => $file['fileId'] !== $fileId);

            // Reindex array dan encode ulang
            $newJson = json_encode(array_values($files));

            Fasilitator::where('id_prapemicuans', $idpemicuan)->update([
                'dokumentasi' => $newJson
            ]);
        }

        return [
            'status' => true
        ];
    }
}
