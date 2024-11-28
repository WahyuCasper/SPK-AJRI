<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        $dataUsers = DataUser::cursorPaginate(10);
        return view('data-users.analisis', compact('dataUsers'));
    }

    public function updateDataUsers(Request $request)
    {
        // Memperbarui Pendapatan berdasarkan rentang nilai
        DataUser::chunk(100, function ($users) {
            foreach ($users as $user) {
                // Update Pendapatan
                if ($user->pendapatan >= 3500001) {
                    $user->pendapatan = 1;  // 1 jika pendapatan antara 0 - 1.000.000
                } elseif ($user->pendapatan >= 2500001 && $user->pendapatan <= 3500000) {
                    $user->pendapatan = 2;  // 2 jika pendapatan antara 1.000.001 - 3.000.000
                } elseif ($user->pendapatan >= 1500001 && $user->pendapatan <= 2500000) {
                    $user->pendapatan = 3;  // 3 jika pendapatan antara 3.000.001 - 5.000.000
                } elseif ($user->pendapatan >= 500000 && $user->pendapatan <= 1500000) {
                    $user->pendapatan = 4;  // 3 jika pendapatan antara 3.000.001 - 5.000.000
                } elseif ($user->pendapatan <= 499999) {
                    $user->pendapatan = 5;  // 3 jika pendapatan antara 3.000.001 - 5.000.000
                }

                if ($user->jumlah_tanggungan == 0) {
                    $user->jumlah_tanggungan = 1;  // Jika jumlah tanggungan 0
                } elseif ($user->jumlah_tanggungan >= 1 && $user->jumlah_tanggungan <= 2) {
                    $user->jumlah_tanggungan = 2;  // Jika jumlah tanggungan antara 1 dan 2
                } elseif ($user->jumlah_tanggungan >= 3 && $user->jumlah_tanggungan <= 5) {
                    $user->jumlah_tanggungan = 3;  // Jika jumlah tanggungan antara 3 dan 5
                } elseif ($user->jumlah_tanggungan >= 6 && $user->jumlah_tanggungan <= 7) {
                    $user->jumlah_tanggungan = 4;  // Jika jumlah tanggungan antara 6 dan 7
                } elseif ($user->jumlah_tanggungan >= 8) {
                    $user->jumlah_tanggungan = 5;  // Jika jumlah tanggungan lebih dari atau sama dengan 8
                }
                

                if ($user->kepemilikan_aset >= 7) {
                    $user->kepemilikan_aset = 1;  // 1 jika pendapatan antara 0 - 1.000.000
                } elseif ($user->kepemilikan_aset >= 5 && $user->kepemilikan_aset <= 6) {
                    $user->kepemilikan_aset = 2;  // 2 jika pendapatan antara 1.000.001 - 3.000.000
                } elseif ($user->kepemilikan_aset >= 3 && $user->kepemilikan_aset <= 4) {
                    $user->kepemilikan_aset = 3;  // 3 jika pendapatan antara 3.000.001 - 5.000.000
                } elseif ($user->kepemilikan_aset >= 0 && $user->kepemilikan_aset <= 2) {
                    $user->kepemilikan_aset = 4;  // 3 jika pendapatan antara 3.000.001 - 5.000.000
                }

                // Update Terdaftar di DKTS
                if ($user->terdaftar_dkts == 'Ya') {
                    $user->terdaftar_dkts = 4;  // 2 jika Terdaftar di DKTS adalah Ya
                } elseif ($user->terdaftar_dkts == 'Tidak') {
                    $user->terdaftar_dkts = 2;  // 4 jika Terdaftar di DKTS adalah Tidak
                }

                // Simpan perubahan ke database
                $user->save();
            }
        });

        // Mengambil semua data pengguna yang telah diperbarui
        $dataUsers = DataUser::all();

        // Mengarahkan kembali dengan data yang telah diperbarui
        return redirect()->route('data-users.analisis')->with('success', 'Data berhasil diperbarui!');
    }

    public function hitungSAW()
{
    // Ambil data user dengan pagination
    $dataUsers = DataUser::cursorPaginate(10); // 10 items per page

    // Inisialisasi variabel untuk menampung hasil
    $hasilSAW = [];

    // Menentukan nilai minimum dan maksimum untuk normalisasi
    $pendapatanMin = DataUser::min('pendapatan');
    $pendapatanMax = DataUser::max('pendapatan');

    $kepemilikanAsetMin = DataUser::min('kepemilikan_aset');
    $jumlahTanggunganMax = DataUser::max('jumlah_tanggungan');
    $terdaftarDktsMax = DataUser::max('terdaftar_dkts');

    // Bobot
    $bobotPendapatan = 0.3;
    $bobotKepemilikanAset = 0.2;
    $bobotJumlahTanggungan = 0.4;
    $bobotTerdaftarDkts = 0.1;

    // Proses normalisasi dan hitung skor SAW
    foreach ($dataUsers as $user) {
        // Normalisasi Pendapatan (Cost).
        $pendapatanNorm = $pendapatanMin / $user->pendapatan;

        // Normalisasi Kepemilikan Aset (Cost)
        $kepemilikanAsetNorm = $kepemilikanAsetMin / $user->kepemilikan_aset;

        // Normalisasi Jumlah Tanggungan (Benefit).
        $jumlahTanggunganNorm = $user->jumlah_tanggungan / $jumlahTanggunganMax;

        // Normalisasi Terdaftar di DKTS (Benefit)
        $terdaftarDktsNorm = $user->terdaftar_dkts / $terdaftarDktsMax;

        // Hitung skor SAW untuk user
        $skorSAW = (
            ($pendapatanNorm * $bobotPendapatan) +
            ($kepemilikanAsetNorm * $bobotKepemilikanAset) +
            ($jumlahTanggunganNorm * $bobotJumlahTanggungan) +
            ($terdaftarDktsNorm * $bobotTerdaftarDkts)
        );

        $skorSAW_p = $pendapatanNorm * $bobotPendapatan;
        $skorSAW_k = $kepemilikanAsetNorm * $bobotKepemilikanAset;
        $skorSAW_j = $jumlahTanggunganNorm * $bobotJumlahTanggungan;
        $skorSAW_t = $terdaftarDktsNorm * $bobotTerdaftarDkts;

        // Simpan skor SAW dan data pengguna
        $hasilSAW[] = [
            'user_id' => $user->id,
            'nama' => $user->nama,
            'skor' => $skorSAW,
            'min_p' => $pendapatanNorm,
            'max_k' => $kepemilikanAsetNorm,
            'max_j' => $jumlahTanggunganNorm,
            'min_t' => $terdaftarDktsNorm,
            'skorSAW_p' => $skorSAW_p,
            'skorSAW_k' => $skorSAW_k,
            'skorSAW_j' => $skorSAW_j,
            'skorSAW_t' => $skorSAW_t,
        ];
    }

    // Urutkan hasil SAW berdasarkan skor tertinggi ke terendah
    usort($hasilSAW, function ($a, $b) {
        return $b['skor'] <=> $a['skor'];
    });

    // Tampilkan hasil dalam view atau bisa disimpan dalam tabel baru
    return view('data-users.analisis', compact('hasilSAW', 'dataUsers')); // Pass both variables
}




}
