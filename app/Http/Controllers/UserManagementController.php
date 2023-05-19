<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter === 'kecamatan') {
            $users = User::where('role', 'kec')->get();
        } elseif ($filter === 'desa') {
            $users = User::where('role', 'des')->get();
        } else {
            $users = User::all();
        }

        return view('users.partial_table', compact('users'));
    }


}
