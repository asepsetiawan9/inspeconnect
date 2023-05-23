<?php

namespace App\Http\Controllers;
use App\Models\Population;
use Alert;

use Illuminate\Http\Request;

class PopulationDataController extends Controller
{

    public function index()
    {
        $populations = Population::paginate(5);

        return view('populationdata.index', compact('populations'));
    }
    public function create()
    {
        return view('populationdata.create');
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'jumlah_penduduk' => 'required|numeric',
            'jumlah_kk' => 'required|numeric',
            'jumlah_laki_laki' => 'required|numeric',
            'jumlah_perempuan' => 'required|numeric',
            'tahun' => 'required|numeric',
        ]);

        $population = Population::create($attributes);

        if ($population) {
            Alert::success('Sukses', 'Data Penduduk berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('population-data');
    }

    public function edit($id)
    {
        $population = Population::find($id);
        if (!$population) {
            return redirect('population-data')->with('error', 'Pengguna tidak ditemukan.');
        }
        return view('populationdata.edit', compact('population'));
    }

    public function update(Request $request, $id)
    {

        $population = Population::findOrFail($id);

        $population->jumlah_penduduk = $request->jumlah_penduduk;
        $population->jumlah_kk = $request->jumlah_kk;
        $population->jumlah_laki_laki = $request->jumlah_laki_laki;
        $population->jumlah_perempuan = $request->jumlah_perempuan;
        $population->tahun = $request->tahun;

        $population->save();

        if ($population) {
            Alert::success('Sukses', 'Data berhasil diubah.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('population-data');
    }

    public function confirmDelete($id)
    {
        $population = Population::findOrFail($id);
        return view('populationdata.confirm-delete', compact('population'));
    }

    public function delete($id)
    {
        $population = Population::findOrFail($id);

        if ($population->delete()) {
            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('population-data');
    }

}
