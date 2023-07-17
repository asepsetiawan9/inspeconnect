<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Poverty;
use Illuminate\Http\Request;

class GeoJSONController extends Controller
{
    public function index(Request $request)
    {
        $features = [];
        $kecamatanData = Kecamatan::all();

        $selectedYear = $request->input('year');
        $selectedVariable = $request->input('variable');
        // dd($selectedVariable);
        // $sendVar = $selectedVariable === "all" ? 'Semua Status Rumah' : 
        // ($selectedVariable === 0 ? 'Rumah Layak Huni' : 'Rumah Tidak Layak Huni');
        $sendVar = $selectedVariable === "all" ? 'Semua Status Rumah' : 
        ($selectedVariable === "0" ? 'Rumah Layak Huni' : 'Rumah Tidak Layak Huni');

        // dd($sendVar);
        if ($selectedYear === 'all') {
            $selectedYear = null;
        }

        foreach ($kecamatanData as $kecamatan) {
            $query = Poverty::where('id_kecamatan', $kecamatan->id);

            if ($selectedVariable !== 'all') {
                $query->where('status_rumah', $selectedVariable);
            }

            if ($selectedYear !== null) {
                $query->where('tahun_input', $selectedYear);
            }
            $povertyData = $query->get();
            $countTidakLayak = $povertyData->where('status_rumah', 1)->count();
            $countLayak = $povertyData->where('status_rumah', 0)->count();

            if ($selectedVariable === 'all') {
                $feature = [
                    'type' => 'Feature',
                    'properties' => [
                        'nmkab' => 'GARUT',
                        'tahun' => $selectedYear,
                        'variabel' => $sendVar,
                        'kecamatan' => $kecamatan->name,
                        'nmprov' => 'JAWA BARAT',
                        'nilai_tidak_layak' => $countTidakLayak,
                        'nilai_layak' => $countLayak,
                        'nilai' => $countLayak + $countTidakLayak,
                    ],
                    'geometry' => [
                        'type' => $kecamatan->type,
                        'coordinates' => json_decode($kecamatan->coordinates),
                    ],
                ];
            } else {
                $feature = [
                    'type' => 'Feature',
                    'properties' => [
                        'nmkab' => 'GARUT',
                        'tahun' => $selectedYear,
                        'variabel' => $sendVar,
                        'kecamatan' => $kecamatan->name,
                        'nmprov' => 'JAWA BARAT',
                        'nilai' => ($selectedVariable == 0) ? $countLayak : $countTidakLayak,
                    ],
                    'geometry' => [
                        'type' => $kecamatan->type,
                        'coordinates' => json_decode($kecamatan->coordinates),
                    ],
                ];
            }

            $features[] = $feature;
            //  dd($feature);
        }

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];

        return response()->json($geojson);
    }



}
