<?php

namespace App\Http\Controllers;

use App\Models\Population;
use App\Models\Poverty;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $latestPopulation = Population::latest()->first();

        $jml_penduduk = $latestPopulation->jumlah_penduduk;

        $latestYear = Poverty::max('tahun_input');
        $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->count();
        $persentasePendudukMiskin = ($jml_pen_miskin / $jml_penduduk) * 100;

        $jml_desil1 = Poverty::where('tahun_input', $latestYear)
        ->where('desil', 'Desil 1')
        ->count();
        $jml_desil2 = Poverty::where('tahun_input', $latestYear)
        ->where('desil', 'Desil 2')
        ->count();
        $jml_desil3 = Poverty::where('tahun_input', $latestYear)
        ->where('desil', 'Desil 3')
        ->count();
        $jml_desil4 = Poverty::where('tahun_input', $latestYear)
        ->where('desil', 'Desil 4')
        ->count();


        //ambil semua tahun
        $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
        //ambil semua pendidikan terakhir
        $variabels = Poverty::distinct('pendidikan_terakhir')->pluck('pendidikan_terakhir')->toArray();

        //ambil semua nilai pertahun
        $dataCountByYear = [];
        foreach ($years as $year) {
            $count = Poverty::where('tahun_input', $year)->count();
            $dataCountByYear[] = $count;
        }
        //ambil semua tahun
        $kecId = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
        $kecLabels = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
            ->distinct('kecamatan.name')
            ->pluck('kecamatan.name')
            ->toArray();

        //ambil semua nilai pertahun
        $kecValue = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->count();
            $kecValue[] = $count;
        }

        $nameDes = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
        ->distinct('kecamatan.name')
        ->pluck('kecamatan.name')
        ->toArray();

        //ambil semua nilai pertahun
        $desValue = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->count();
            $kecValue[] = $count;
        }
        $message = 'kosong';

        return view('map.index', compact('latestPopulation', 'jml_pen_miskin', 'persentasePendudukMiskin', 'jml_desil1', 'jml_desil2', 'jml_desil3', 'jml_desil4', 'years',
        'dataCountByYear', 'kecLabels', 'kecId',
        'kecValue', 'message', 'nameDes', 'desValue', 'variabels'));
    }
    public function filterKecamatan(Request $request)
{
    $kecId = $request->input('kecId');
    $selectedYear = $request->input('year');
    $selectedVar = $request->input('variabel');

    if ($selectedYear === 'all') {
        $latestYear = Poverty::max('tahun_input');
        $selectedYear = $latestYear;
    } else {
        $latestYear = $selectedYear;
    }

    $id_desa = Poverty::where('id_kecamatan', $kecId)->distinct('id_desa')->pluck('id_desa')->toArray();
    if ($kecId === 'jumlah_penduduk') {
        $jml_desil1 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 1');
        if ($selectedVar !== 'all') {
            $jml_desil1 = $jml_desil1->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil1 = $jml_desil1->count();

        $jml_desil2 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 2');
        if ($selectedVar !== 'all') {
            $jml_desil2 = $jml_desil2->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil2 = $jml_desil2->count();

        $jml_desil3 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 3');
        if ($selectedVar !== 'all') {
            $jml_desil3 = $jml_desil3->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil3 = $jml_desil3->count();

        $jml_desil4 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 4');
        if ($selectedVar !== 'all') {
            $jml_desil4 = $jml_desil4->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil4 = $jml_desil4->count();

        $id_kec = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
        $nameDes = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
            ->distinct('kecamatan.name')
            ->pluck('kecamatan.name')
            ->toArray();

        // Ambil semua nilai per tahun
        $desValue = [];
        foreach ($id_kec as $kec) {
            $countQuery = Poverty::where('id_kecamatan', $kec);
            if ($selectedVar !== 'all') {
                $countQuery = $countQuery->where('pendidikan_terakhir', $selectedVar)->where('tahun_input', $latestYear);
            }
            $count = $countQuery->count();
            $desValue[] = $count;
        }
    } else {
        $jml_desil1 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 1')
            ->where('id_kecamatan', $kecId);
        if ($selectedVar !== 'all') {
            $jml_desil1 = $jml_desil1->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil1 = $jml_desil1->count();

        $jml_desil2 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 2')
            ->where('id_kecamatan', $kecId);
        if ($selectedVar !== 'all') {
            $jml_desil2 = $jml_desil2->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil2 = $jml_desil2->count();

        $jml_desil3 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 3')
            ->where('id_kecamatan', $kecId);
        if ($selectedVar !== 'all') {
            $jml_desil3 = $jml_desil3->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil3 = $jml_desil3->count();

        $jml_desil4 = Poverty::where('tahun_input', $latestYear)
            ->where('desil', 'Desil 4')
            ->where('id_kecamatan', $kecId);
        if ($selectedVar !== 'all') {
            $jml_desil4 = $jml_desil4->where('pendidikan_terakhir', $selectedVar);
        }
        $jml_desil4 = $jml_desil4->count();

        $nameDes = Poverty::join('desa', 'poverties.id_desa', '=', 'desa.id')
            ->where('poverties.id_kecamatan', $kecId)
            ->where('tahun_input', $latestYear)
            ->distinct('desa.name_desa')
            ->pluck('desa.name_desa')
            ->toArray();

        $desValue = [];
        foreach ($id_desa as $des) {
            $countQuery = Poverty::where('id_desa', $des)
                ->where('tahun_input', $latestYear);
            if ($selectedVar !== 'all') {
                $countQuery = $countQuery->where('pendidikan_terakhir', $selectedVar);
            }
            $count = $countQuery->count();
            $desValue[] = $count;
        }

    }

    $message = [
        'jml_desil1' => number_format($jml_desil1),
        'jml_desil2' => number_format($jml_desil2),
        'jml_desil3' => number_format($jml_desil3),
        'jml_desil4' => number_format($jml_desil4),
        'nameDes' => $nameDes,
        'desValue' => $desValue,
    ];

    return response()->json(['message' => $message]);
}


}
