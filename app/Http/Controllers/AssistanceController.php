<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Models\Poverty;
use DB;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assistances = Assistance::paginate(5);

        return view('assistance.index', compact('assistances'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPovertyData(Request $request)
    {
        $year = $request->input('year');
        $povertyData = Poverty::where('tahun_input', $year)->select('id', 'nama', 'nik')->get();

        return response()->json($povertyData);
    }
}
