<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Population;
use App\Models\Poverty;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $latestPopulation = Population::latest()->first();

        $jml_penduduk = $latestPopulation ? $latestPopulation->jumlah_penduduk : 0;


        //jumlah  penduduk miskin tahun terakhir
        $latestYear = Poverty::max('tahun_input');
        $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->count();

        $persentasePendudukMiskin = 0;

        if ($jml_penduduk > 0) {
            $persentasePendudukMiskin = ($jml_pen_miskin / $jml_penduduk) * 100;
        }

        //jumlah desil terakhir
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
        $status = Poverty::distinct('status')->pluck('status')->toArray();

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
        // dd($kecValue);

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

        return view('pages.dashboard', compact('latestPopulation', 'jml_pen_miskin', 'persentasePendudukMiskin', 'jml_desil1', 'jml_desil2', 'jml_desil3', 'jml_desil4', 'years',
        'dataCountByYear', 'kecLabels', 'kecId',
        'kecValue', 'message', 'nameDes', 'desValue', 'status'));
    }

    public function filterKecamatan(Request $request)
    {
        $status = $request->input('status');
        $kecLabel = $request->input('kecLabel');
        $kecLabel = strtolower($kecLabel);
        $kecLabel = str_replace(' ', '_', $kecLabel);
        $kecId = $request->input('kecId');
        $selectedYear = $request->input('year');

        $latestPopulation = Population::latest()->first();

        if ($status !== 'all') {
            Poverty::where('status', $status);
        }

        $jml_penduduk = $latestPopulation->{$kecLabel};

        if ($selectedYear === 'all') {
            $latestYear = Poverty::max('tahun_input');
            $selectedYear = $latestYear;
        } else {
            $latestYear = $selectedYear;
        }


        $id_desa = Poverty::where('id_kecamatan', $kecId)->distinct('id_desa')->pluck('id_desa')->toArray();

        if($kecId==='jumlah_penduduk'){
            if ($status !== 'all') {
                $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->where('status', $status)->count();
            }else{
                $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->count();
            }
            if ($status !== 'all') {
                $jml_desil1 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 1')->where('status', $status)
                ->count();
            }else{
                $jml_desil1 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 1')
                ->count();
            }

            if ($status !== 'all') {
                $jml_desil2 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 2')->where('status', $status)
                ->count();
            }else{
                $jml_desil2 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 2')
                ->count();
            }
            if ($status !== 'all') {
                $jml_desil3 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 3')->where('status', $status)
                ->count();
            }else{
                $jml_desil3 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 3')
                ->count();
            }
            if ($status !== 'all') {
                $jml_desil4 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 4')->where('status', $status)
                ->count();
            }else{
                $jml_desil4 = Poverty::where('tahun_input', $latestYear)
                ->where('desil', 'Desil 4')
                ->count();
            }
            $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
            $dataCountByYear = [];
            if ($status !== 'all') {
                foreach ($years as $year) {
                    $count = Poverty::where('tahun_input', $latestYear)->where('status', $status)->count();
                    $dataCountByYear[] = $count;
                }
            }else{
                foreach ($years as $year) {
                    $count = Poverty::where('tahun_input', $year)->count();
                    $dataCountByYear[] = $count;
                }
            }

            $id_kec = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
            $nameDes = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
            ->distinct('kecamatan.name')
            ->pluck('kecamatan.name')
            ->toArray();

            //ambil semua nilai pertahun
            $desValue = [];
            if ($status !== 'all') {
                foreach ($id_kec as $kec) {
                    $count = Poverty::where('id_kecamatan', $kec)->where('tahun_input', $latestYear)->where('status', $status)->count();
                    $desValue[] = $count;
                }
            }else{
                foreach ($id_kec as $kec) {
                    $count = Poverty::where('id_kecamatan', $kec)->where('tahun_input', $latestYear)->count();
                    $desValue[] = $count;
                }
            }

        }else{
            if ($status !== 'all') {
                $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)->where('status', $status)->count();
            }else{
                $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)->count();
            }
            if ($status !== 'all') {
                $jml_desil1 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 1')->where('status', $status)
                    ->count();
            }else{
                $jml_desil1 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 1')
                    ->count();
            }
            if ($status !== 'all') {
                $jml_desil2 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 2')->where('status', $status)
                    ->count();
            }else{
                $jml_desil2 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 2')
                    ->count();
            }
            if ($status !== 'all') {
                $jml_desil3 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 3')->where('status', $status)
                    ->count();
            }else{
                $jml_desil3 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 3')
                    ->count();
            }
            if ($status !== 'all') {
                $jml_desil4 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 4')->where('status', $status)
                    ->count();
            }else{
                $jml_desil4 = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)
                    ->where('desil', 'Desil 4')
                    ->count();
            }
            $years = Poverty::distinct('tahun_input')->where('id_kecamatan', $kecId)->where('tahun_input', $latestYear)->pluck('tahun_input')->toArray();
            $dataCountByYear = [];
            foreach ($years as $year) {
                $count = Poverty::where('tahun_input', $year)->count();
                $dataCountByYear[] = $count;
            }

            $nameDes = Poverty::join('desa', 'poverties.id_desa', '=', 'desa.id')
            ->where('poverties.id_kecamatan', $kecId)->where('tahun_input', $latestYear)
            ->distinct('desa.name_desa')
            ->pluck('desa.name_desa')
            ->toArray();

            $desValue = [];
            foreach ($id_desa as $des) {
                $count = Poverty::where('id_desa', $des)->where('tahun_input', $latestYear)->count();
                $desValue[] = $count;
            }

        }
        $persentasePendudukMiskin = ($jml_pen_miskin / $jml_penduduk) * 100;

        $message = [
            'jml_penduduk' => number_format($jml_penduduk),
            'jml_pen_miskin' => number_format($jml_pen_miskin),
            'persentase_penduduk_miskin' => round($persentasePendudukMiskin, 2),
            'jml_desil1' => number_format($jml_desil1),
            'jml_desil2' => number_format($jml_desil2),
            'jml_desil3' => number_format($jml_desil3),
            'jml_desil4' => number_format($jml_desil4),
            'years' => $years,
            'dataCountByYear' => $dataCountByYear,
            'nameDes' => $nameDes,
            'desValue' => $desValue,
        ];

        return response()->json(['message' => $message]);
    }


}
