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
        $latestYear = Poverty::max('tahun_input');

        if ($selectedYear === 'all') {
            $selectedYear = null; // Menghapus filter tahun jika memilih opsi 'all'
        }

        foreach ($kecamatanData as $kecamatan) {
            $query = Poverty::where('id_kecamatan', $kecamatan->id);

            if ($selectedYear !== null) {
                $query->where('tahun_input', $selectedYear); // Menambahkan filter tahun jika dipilih
            }

            if ($selectedVariable !== 'all') {
                $query->where('pendidikan_terakhir', $selectedVariable); // Menambahkan filter variabel jika dipilih
            }

            $povertyData = $query->get();

            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'nmkab' => 'GARUT',
                    'tahun' => $selectedYear,
                    'variabel' => $selectedVariable,
                    'kecamatan' => $kecamatan->name,
                    'nmprov' => 'JAWA BARAT',
                    'keterangan' => $kecamatan->key_kecamatan,
                    'nilai' => $povertyData->count(),
                ],
                'geometry' => [
                    'type' => $kecamatan->type,
                    'coordinates' => json_decode($kecamatan->coordinates),
                ],
            ];

            $features[] = $feature;
        }

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];

        return response()->json($geojson);
    }


}
