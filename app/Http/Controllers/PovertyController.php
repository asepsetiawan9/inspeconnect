<?php

namespace App\Http\Controllers;
use App\Models\Poverty;
use Alert;
use Illuminate\Http\Request;
use Storage;
use Str;
use View;

class PovertyController extends Controller
{
    public function index()
    {
        $povertys = Poverty::paginate(5);

        return view('poverty.index', compact('povertys'));
    }
    public function searchData(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);

        $povertys = Poverty::where('nama', 'LIKE', '%'.$query.'%')->paginate(5, ['*'], 'page', $page);

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
        $filterDesil = $request->input('desil');
        $filterTahun = $request->input('tahun');
        $page = $request->input('page', 1);

        $query = Poverty::query();

        if ($filterKecamatan !== 'semua') {
            $query->where('kecamatan', $filterKecamatan);
        }

        if ($filterDesil !== 'semua') {
            $query->where('desil', $filterDesil);
        }

        if ($filterTahun !== 'semua') {
            $query->where('tahun_input', $filterTahun);
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
            'kecamatan' => 'required',
            'desa' => 'required',
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
            'foto_diri' => 'required|image|max:2048',
            'foto_rumah' => 'required|image|max:2048',
        ]);

        $data = Poverty::create($validatedData);
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;

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
            'kecamatan' => 'required',
            'desa' => 'required',
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
        $poverty = Poverty::find($id);
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


}
