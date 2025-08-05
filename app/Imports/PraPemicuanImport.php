<?php

namespace App\Imports;

use App\Models\Districts;
use App\Models\Prapemicuan;
use App\Models\Villages;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PraPemicuanImport implements ToCollection, WithCalculatedFormulas
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
        $idx = 1;
        foreach ($collection as $row) {
            if ($idx > 1) {
                $village = Villages::where('name', 'like', '%' . strtoupper($row[0]) . '%')
                    ->first();
                $district = Districts::where('id', '=', $village['district_id'])
                    ->first();
                
                Prapemicuan::create([
                    'village_id' => $village['id'],
                    'desa' => strtoupper($row[0]),
                    'district_id' => $district['id'],
                    'kecamatan' => $district['name'],
                    'nama_kegiatan' => $row[1],
                    'tanggal' => $this->excelDate($row[2])->format("Y-m-d"),
                    'jumlah_dusun' => $row[3],
                    'jumlah_rt' => $row[5],
                    'jumlah_jiwa' => $row[6]
                ]);
            }
            $idx++;
        }
    }

    public function excelDate($excelDate)
    {

        return is_numeric($excelDate)
            ? Carbon::instance(Date::excelToDateTimeObject($excelDate))
            : Carbon::parse($excelDate);
    }
}
