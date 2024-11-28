<?php

namespace App\Imports;

use App\Models\DataUser;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataUserImport implements ToModel, WithHeadingRow
{
    /**
     * Map data ke model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DataUser([
            'nama'               => $row['nama'],
            'pendapatan'         => $row['pendapatan'],
            'kepemilikan_aset'   => $row['kepemilikan_aset'],
            'jumlah_tanggungan'  => $row['jumlah_tanggungan'],
            'terdaftar_dkts'     => $row['terdaftar_di_dkts'],
        ]);
    }
}
