<?php

namespace App\Http\Controllers;

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
        $jml_penduduk = $latestPopulation->jumlah_penduduk;

        $latestYear = Poverty::max('tahun_input');
        $jml_pen_miskin = Poverty::where('tahun_input', $latestYear)->count();

        $persentasePendudukMiskin = ($jml_pen_miskin / $jml_penduduk) * 100;

        return view('pages.dashboard', compact('latestPopulation', 'jml_pen_miskin', 'persentasePendudukMiskin'));
    }

}
