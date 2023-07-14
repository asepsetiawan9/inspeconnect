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

        $jml_kk = $latestPopulation ? $latestPopulation->jumlah_kk : 0;


        //jumlah rumah tidak layak huni tahun terakhir
        $latestYear = Poverty::max('tahun_input');
        $jml_rmh_tdak_layak = Poverty::where('status_rumah', 1)->count();
        $jml_rmh_layak = Poverty::where('status_rumah', 0)->count();
        //  dd($jml_rmh_tdak_layak);

        //ambil semua tahun
        $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
        $status_rumah = Poverty::distinct('status_rumah')->pluck('status_rumah')->toArray();
        
        //ambil semua nilai pertahun
        $dataTidakLayakCountByYear = [];
        $dataLayakCountByYear = [];
        foreach ($years as $year) {
            $count = Poverty::where('tahun_input', $year)->where('status_rumah', 1)->count();
            $count2 = Poverty::where('tahun_input', $year)->where('status_rumah', 0)->count();
            $dataTidakLayakCountByYear[] = $count;
            $dataLayakCountByYear[] = $count2;
        }

        //ambil semua tahun
        $kecId = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
        $kecLabels = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
            ->distinct('kecamatan.name')
            ->pluck('kecamatan.name')
            ->toArray();

        //ambil semua nilai pertahun
        $kecValueTidakLayak = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
            $kecValueTidakLayak[] = $count;
        }

        $kecValueLayak = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
            $kecValueLayak[] = $count;
        }
        //chart 1

        $nameDes = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
        ->distinct('kecamatan.name')
        ->pluck('kecamatan.name')
        ->toArray();

        //ambil semua nilai pertahun
        $desValueTidakLayak = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
            $desValueTidakLayak[] = $count;
        }
        $desValueLayak = [];
        foreach ($kecId as $kec) {
            $count = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
            $desValueLayak[] = $count;
        }
        //chart2
        $get_id_kec = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
        $namaKecamatan = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
        ->distinct('kecamatan.name')
        ->pluck('kecamatan.name')
        ->toArray();
        $kec_value_rm_tidak_layak = [];
        $kec_value_rm_layak = [];
            foreach ($get_id_kec as $kec) {
                $count_tidak_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
                $count_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
                $kec_value_rm_tidak_layak[] = $count_tidak_layak;
                $kec_value_rm_layak[] = $count_layak;
            }
        // dd($kec_value_rm_tidak_layak,
        // $kec_value_rm_layak);

        $message = 'kosong';

        return view('pages.dashboard', compact('latestPopulation', 'jml_rmh_tdak_layak',
        'jml_rmh_layak', 'years',
        'dataTidakLayakCountByYear', 'dataLayakCountByYear', 'kecLabels', 'kecId', 'kecValueTidakLayak',
        'kecValueLayak', 'message', 'namaKecamatan', 'kec_value_rm_tidak_layak', 'kec_value_rm_layak', 'desValueTidakLayak',
        'desValueLayak', 'status_rumah'));
    }

    public function filterKecamatan(Request $request)
    {
        $kecLabel = $request->input('kecLabel');
        $kecLabel = strtolower($kecLabel);
        $kecLabel = str_replace(' ', '_', $kecLabel);
        $kecId = $request->input('kecId');

        $latestPopulation = Population::latest()->first();
        $jml_kk = $latestPopulation->{$kecLabel};

        $selectedYear = $request->input('year');
        $id_desa = Poverty::where('id_kecamatan', $kecId)->distinct('id_desa')->pluck('id_desa')->toArray();
        $get_id_kec = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();

        if ($selectedYear === 'all' && $kecId === 'kec_all') {
            $jumlah_rumah = Poverty::count();
            $jml_tidak_layak = Poverty::where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('status_rumah', 0)->count();
            $label_tahun = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Population::sum('jumlah_kk');

            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 0)->count();
            }

            $namaKecamatan = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
                ->distinct('kecamatan.name')
                ->pluck('kecamatan.name')
                ->toArray();

            $kec_value_rm_tidak_layak = [];
            $kec_value_rm_layak = [];
            foreach ($get_id_kec as $kec) {
                $count_tidak_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
                $count_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
                $kec_value_rm_tidak_layak[] = $count_tidak_layak;
                $kec_value_rm_layak[] = $count_layak;
            }

            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } elseif ($selectedYear === 'all') {
            $jumlah_rumah = Poverty::where('id_kecamatan', $kecId)->count();
            $jml_tidak_layak = Poverty::where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('id_kecamatan', $kecId)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Population::sum($kecLabel);

            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            }

            $namaKecamatan = Poverty::join('desa', 'poverties.id_desa', '=', 'desa.id')
                ->where('poverties.id_kecamatan', $kecId)
                ->distinct('desa.name_desa')
                ->pluck('desa.name_desa')
                ->toArray();

            $kec_value_rm_tidak_layak = [];
            $kec_value_rm_layak = [];
            foreach ($get_id_kec as $kec) {
                $count_tidak_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
                $count_layak = Poverty::where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
                $kec_value_rm_tidak_layak[] = $count_tidak_layak;
                $kec_value_rm_layak[] = $count_layak;
            }

            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } elseif ($kecId === 'kec_all') {
            $jumlah_rumah = Poverty::where('tahun_input', $selectedYear)->count();
            $jml_tidak_layak = Poverty::where('tahun_input', $selectedYear)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('tahun_input', $selectedYear)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('tahun_input', $selectedYear)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Population::where('tahun', $selectedYear)->sum('jumlah_kk');

            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 0)->count();
            }

            $namaKecamatan = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')->where('tahun_input', $selectedYear)
                ->distinct('kecamatan.name')
                ->pluck('kecamatan.name')
                ->toArray();
            $id_kecamatan = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')->where('tahun_input', $selectedYear)
                ->distinct('kecamatan.id')
                ->pluck('kecamatan.id')
                ->toArray();

            $kec_value_rm_tidak_layak = [];
            $kec_value_rm_layak = [];
            foreach ($id_kecamatan as $kec) {
                $count_tidak_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kec)->where('status_rumah', 1)->count();
                $count_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kec)->where('status_rumah', 0)->count();
                $kec_value_rm_tidak_layak[] = $count_tidak_layak;
                $kec_value_rm_layak[] = $count_layak;
            }

            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } else {
            $jumlah_rumah = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->count();
            $jml_tidak_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('tahun_input', $selectedYear)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->groupBy('kk')->count();
            $jml_kk = Population::where('tahun', $selectedYear)->sum($kecLabel);
            $id_desa = Poverty::where('id_kecamatan', $kecId)->distinct('id_desa')->pluck('id_desa')->toArray();

            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            }

            $namaKecamatan = Poverty::join('desa', 'poverties.id_desa', '=', 'desa.id')
                ->where('poverties.id_kecamatan', $kecId)
                ->where('tahun_input', $selectedYear)
                ->distinct('desa.name_desa')
                ->pluck('desa.name_desa')
                ->toArray();

            $kec_value_rm_tidak_layak = [];
            $kec_value_rm_layak = [];
            foreach ($label_tahun as $kec) {
                $count_tidak_layak = Poverty::where('tahun_input', $kec)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
                $count_layak = Poverty::where('tahun_input', $kec)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
                $kec_value_rm_tidak_layak[] = $count_tidak_layak;
                $kec_value_rm_layak[] = $count_layak;
            }

            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        }

        $message = [
            'jumlah_rumah' => number_format($jumlah_rumah),
            'jml_tidak_layak' => number_format($jml_tidak_layak),
            'jml_layak' => number_format($jml_layak),
            'jml_kk' => number_format($jml_kk),
            'label_tahun' => $label_tahun,
            'jml_tidak_layak_tahun' => $jml_tidak_layak_tahun,
            'jml_layak_tahun' => $jml_layak_tahun,
            'namaKecamatan' => $namaKecamatan,
            'kec_value_rm_tidak_layak' => $kec_value_rm_tidak_layak,
            'kec_value_rm_layak' => $kec_value_rm_layak,
        ];

        return response()->json(['message' => $message]);
    }



}
