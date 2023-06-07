<?php

namespace App\Http\Controllers;
use App\Models\Population;
use RealRashid\SweetAlert\Facades\Alert;

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
        $population->garut_kota = $request->garut_kota;
        $population->karangpawitan = $request->karangpawitan;
        $population->wanaraja = $request->wanaraja;
        $population->tarogong_kaler = $request->tarogong_kaler;
        $population->tarogong_kidul = $request->tarogong_kidul;
        $population->banyuresmi = $request->banyuresmi;
        $population->samarang = $request->samarang;
        $population->pasirwangi = $request->pasirwangi;
        $population->leles = $request->leles;
        $population->kadungora = $request->kadungora;
        $population->leuwigoong = $request->leuwigoong;
        $population->cibatu = $request->cibatu;
        $population->kersamanah = $request->kersamanah;
        $population->malangbong = $request->malangbong;
        $population->sukawening = $request->sukawening;
        $population->karangtengah = $request->karangtengah;
        $population->bayongbong = $request->bayongbong;
        $population->cigedug = $request->cigedug;
        $population->cilawu = $request->cilawu;
        $population->cisurupan = $request->cisurupan;
        $population->sukaresmi = $request->sukaresmi;
        $population->cikajang = $request->cikajang;
        $population->banjarwangi = $request->banjarwangi;
        $population->singajaya = $request->singajaya;
        $population->cihurip = $request->cihurip;
        $population->peundeuy = $request->peundeuy;
        $population->pameungpeuk = $request->pameungpeuk;
        $population->cisompet = $request->cisompet;
        $population->cibalong = $request->cibalong;
        $population->cikelet = $request->cikelet;
        $population->bungbulang = $request->bungbulang;
        $population->mekarmukti = $request->mekarmukti;
        $population->pakenjeng = $request->pakenjeng;
        $population->pamulihan = $request->pamulihan;
        $population->cisewu = $request->cisewu;
        $population->caringin = $request->caringin;
        $population->talegong = $request->talegong;
        $population->balubur_limbangan = $request->balubur_limbangan;
        $population->selaawi = $request->selaawi;
        $population->cibiuk = $request->cibiuk;
        $population->pangatikan = $request->pangatikan;
        $population->sucinaraja = $request->sucinaraja;

        if ($population->save()) {
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
        $population->garut_kota = $request->garut_kota;
        $population->karangpawitan = $request->karangpawitan;
        $population->wanaraja = $request->wanaraja;
        $population->tarogong_kaler = $request->tarogong_kaler;
        $population->tarogong_kidul = $request->tarogong_kidul;
        $population->banyuresmi = $request->banyuresmi;
        $population->samarang = $request->samarang;
        $population->pasirwangi = $request->pasirwangi;
        $population->leles = $request->leles;
        $population->kadungora = $request->kadungora;
        $population->leuwigoong = $request->leuwigoong;
        $population->cibatu = $request->cibatu;
        $population->kersamanah = $request->kersamanah;
        $population->malangbong = $request->malangbong;
        $population->sukawening = $request->sukawening;
        $population->karangtengah = $request->karangtengah;
        $population->bayongbong = $request->bayongbong;
        $population->cigedug = $request->cigedug;
        $population->cilawu = $request->cilawu;
        $population->cisurupan = $request->cisurupan;
        $population->sukaresmi = $request->sukaresmi;
        $population->cikajang = $request->cikajang;
        $population->banjarwangi = $request->banjarwangi;
        $population->singajaya = $request->singajaya;
        $population->cihurip = $request->cihurip;
        $population->peundeuy = $request->peundeuy;
        $population->pameungpeuk = $request->pameungpeuk;
        $population->cisompet = $request->cisompet;
        $population->cibalong = $request->cibalong;
        $population->cikelet = $request->cikelet;
        $population->bungbulang = $request->bungbulang;
        $population->mekarmukti = $request->mekarmukti;
        $population->pakenjeng = $request->pakenjeng;
        $population->pamulihan = $request->pamulihan;
        $population->cisewu = $request->cisewu;
        $population->caringin = $request->caringin;
        $population->talegong = $request->talegong;
        $population->balubur_limbangan = $request->balubur_limbangan;
        $population->selaawi = $request->selaawi;
        $population->cibiuk = $request->cibiuk;
        $population->pangatikan = $request->pangatikan;
        $population->sucinaraja = $request->sucinaraja;

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
