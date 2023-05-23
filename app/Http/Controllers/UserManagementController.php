<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('users.index', compact('users'));
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter === 'kecamatan') {
            $users = User::where('role', 'kec')->paginate(5);
        } elseif ($filter === 'desa') {
            $users = User::where('role', 'des')->paginate(5);
        } else {
            $users = User::paginate(5);
        }

        return view('users.partial_table', compact('users'));
    }
    public function filterKec(Request $request)
    {
        $filter = $request->input('filter');

        if ($filter === 'semua') {
            $users = User::paginate(5);
        } else {
            $users = User::where('city', $filter)->paginate(5);
        }

        return view('users.partial_table', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:5',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'konfirm-pass' => 'required|same:password',
            'phone' => 'required|min:10|max:15',
            'role' => 'required',
        ], [
            'konfirm-pass.same' => 'Password Harus Sama.',
        ]);

        $user = User::create($attributes);

        if ($user) {
            Alert::success('Sukses', 'Data berhasil disimpan.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('user-management');
    }

    public function edit($id)
    {

        $user = User::find($id);
        if (!$user) {
            return redirect('user-management')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'username' => 'max:255|min:5',
            'phone' => 'min:10|max:15',
        ], [
            'konfirm-pass.same' => 'Password Harus Sama.',
        ]);

        $user = User::findOrFail($id);
        $user->username = $attributes['username'];
        $user->phone = $attributes['phone'];
        $user->role = $request->role;
        $user->email = $request->email;
        $user->city = ucwords(strtolower($request->kecamatan_name));
        $user->desa = ucwords(strtolower($request->desa));

        if (!empty($request->password)) {
            $user->password = $request->password;
        }

        $user->save();

        if ($user) {
            Alert::success('Sukses', 'Data berhasil diubah.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('user-management');
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('user-management')->with('error', 'Pengguna tidak ditemukan.');
        }
        return view('users.show', compact('user'));
    }

    public function confirmDelete($id)
    {
        $user = User::findOrFail($id);
        return view('user-management.confirm-delete', compact('user'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('user-management');
    }

}
