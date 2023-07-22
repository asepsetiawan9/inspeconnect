<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    // dd($request);
    $attributes = $request->validate([
        'nik' => 'required|max:255',
        'name' => 'required|max:255',
        'gender' => 'required',
        'telp' => 'required|max:255',
        'tempat' => 'required|max:255',
        'address' => 'required',
        'datebirth' => 'required',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:5|max:255',
        'terms' => 'required',
    ]);

    if ($request->hasFile('photo')) {
        $attributes['photo'] = $request->file('photo')->store('photos', 'public');
    }

    // Role dan status akan di-set secara otomatis
    $attributes['role'] = $request->role;
    $attributes['status'] = $request->status;
    $attributes['opd_id'] = $request->opd_id;

    $user = User::create($attributes);

    if ($user) {
        Alert::success('Sukses', 'Pendaftaran Berhasil.')->autoclose(3500);
    } else {
        Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
    }

    return redirect('/login');
}

}
