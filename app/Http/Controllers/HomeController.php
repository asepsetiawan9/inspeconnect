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
        // dd($kecValueLayak);

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

        $message = 'kosong';

        return view('pages.dashboard', compact('latestPopulation', 'jml_rmh_tdak_layak',
        'jml_rmh_layak', 'years',
        'dataTidakLayakCountByYear', 'dataLayakCountByYear', 'kecLabels', 'kecId', 'kecValueTidakLayak',
        'kecValueLayak', 'message', 'nameDes', 'desValueTidakLayak',
        'desValueLayak', 'status_rumah'));
    }

    public function filterKecamatan(Request $request)
    {
        // dd($request);
        // $status = $request->input('status');
        $kecLabel = $request->input('kecLabel');
        $kecLabel = strtolower($kecLabel);
        $kecLabel = str_replace(' ', '_', $kecLabel);
        $kecId = $request->input('kecId');
        //  dd($kecId);
        

        $latestPopulation = Population::latest()->first();

        // if ($status !== 'all') {
        //     Poverty::where('status_rumah', $status);
        // }

        $jml_kk = $latestPopulation->{$kecLabel};
        // dd($jml_kk);

        // if ($selectedYear === 'all') {
        //     $latestYear = Poverty::max('tahun_input');
        //     $selectedYear = $latestYear;
        // } else {
        //     $latestYear = $selectedYear;
        // }

        $selectedYear = $request->input('year');
        $kecId = $request->input('kecId');
        $id_desa = Poverty::where('id_kecamatan', $kecId)->distinct('id_desa')->pluck('id_desa')->toArray();
        // $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();

        if ($selectedYear === 'all' && $kecId === 'kec_all') {
            $jumlah_rumah = Poverty::count();
            $jml_tidak_layak = Poverty::where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('status_rumah', 0)->count();
            $label_tahun = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Poverty::groupBy('kk')->count();
            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
        
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 0)->count();
            }
        
            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } elseif ($selectedYear === 'all') {
            $jumlah_rumah = Poverty::where('id_kecamatan', $kecId)->count();
            $jml_tidak_layak = Poverty::where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('id_kecamatan', $kecId)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Poverty::where('id_kecamatan', $kecId)->groupBy('kk')->count();
            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
        
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            }
        
            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } elseif ($kecId === 'kec_all') {
            $jumlah_rumah = Poverty::where('tahun_input', $selectedYear)->count();
            $jml_tidak_layak = Poverty::where('tahun_input', $selectedYear)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('tahun_input', $selectedYear)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('tahun_input', $selectedYear)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Poverty::where('tahun_input', $selectedYear)->groupBy('kk')->count();
            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
        
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('status_rumah', 0)->count();
            }
            // dd($jml_layak_tahun);
        
            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        } else {
            $jumlah_rumah = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->count();
            $jml_tidak_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
            $jml_layak = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            $label_tahun = Poverty::where('tahun_input', $selectedYear)->distinct('tahun_input')->pluck('tahun_input')->toArray();
            $jml_kk = Poverty::where('tahun_input', $selectedYear)->where('id_kecamatan', $kecId)->groupBy('kk')->count();
            $jml_tidak_layak_tahun = [];
            $jml_layak_tahun = [];
        
            foreach ($label_tahun as $tahun) {
                $jml_tidak_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 1)->count();
                $jml_layak_tahun[] = Poverty::where('tahun_input', $tahun)->where('id_kecamatan', $kecId)->where('status_rumah', 0)->count();
            }
        
            array_multisort($label_tahun, $jml_layak_tahun, $jml_tidak_layak_tahun);
        }
        
        
        
                
        // dd($id_desa);

        // if($kecId==='jumlah_penduduk'){
        //     if ($status !== 'all') {
        //         $jml_tidak_layak = Poverty::where('tahun_input', $latestYear)->where('status', $status)->count();
        //     }else{
        //         $jml_tidak_layak = Poverty::where('tahun_input', $latestYear)->count();
        //     }
        //     $years = Poverty::distinct('tahun_input')->pluck('tahun_input')->toArray();
        //     $dataCountByYear = [];
        //     if ($status !== 'all') {
        //         foreach ($years as $year) {
        //             $count = Poverty::where('tahun_input', $latestYear)->where('status', $status)->count();
        //             $dataCountByYear[] = $count;
        //         }
        //     }else{
        //         foreach ($years as $year) {
        //             $count = Poverty::where('tahun_input', $year)->count();
        //             $dataCountByYear[] = $count;
        //         }
        //     }

        //     $id_kec = Poverty::distinct('id_kecamatan')->pluck('id_kecamatan')->toArray();
        //     $nameDes = Poverty::join('kecamatan', 'poverties.id_kecamatan', '=', 'kecamatan.id')
        //     ->distinct('kecamatan.name')
        //     ->pluck('kecamatan.name')
        //     ->toArray();

        //     //ambil semua nilai pertahun
        //     $desValue = [];
        //     if ($status !== 'all') {
        //         foreach ($id_kec as $kec) {
        //             $count = Poverty::where('id_kecamatan', $kec)->where('tahun_input', $latestYear)->where('status', $status)->count();
        //             $desValue[] = $count;
        //         }
        //     }else{
        //         foreach ($id_kec as $kec) {
        //             $count = Poverty::where('id_kecamatan', $kec)->where('tahun_input', $latestYear)->count();
        //             $desValue[] = $count;
        //         }
        //     }

        // }else{
        //     if ($status !== 'all') {
        //         $jml_tidak_layak = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)->where('status', $status)->count();
        //     }else{
        //         $jml_tidak_layak = Poverty::where('tahun_input', $latestYear)->where('id_kecamatan', $kecId)->count();
        //     }
            
        //     $years = Poverty::distinct('tahun_input')->where('id_kecamatan', $kecId)->where('tahun_input', $latestYear)->pluck('tahun_input')->toArray();
        //     $dataCountByYear = [];
        //     foreach ($years as $year) {
        //         $count = Poverty::where('tahun_input', $year)->count();
        //         $dataCountByYear[] = $count;
        //     }

        //     $nameDes = Poverty::join('desa', 'poverties.id_desa', '=', 'desa.id')
        //     ->where('poverties.id_kecamatan', $kecId)->where('tahun_input', $latestYear)
        //     ->distinct('desa.name_desa')
        //     ->pluck('desa.name_desa')
        //     ->toArray();

        //     $desValue = [];
        //     foreach ($id_desa as $des) {
        //         $count = Poverty::where('id_desa', $des)->where('tahun_input', $latestYear)->count();
        //         $desValue[] = $count;
        //     }

        // }
        // if ($jml_kk != 0) {
        //     $persentasePendudukMiskin = ($jml_tidak_layak / $jml_penduduk) * 100;
        // } else {
        //     // Handle the division by zero error
        //     // You can assign a default value or display an error message
        //     $persentasePendudukMiskin = 0; // or any other appropriate value
        //     // Alternatively, you can display an error message:
        //     // echo "Error: Division by zero!";
        // }
        

        $message = [
            'jumlah_rumah' => number_format($jumlah_rumah),
            'jml_tidak_layak' => number_format($jml_tidak_layak),
            'jml_layak' => number_format($jml_layak),
            'jml_kk' => number_format($jml_kk),
            'label_tahun' => $label_tahun,
            'jml_tidak_layak_tahun' => $jml_tidak_layak_tahun,
            'jml_layak_tahun' => $jml_layak_tahun,
            // 'years' => $years,
            // 'dataCountByYear' => $dataCountByYear,
            // 'nameDes' => $nameDes,
            // 'desValue' => $desValue,
        ];
        //  dd($message);
        return response()->json(['message' => $message]);
    }


}
