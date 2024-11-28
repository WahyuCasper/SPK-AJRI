<?php

namespace App\Http\Controllers;

use App\Imports\DataUserImport;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataUserController extends Controller
{
    public function index()
    {
        $dataUsers = DataUser::simplePaginate(15);
        return view('data-users.index', compact('dataUsers'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new DataUserImport, $request->file('file'));

        return redirect()->route('data-users.index')->with('success', 'Data berhasil diimport!');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $dataUser = DataUser::find($id);

        // Cek apakah data ditemukan
        if (!$dataUser) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Hapus data
        $dataUser->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function destroyAll()
    {
        // Hapus semua data
        DataUser::truncate();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Semua data berhasil dihapus!');
    }

    public function edit($id)
    {
        $user = DataUser::findOrFail($id); // Ambil data masyarakat berdasarkan ID
        return view('data-users.edit', compact('user')); // Kirim data ke view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pendapatan' => 'required|numeric',
            'kepemilikan_aset' => 'required|numeric',
            'jumlah_tanggungan' => 'required|numeric',
            'terdaftar_dkts' => 'required|string',
        ]);

        $user = DataUser::findOrFail($id);
        $user->update($validated); // Update data masyarakat dengan data yang divalidasi

        return redirect()->route('data-users.index')->with('success', 'Data masyarakat berhasil diperbarui!');
    }

}
