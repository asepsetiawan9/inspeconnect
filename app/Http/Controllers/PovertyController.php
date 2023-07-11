<?php

namespace App\Http\Controllers;
use App\Models\Desa;
use App\Models\kecamatan;
use App\Models\Poverty;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Storage;
use Str;
use View;

class PovertyController extends Controller
{
    public function index()
    {
        $povertys = Poverty::with('kecamatan', 'desa')->paginate(8);
        $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();

        return view('poverty.index', compact('povertys', 'years'));
    }
    //rumah layak huni
    public function getWorthyData()
    {
        // $povertys = Poverty::with('kecamatan', 'desa')->paginate(5);
        // $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();

        return view('poverty.layak');
    }

    public function searchData(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);

        $povertys = Poverty::where('nama', 'LIKE', '%'.$query.'%')->orWhere('nik', 'LIKE', '%' . $query . '%')->paginate(5, ['*'], 'page', $page);

        $table = View::make('poverty.partial_table', compact('povertys'))->render();
        $pagination = $povertys->links('pagination::bootstrap-4')->render();

        return response()->json([
            'table' => $table,
            'pagination' => $pagination,
        ]);
    }

    public function filterData(Request $request)
    {
        $filterKecamatan = $request->input('kecamatan');
        $filterTahun = $request->input('tahun');
        $filterStatusBantuan = $request->input('status_bantuan');
        $page = $request->input('page', 1);

        $query = Poverty::query();

        if ($filterKecamatan !== 'semua') {
            $query->where('id_kecamatan', $filterKecamatan);
        }

        if ($filterTahun !== 'semua') {
            $query->where('tahun_input', $filterTahun);
        }

        if ($filterStatusBantuan !== 'semua') {
            $query->where('status_bantuan', $filterStatusBantuan);
        }

        $povertys = $query->paginate(5, ['*'], 'page', $page);

        $table = View::make('poverty.partial_table', compact('povertys'))->render();
        $pagination = $povertys->links('pagination::bootstrap-4')->render();

        return response()->json([
            'table' => $table,
            'pagination' => $pagination,
        ]);
    }


    public function create()
    {
        return view('poverty.create');
    }
    public function store(Request $request)
    {
        $luas_ruangan_default = 7.2;
        $pondasi_default = 45;
        $tinggi_pondasi_rumah = $request->tinggi_pondasi_rumah;
        $jumlah_jiwa = $request->jumlah_jiwa;
        $jumlah_jiwa = $request->jumlah_jiwa;
        $luas_ruangan = $request->luas_ruangan;
        $ruangan_layakhuni = $jumlah_jiwa * $luas_ruangan_default;
        $kondisi_rumah = $request->kondisi_rumah;

        $status_rumah = ($luas_ruangan < $ruangan_layakhuni || $tinggi_pondasi_rumah < $pondasi_default || $kondisi_rumah === 'RAWAN BANJIR' || $kondisi_rumah === 'RAWAN LONGSOR') ? 1 : 0;

        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'status' => 'required',
            'kk' => 'required',
            'jk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'tgl' => 'required',
            'status_pendidikan' => 'required',
            'pekerjaan' => 'required',
            'tempat_tinggal' => 'required',
            'sumber_air_minum' => 'required',
            'tahun_input' => 'required',
            'sumber_penerangan_utama' => 'required',
            'bab' => 'required',
            'foto_diri' => 'required|image|max:2048',
            'foto_rumah' => 'required|image|max:2048',
            'tinggi_pondasi_rumah' => 'required',
            'jumlah_jiwa' => 'required',
            'luas_ruangan' => 'required',
            'kondisi_rumah' => 'required',
        ]);

        $data = Poverty::create($validatedData);
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->id_kecamatan = $request->id_kecamatan;
        $data->id_desa = $request->id_desa;
        $data->status_rumah = $status_rumah;
        //  dd($data); public function store(Request $request)
    {
        $luas_ruangan_default = 7.2;
        $pondasi_default = 45;
        $tinggi_pondasi_rumah = $request->tinggi_pondasi_rumah;
        $jumlah_jiwa = $request->jumlah_jiwa;
        $jumlah_jiwa = $request->jumlah_jiwa;
        $luas_ruangan = $request->luas_ruangan;
        $ruangan_layakhuni = $jumlah_jiwa * $luas_ruangan_default;
        $kondisi_rumah = $request->kondisi_rumah;

        $status_rumah = ($luas_ruangan < $ruangan_layakhuni || $tinggi_pondasi_rumah < $pondasi_default || $kondisi_rumah === 'RAWAN BANJIR' || $kondisi_rumah === 'RAWAN LONGSOR') ? 1 : 0;

        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'status' => 'required',
            'kk' => 'required',
            'jk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'tgl' => 'required',
            'status_pendidikan' => 'required',
            'pekerjaan' => 'required',
            'tempat_tinggal' => 'required',
            'sumber_air_minum' => 'required',
            'tahun_input' => 'required',
            'sumber_penerangan_utama' => 'required',
            'bab' => 'required',
            'foto_diri' => 'required|image|max:2048',
            'foto_rumah' => 'required|image|max:2048',
            'tinggi_pondasi_rumah' => 'required',
            'jumlah_jiwa' => 'required',
            'luas_ruangan' => 'required',
            'kondisi_rumah' => 'required',
        ]);

        $data = Poverty::create($validatedData);
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->id_kecamatan = $request->id_kecamatan;
        $data->id_desa = $request->id_desa;
        $data->status_rumah = $status_rumah;
        //  dd($data);
        if ($request->hasFile('foto_diri')) {
            $fotoDiri = $request->file('foto_diri');
            $fotoDiriPath = Str::random(5) . '.' . $fotoDiri->getClientOriginalExtension();

            Storage::putFileAs('public/foto_diri', $fotoDiri, $fotoDiriPath);
            $data->foto_diri = $fotoDiriPath;
        }

        if ($request->hasFile('foto_rumah')) {
            $fotoRumah = $request->file('foto_rumah');
            $fotoRumahPath = Str::random(5) . '.' . $fotoRumah->getClientOriginalExtension();
            Storage::putFileAs('public/foto_rumah', $fotoRumah, $fotoRumahPath);
            $data->foto_rumah = $fotoRumahPath;
        }

        if ($data->save()) {
            Alert::success('Sukses', 'Data Kemiskinan berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('poverty');
    }
        if ($request->hasFile('foto_diri')) {
            $fotoDiri = $request->file('foto_diri');
            $fotoDiriPath = Str::random(5) . '.' . $fotoDiri->getClientOriginalExtension();

            Storage::putFileAs('public/foto_diri', $fotoDiri, $fotoDiriPath);
            $data->foto_diri = $fotoDiriPath;
        }

        if ($request->hasFile('foto_rumah')) {
            $fotoRumah = $request->file('foto_rumah');
            $fotoRumahPath = Str::random(5) . '.' . $fotoRumah->getClientOriginalExtension();
            Storage::putFileAs('public/foto_rumah', $fotoRumah, $fotoRumahPath);
            $data->foto_rumah = $fotoRumahPath;
        }

        if ($data->save()) {
            Alert::success('Sukses', 'Data Kemiskinan berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('poverty');
    }
    public function edit($id)
    {
        $poverty = Poverty::find($id);
        if (!$poverty) {
            return redirect('poverty')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('poverty.edit', compact('poverty'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'status' => 'required',
            'kk' => 'required',
            'jk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'tgl' => 'required',
            'status_pendidikan' => 'required',
            'pekerjaan' => 'required',
            'tempat_tinggal' => 'required',
            'sumber_air_minum' => 'required',
            'bahan_bakar_memasak' => 'required',
            'desil' => 'required',
            'dtks' => 'required',
            'penghasilan_perbulan' => 'required',
            'bantuan_diterima' => 'required',
            'tahun_input' => 'required',
            'sumber_penerangan_utama' => 'required',
            'bab' => 'required',
        ]);

        $data = Poverty::findOrFail($id);
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->id_kecamatan = $request->id_kecamatan;
        $data->id_desa = $request->id_desa;
        $data->update($validatedData);

        if ($request->hasFile('foto_diri')) {
            $fotoDiri = $request->file('foto_diri');
            $fotoDiriPath = Str::random(20) . '.' . $fotoDiri->getClientOriginalExtension();
            Storage::putFileAs('public/foto_diri', $fotoDiri, $fotoDiriPath);
            $data->foto_diri = $fotoDiriPath;
        }

        if ($request->hasFile('foto_rumah')) {
            $fotoRumah = $request->file('foto_rumah');
            $fotoRumahPath = Str::random(20) . '.' . $fotoRumah->getClientOriginalExtension();
            Storage::putFileAs('public/foto_rumah', $fotoRumah, $fotoRumahPath);
            $data->foto_rumah = $fotoRumahPath;
        }

        if ($data->save()) {
            Alert::success('Sukses', 'Data Kemiskinan berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('poverty');
    }

    public function show($id)
    {
        $poverty = Poverty::with('kecamatan', 'desa', 'assistance.assistDetails')->findOrFail($id);
// dd($poverty);
        if (!$poverty) {
            return redirect('poverty')->with('error', 'Data tidak ditemukan.');
        }

        return view('poverty.show', compact('poverty'));
    }

    public function confirmDelete($id)
    {
        $poverty = Poverty::findOrFail($id);
        return view('poverty.confirm-delete', compact('poverty'));
    }

    public function delete($id)
    {
        $poverty = Poverty::findOrFail($id);

        if ($poverty->delete()) {
            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('poverty');
    }

    public function getKecamatan()
    {
        $kecamatan = kecamatan::all();

        return response()->json([
            'status' => 'success',
            'data' => $kecamatan
        ]);
    }
    public function getDesa($id_kecamatan)
    {
        $kecamatan = Kecamatan::find($id_kecamatan);

        if (!$kecamatan) {
            return response()->json(['error' => 'Kecamatan tidak ditemukan'], 404);
        }

        $desa = Desa::where('id_kecamatan', $id_kecamatan)->get();

        return response()->json($desa);
    }


}
