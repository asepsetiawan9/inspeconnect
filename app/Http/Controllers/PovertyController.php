<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PovertyController extends Controller
{
    public function index()
    {
        return view('poverty.index');
    }
}
