<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopulationDataController extends Controller
{
    public function index()
    {
        return view('populationdata.index');
    }
}
