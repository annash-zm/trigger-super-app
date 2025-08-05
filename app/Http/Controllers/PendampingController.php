<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\InfoDana;
use App\Models\InfoDesa;
use App\Models\InfoPengelolaanSampah;
use App\Models\InfoUmum;
use App\Models\Prapemicuan;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class PendampingController extends Controller
{
    //

    public function index()
    {
        $desaPemicuan = count(Prapemicuan::all());

        $spotPembuangan = InfoUmum::sum('jml_spot_pembuangan');
        $titikPemicuan = InfoPengelolaanSampah::sum('jumlah_titik_pemicuan');

        $data = [
            'title' => 'Pendamping',
            'desaPemicuan' => $desaPemicuan,
            'spotPembuangan' => $spotPembuangan,
            'titikPemicuan' => $titikPemicuan
        ];
        return view('fasilitator.dfasilitator', $data);
    }

    public function listKegiatan()
    {
        $kegiatan =  Prapemicuan::paginate(5);
        $prapemicuan = [];
        $z = 0;
        foreach ($kegiatan as $r) {
            $village = Villages::where('name', 'like', '%' . $r['desa'] . '%')->first();
            $district = Districts::where('id', '=', $village['district_id'])->first();
            $prapemicuan[$z] = [
                'id' => $r['id'],
                'kegiatan' => $r['nama_kegiatan'],
                'tanggal' => $r['tanggal'],
                'desa' => $r['desa'],
                'dokumentasi' => $r['input_foto_spot_pembuangan'],
                'village_id' => $village['id'],
                'district_id' => $district['id'],
                'district_name' => $district['name'],
            ];
            $z++;
        }
        $data = [
            'title' => 'Kegiatan',
            'kegiatan' => $prapemicuan,
            'page' => $kegiatan,
            'formprapemicuan' => view('admin.formprapemicuan'),
        ];
        return view('pendamping.prapemicuan', $data);
    }

    public function selectInputPemicuan(String $id)
    {
        $id = Crypt::decrypt($id);
        $prapemicuan = Prapemicuan::where('id', $id)->first();

        //get progress Info desa
        $cekInfoDesa = InfoDesa::where('id_prapemicuans', $id)->first();
        $progressInfoDesa = !empty($cekInfoDesa) ? $this->cekProgress($cekInfoDesa, 10) : 0;

        //get progress Info kelola sampah
        $cekInfoKelolaSampah = InfoPengelolaanSampah::where('id_prapemicuans', $id)->first();
        $progressKelolaSampah = !empty($cekInfoKelolaSampah) ? $this->cekProgress($cekInfoKelolaSampah, 16) : 0;

        //get progress Info Umum
        $cekInfoUmum = InfoUmum::where('id_prapemicuans', $id)->first();
        $progressUmum = !empty($cekInfoUmum) ? $this->cekProgress($cekInfoUmum, 9) : 0;

        //get progress Info Dana
        $cekInfoDana = InfoDana::where('id_prapemicuans', $id)->first();
        $progressDana = !empty($cekInfoDana) ? $this->cekProgress($cekInfoDana, 12) : 0;

        $data = [
            'title' => 'Kategori Pra Pemicuan',
            'prapemicuan' => $prapemicuan,
            'progressInfoDesa' => number_format($progressInfoDesa, 2) . '%',
            'progressKelolaSampah' => number_format($progressKelolaSampah, 2) . '%',
            'progressDana' => number_format($progressDana, 2) . '%',
            'progressUmum' => number_format($progressUmum, 2) . '%',
            'modified' => [
                'infoDesa' => !empty($cekInfoDesa) ? $cekInfoDesa['updated_at'] : 'belum diinput',
                'infoKelolaSampah' => !empty($cekInfoKelolaSampah) ? $cekInfoKelolaSampah['updated_at'] : 'belum diinput',
                'infoDana' => !empty($cekInfoDana) ? $cekInfoDana['updated_at'] : 'belum diinput',
                'infoUmum' => !empty($cekInfoUmum) ? $cekInfoUmum['updated_at'] : 'belum diinput',
            ]
        ];
        return view('pendamping.kategoripemicuan', $data);
    }

    public function cekProgress($data, $total)
    {
        $progress = (collect($data->toArray())
            ->filter(function ($value) {
                return !is_null($value) && $value !== null;
            })
            ->count() / $total) * 100;
        return $progress;
    }

    public function infodesa(String $id)
    {
        $prapemicuan = Prapemicuan::where('id', Crypt::decrypt($id))->first();
        $infoDesa = InfoDesa::where('id_prapemicuans', Crypt::decrypt($id))->first();
        $data = [
            'title' => 'Data Pemicuan',
            'data' => $prapemicuan,
            'dataDesa' => $infoDesa
        ];
        return view('pendamping.forminfodesa', $data);
    }

    public function saveInfoDesa(Request $request)
    {
        // $request->validate([
        //     'rw' => 'required',
        //     'pendidikan' => 'required',
        //     'pekerjaan' => 'required',
        //     'kelembagaan' => 'required',
        //     'nama_tokoh' => 'required',
        //     'no_hp_tokoh' => 'required',
        // ]);
        $infodesa = InfoDesa::where('id_prapemicuans', Crypt::decrypt($request->id_prapemicuan))->first();
        if (empty($infodesa)) {
            InfoDesa::create([
                'id_prapemicuans' => Crypt::decrypt($request->id_prapemicuan),
                'jumlah_rw' => $request->rw,
                'pendidikan_warga' => $request->pendidikan,
                'pekerjaan_masyarakat' => $request->pekerjaan,
                'kelembagaan_sosial' => $request->kelembagaan,
                'nama_tokoh' => $request->nama_tokoh,
                'nomor_hp_tokoh' => $request->no_hp_tokoh,
            ]);
        } else {
            InfoDesa::where('id_prapemicuans', Crypt::decrypt($request->id_prapemicuan))
                ->update([
                    //'id_prapemicuans' => Crypt::decrypt($request->id_prapemicuan),
                    'jumlah_rw' => $request->rw,
                    'pendidikan_warga' => $request->pendidikan,
                    'pekerjaan_masyarakat' => $request->pekerjaan,
                    'kelembagaan_sosial' => $request->kelembagaan,
                    'nama_tokoh' => $request->nama_tokoh,
                    'nomor_hp_tokoh' => $request->no_hp_tokoh,
                ]);
        }

        return [
            'status' => true
        ];
    }

    public function infoKelolaSampah(String $id)
    {
        $id = Crypt::decrypt($id);
        $prapemicuan = Prapemicuan::where('id', $id)
            ->first();
        $infoKelolaSampah = InfoPengelolaanSampah::where('id_prapemicuans', $id)
            ->first();
        $kelolaSampah = [
            'dibakar',
            'dibuang ke Sungai',
            'dibuang ke lahan kosong',
            'di buang ke lupang galian'
        ];
        $geografis = [
            'Daratan',
            'Perairan',
            'Pantai',
            'Pegunungan',
            'Lainnya'
        ];

        $layanan_kelola_sampah = [
            'layanan dari desa',
            'layanan swasta',
            'bank sampah',
            'tidak ada layanan'
        ];

        $kegRutin = [
            'Kerja Bakti',
            'Pengajian',
            'Posyandu',
            'Pertemuan PKK',
            'Kegiatan desa'
        ];

        $waktuRutin = [
            'Mingguan',
            'Bulanan'
        ];
        $data = [
            'title' => 'Input Pengelolaan Sampah',
            'data' => $prapemicuan,
            'dataKelolaSampah' => $infoKelolaSampah,
            'kelolaSampah' => $kelolaSampah,
            'geografis' => $geografis,
            'layanan' => $layanan_kelola_sampah,
            'kegRutin' => $kegRutin,
            'waktuRutin' => $waktuRutin
        ];
        return view('pendamping.formkelolasampah', $data);
    }


    public function saveKelolaSampah(Request $request)
    {
        $idPrapemicuan = Crypt::decrypt($request->id_prapemicuans);

        $cek = InfoPengelolaanSampah::where('id_prapemicuans', $idPrapemicuan)->first();

        $pic = $request->kandidat_pic_kelola_sampah;
        $no_hp_pic = $request->no_hp_pic;

        if (empty($cek)) {

            InfoPengelolaanSampah::create([
                'id_prapemicuans'        => $idPrapemicuan,
                'pengelolaan_sampah'     => $request->pengelolaan_sampah,
                'kondisi_geografis'      => $request->kondisi_geografis,
                'sarana_dan_prasarana_umum_desa' => $request->sarana_dan_prasarana_umum_desa,
                'layanan_kelola_sampah'         => !empty($request->layanan_kelola_sampah) ? implode(';', $request->layanan_kelola_sampah) : '',
                'kegiatan_rutin'         => $request->kegiatan_rutin,
                'waktu_keg_rutin'   => $request->waktu_keg_rutin,
                'kandidat_pic_kelola_sampah' => $pic,
                'no_hp_pic' => $no_hp_pic,
                'lokasi_pemicuan'        => $request->lokasi_pemicuan,
                'lokasi_d2d'             => $request->lokasi_d2d,
                'tanggal_pemicuan'       => $request->tanggal_pemicuan,
                'jumlah_titik_pemicuan'  => $request->jumlah_titik_pemicuan,
            ]);
        } else {
            InfoPengelolaanSampah::where('id_prapemicuans', $idPrapemicuan)->update([
                'id_prapemicuans'        => $idPrapemicuan,
                'pengelolaan_sampah'     => $request->pengelolaan_sampah,
                'kondisi_geografis'      => $request->kondisi_geografis,
                'sarana_dan_prasarana_umum_desa' => $request->sarana_dan_prasarana_umum_desa,
                'layanan_kelola_sampah'         => !empty($request->layanan_kelola_sampah) ? implode(';', $request->layanan_kelola_sampah) : '',
                'kegiatan_rutin'         => $request->kegiatan_rutin,
                'waktu_keg_rutin'   => $request->waktu_keg_rutin,
                'kandidat_pic_kelola_sampah' => $pic,
                'no_hp_pic' => $no_hp_pic,
                'lokasi_pemicuan'        => $request->lokasi_pemicuan,
                'lokasi_d2d'             => $request->lokasi_d2d,
                'tanggal_pemicuan'       => $request->tanggal_pemicuan,
                'jumlah_titik_pemicuan'  => $request->jumlah_titik_pemicuan,
            ]);
        }

        return [
            'status' => true
        ];
    }

    public function pendanaan(String $id)
    {
        $prapemicuan = Prapemicuan::where('id', Crypt::decrypt($id))->first();
        $infoPendanaan = InfoDana::where('id_prapemicuans', Crypt::decrypt($id))->first();
        $data = [
            'title' => 'Info Pendanaan',
            'data' => $prapemicuan,
            'dataDana' => $infoPendanaan
        ];
        return view('pendamping.formDana', $data);
    }

    public function saveInfoDana(Request $request)
    {
        $idPrapemicuan = Crypt::decrypt($request->id_prapemicuan);

        $cek = InfoDana::where('id_prapemicuans', $idPrapemicuan)->first();
        if (empty($cek)) {
            InfoDana::create([
                'id_prapemicuans' => $idPrapemicuan,
                'dana_konsumsi_desa' => $request->konsumsi_desa,
                'dana_konsumsi_puskesmas' => $request->konsumsi_puskesmas,
                'dana_konsumsi_dinkes' => $request->konsumsi_dinkes,
                'dana_konsumsi_bwihijau' => $request->konsumsi_bwi_hijau,
                'dana_honor_desa' => $request->honor_desa,
                'dana_honor_puskesmas' => $request->honor_puskesmas,
                'dana_honor_dinkes' => $request->honor_dinkes,
                'dana_honor_bwihijau' => $request->honor_bwi_hijau
            ]);
        } else {
            InfoDana::where('id_prapemicuans', $idPrapemicuan)->update([
                'id_prapemicuans' => $idPrapemicuan,
                'dana_konsumsi_desa' => $request->konsumsi_desa,
                'dana_konsumsi_puskesmas' => $request->konsumsi_puskesmas,
                'dana_konsumsi_dinkes' => $request->konsumsi_dinkes,
                'dana_konsumsi_bwihijau' => $request->konsumsi_bwi_hijau,
                'dana_honor_desa' => $request->honor_desa,
                'dana_honor_puskesmas' => $request->honor_puskesmas,
                'dana_honor_dinkes' => $request->honor_dinkes,
                'dana_honor_bwihijau' => $request->honor_bwi_hijau,
                //'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        return [
            'status' => true
        ];
    }

    public function infoumum(String $id)
    {
        $prapemicuan = Prapemicuan::where('id', Crypt::decrypt($id))->first();
        $infoUmum = InfoUmum::where('id_prapemicuans', Crypt::decrypt($id))->first();
        $latlong = !empty($infoUmum) ? json_decode($infoUmum['lokasi_spot_pembuangan']) : [];
        $data = [
            'title' => 'Informasi Umum',
            'data' => $prapemicuan,
            'dataUmum' => $infoUmum,
            'lokasi' => [
                'lat' => $latlong != [] ? $latlong[0] : '',
                'long' => $latlong != [] ? $latlong[1] : ''
            ]
        ];
        return view('pendamping.formInfoUmum', $data);
    }

    public function saveInfoUmum(Request $request)
    {
        $idPrapemicuan = Crypt::decrypt($request->id_prapemicuans);

        $cek = InfoUmum::where('id_prapemicuans', $idPrapemicuan)->first();
        //foto
        $fotospotpembuangan = [];
        if ($request->hasFile('foto_spot_pembuangan')) {
            foreach ($request->file('foto_spot_pembuangan') as $file) {
                $file->store('storage/foto_spot_pembuangan/');
                $fotospotpembuangan[] = [
                    'fileId' => $file->hashName(),
                    'fileName' => $file->getClientOriginalName()
                ];
            }
        }
        if (empty($cek)) {
            InfoUmum::create([
                'id_prapemicuans'       => $idPrapemicuan,
                'jml_spot_pembuangan'   => $request->jml_spot_pembuangan,
                'foto_spot_pembuangan'  => $fotospotpembuangan != [] ? json_encode($fotospotpembuangan) : null,
                'lokasi_spot_pembuangan' => json_encode([$request->lat, $request->long]),
                'iuran'                 => $request->iuran,
                'no_kontak_bumdes'      => $request->no_kontak_bumdes,
            ]);
        } else {
            $foto_spot = $cek['foto_spot_pembuangan'] != null ? json_decode($cek['foto_spot_pembuangan'], true) : [];
            $fotospotpembuangan != [] && $foto_spot = array_merge($foto_spot, $fotospotpembuangan);
            InfoUmum::where('id_prapemicuans', $idPrapemicuan)->update([
                'id_prapemicuans'       => $idPrapemicuan,
                'jml_spot_pembuangan'   => $request->jml_spot_pembuangan,
                'foto_spot_pembuangan'  => $foto_spot != [] ? json_encode($foto_spot) : null,
                'lokasi_spot_pembuangan' => json_encode([$request->lat, $request->long]),
                'iuran'                 => $request->iuran,
                'no_kontak_bumdes'      => $request->no_kontak_bumdes,
            ]);
        }

        return [
            'status' => true
        ];
    }

    public function villageView(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $prapemicuan = Prapemicuan::where('id', $id)->first();

        $infoUmum = InfoUmum::where('id_prapemicuans', $id)->first();
        return [
            'iddist' => $prapemicuan['district_id'],
            'idvill' => $prapemicuan['village_id'],
            'latlong' => !empty($infoUmum) ? json_decode($infoUmum['lokasi_spot_pembuangan']) : null
        ];
    }

    public function delFotoSpot(Request $request)
    {
        $idpemicuan = Crypt::decrypt($request->idpemicuan);
        $fileId = $request->fileId;
        $filePath = public_path('storage/foto_spot_pembuangan/' . $fileId);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $foto_spot = InfoUmum::where('id_prapemicuans', $idpemicuan)->first();
        $foto_spot_pembuangan = json_decode($foto_spot['foto_spot_pembuangan'], true); // jadi array

        // Filter yang tidak cocok
        $files = array_filter($foto_spot_pembuangan, fn($file) => $file['fileId'] !== $fileId);

        // Reindex array dan encode ulang
        $newJson = json_encode(array_values($files));

        InfoUmum::where('id_prapemicuans', $idpemicuan)->update([
            'foto_spot_pembuangan' => $newJson
        ]);

        return [
            'status' => true
        ];
    }


    // public function todistrict()
    // {
    //     $dist = Districts::all();
    //     foreach ($dist as $item) {
    //         $url = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $item['id'] . '.json';

    //         $response = Http::get($url);

    //         if ($response->successful()) {
    //             foreach (json_decode($response) as $item) {
    //                 Villages::create([
    //                     'id' => $item->id,
    //                     'district_id' => $item->district_id,
    //                     'name' => $item->name,
    //                     'alt_name' => '',
    //                     'latitude' => 0,
    //                     'longitude' => 0
    //                 ]);
    //             }
    //         }
    //     }

    //     return $response;
    // }
}
