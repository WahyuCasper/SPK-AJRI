<?php

namespace App\Imports;

use App\Models\DataUser;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    public function model(array $row)
    {
        return new DataUser([
            'nama'               => $row[0],
            'pendapatan'         => $row[1],
            'kepemilikan_aset'   => $row[2],
            'jumlah_tanggungan'  => $row[3],
            'terdaftar_dkts'     => $row[4] == 'Ya' ? true : false,
        ]);
    }
}
