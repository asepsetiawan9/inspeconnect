<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Report;
use App\Models\Schedule;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $userRole = Auth::user()->role;
        $userId = Auth::user()->id;
        // dd($userId);
        if ($userRole === 'warga') {
            // Logic for warga role
            $data = [
                "laporanterkirim" => Report::where("status",2)->where('user_id', $userId)->count(),
                "laporandiproses" => Report::where("status",3)->where('user_id', $userId)->count(),
                "ditanggapi" => Report::where("status",1)->where('user_id', $userId)->count(),
            ];
            return view('pages.dashboardwarga')->with('data', $data);
        } elseif ($userRole === 'skpd') {
            // Logic for skpd role
            $data = [
                "laporanterkirim" => Report::where("status",2)->where('user_id', $userId)->count(),
                "laporandiproses" => Report::where("status",3)->where('user_id', $userId)->count(),
                "ditanggapi" => Report::where("status",1)->where('user_id', $userId)->count(),
                "konsultasibaru" => Schedule::where("status",2)->where('opd_id', $userId)->count(),
                "konsultasidiperoses" => Schedule::where("status",3)->where('opd_id', $userId)->take(3)->get(),
            ];
            // dd($data['konsultasidiperoses']);
            return view('pages.dashboardskpd')->with('data', $data);
        } elseif ($userRole === 'admin') {
            // Logic for admin role
            $data = [
                "laporanbaru" => Report::where("status",2)->count(),
                "konsultasibaru" => Schedule::where("status",2)->count(),
                "laporanselesai" => Report::where("status",1)->count(),
                "laporanproses" => Report::where("status",3)->count(),
                "konsultan" => Consultant::count(),
                "permintaankonsul" => Schedule::with('skpd', 'consultant')->where("status",2)->take(3)->get(),
                "laporanbarulist" => Report::with('user')->where('status', 2)->take(3)->get(),
            ];
            return view('pages.dashboard')->with('data', $data);
        }

        // If the user role doesn't match any of the above, redirect to a default dashboard or show an error message.
        return redirect()->route('dashboard')->with('error', 'Invalid user role.');
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
