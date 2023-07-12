<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Models\AssistDetail;
use App\Models\Poverty;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;
use Str;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year');
        $search = $request->input('search');

        $query = Assistance::query();

        if (!empty($year) && $year != 'all') {
            $query->where('tahun', $year);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('poverty', function ($q) use ($search) {
                    $q->where('nama', 'LIKE', '%' . $search . '%')
                        ->orWhere('nik', 'LIKE', '%' . $search . '%');
                });
            });
        }

        $assistances = $query->with('assistDetails', 'poverty')->paginate(10);
        $years = Assistance::pluck('tahun')->unique();

        return view('assistance.index', compact('assistances', 'years'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
        // dd($years);
        return view('assistance.create', compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Simpan data ke tabel asistance
        $assistance = new Assistance();
        $assistance->tahun = $request->tahun;
        $assistance->id_poverty = $request->id_poverty;
        if (!empty($assistance->id_poverty)) {
            $poverty = Poverty::find($assistance->id_poverty);
            if ($poverty) {
                $poverty->status_bantuan = 2;
                $poverty->save();
            }
        }

        $assistance->save(); // Simpan data ke tabel asistance


        // Simpan data ke tabel assist_detail
        $assistDetails = [];

        $nama_bantuans = $request->nama_bantuan ?? [];
        $pemberi_bantuans = $request->pemberi_bantuan ?? [];
        $keterangans = $request->keterangan ?? [];
        $buktis = $request->file('bukti') ?? [];


        foreach ($nama_bantuans as $key => $nama_bantuan) {
            $detail = [
                'id_assistance' => $assistance->id,
                'nama_bantuan' => $nama_bantuan,
                'pemberi_bantuan' => $pemberi_bantuans[$key] ?? null,
                'keterangan' => $keterangans[$key] ?? null,
                'bukti' => null,
            ];

            if (isset($buktis[$key]) && $buktis[$key]->isValid()) {
                $bukti = $buktis[$key];
                $buktiPath = Str::random(10) . '.' . $bukti->getClientOriginalExtension();
                Storage::putFileAs('public/bukti', $bukti, $buktiPath);
                $detail['bukti'] = $buktiPath;
            }

            $assistDetails[] = $detail;
        }

        AssistDetail::insert($assistDetails);

        if ($assistance->save()) {
            Alert::success('Sukses', 'Data Bantuan berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('assistance');

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $assistance = Assistance::with('assistDetails', 'poverty')->findOrFail($id);

        return view('assistance.show', compact('assistance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assistance = Assistance::with('assistDetails', 'poverties')->findOrFail($id);
        $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();

        return view('assistance.edit', compact('assistance', 'years'));
    }


    public function update(Request $request, $id)
    {

        $assistance = Assistance::findOrFail($id);
        $assistance->tahun = $request->tahun;
        $assistance->id_poverty = $request->id_poverty;

        if ($assistance->id_poverty) {
            $poverty = Poverty::find($assistance->id_poverty);
            if ($poverty) {
                $poverty->status_bantuan = 2;
                $poverty->save();
            }
        }

        $assistance->save();

        $assistDetails = [];

        $nama_bantuans = $request->nama_bantuan ?? [];
        $pemberi_bantuans = $request->pemberi_bantuan ?? [];
        $keterangans = $request->keterangan ?? [];
        $buktis = $request->file('bukti') ?? [];

        foreach ($nama_bantuans as $key => $nama_bantuan) {
            $detail = [
                'id_assistance' => $assistance->id,
                'nama_bantuan' => $nama_bantuan,
                'pemberi_bantuan' => $pemberi_bantuans[$key] ?? null,
                'keterangan' => $keterangans[$key] ?? null,
                'bukti' => null,
            ];

            if (isset($buktis[$key]) && $buktis[$key]->isValid()) {
                $bukti = $buktis[$key];
                $buktiPath = Str::random(10) . '.' . $bukti->getClientOriginalExtension();
                Storage::putFileAs('public/bukti', $bukti, $buktiPath);
                $detail['bukti'] = $buktiPath;
            }

            $assistDetails[] = $detail;
        }

        $assistance->assistDetails()->delete();
        $assistance->assistDetails()->createMany($assistDetails);

        if ($assistance->save()) {
            Alert::success('Sukses', 'Data Bantuan berhasil diperbarui.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data.')->autoclose(3500);
        }

        return redirect('assistance');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assistance = Assistance::findOrFail($id);

        if ($assistance->delete()) {
            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('assistance');
    }

    public function getPovertyData(Request $request)
    {
        $year = $request->input('year');
        $povertyData = Poverty::where('tahun_input', $year)->where('status_rumah', 1)->select('id', 'nama', 'nik')->get();


        return response()->json($povertyData);
    }
    public function confirmDelete($id)
    {
        $assistance = Assistance::findOrFail($id);
        return view('assistance.confirm-delete', compact('assistance'));
    }
}
