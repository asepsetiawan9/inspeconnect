<?php

namespace App\Http\Controllers;
use App\Models\Poverty;
use Alert;
use Illuminate\Http\Request;

class PovertyController extends Controller
{
    public function index()
    {
        $povertys = Poverty::paginate(5);

        return view('poverty.index', compact('povertys'));
    }
    public function create()
    {
        return view('poverty.create');
    }
}
