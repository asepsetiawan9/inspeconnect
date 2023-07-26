<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Skpd;
use Alert;
use View;
use Storage;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
    {

    public function index()
    {
        $users = User::paginate(5);

        return view('users.index', compact('users'));
    }
    public function filterData(Request $request)
    {

        $filterStatus = $request->input('status');
        // dd($filterStatus);
        $filterRole = $request->input('role');
        $page = $request->input('page', 1);

        $query = User::query();

        if ($filterStatus !== 'semua') {
            $query->where('status', $filterStatus);
        }

        if ($filterRole !== 'semua') {
            $query->where('role', $filterRole);
        }

        $users = $query->paginate(5, ['*'], 'page', $page);

        $table = View::make('users.partial_table', compact('users'))->render();
        $pagination = $users->links('pagination::bootstrap-4')->render();

        return response()->json([
            'table' => $table,
            'pagination' => $pagination,
        ]);
    }

    public function updateStatus(Request $request, User $user)
    {
        // Ubah status sesuai kebutuhan (misalnya jika status awalnya 0 maka diubah menjadi 1)
        $user->status = $user->status === 0 ? 1 : 0;
        $user->save();

        return response()->json(['message' => 'Status berhasil diubah']);
    }

    public function create()
    {
        return view('users.create');
    }
    public function createskpd()
    {
        $skpds = Skpd::all();
        // dd($skpds);

        return view('users.createskpd', compact('skpds'));
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
        ]);

        if ($request->hasFile('photo')) {
            $attributes['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $attributes['role'] = $request->role;
        $attributes['status'] = $request->status;
        $attributes['opd_id'] = $request->opd_id;

        $user = User::create($attributes);

        if ($user) {
            Alert::success('Sukses', 'Tambah Warga Berhasil.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('user-management');
    }
    public function storeskpd(Request $request)
    {
        // dd($request);
        $skpdData = $request->opd_id;

        // Cari SKPD berdasarkan opd_id
        $skpd = Skpd::find($skpdData);
        // dd($skpd);

        if (!$skpd) {
            // Jika SKPD dengan opd_id yang diberikan tidak ditemukan, berikan pesan error
            Alert::error('Error', 'SKPD tidak ditemukan.')->autoclose(3500);
            return redirect('user-management');
        }

        // Jika SKPD ditemukan, masukkan nama dan alamat dari SKPD ke dalam $user
        $user = new User();
        $user->opd_id = $skpdData;
        $user->name = $skpd->name;
        $user->role = 'skpd';
        $user->address = $skpd->alamat;
        $user->status = 1;
        $user->email = $request->email;
        $user->password = $request->password;

        if ($user->save()) {
            Alert::success('Sukses', 'Tambah Akun SKPD Berhasil.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('user-management');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $skpds = Skpd::all();
        if (!$user) {
            return redirect('user-management')->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($user->role === 'skpd') {
            return view('users.editskpd', compact('user', 'skpds'));
        } else {
            return view('users.edit', compact('user'));
        }
    }


    public function update(Request $request, $id)
    {
        // Cari data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi data yang dikirimkan melalui form
        $attributes = $request->validate([
            'nik' => 'required|max:255',
            'name' => 'required|max:255',
            'gender' => 'required',
            'telp' => 'required|max:255',
            'tempat' => 'required|max:255',
            'address' => 'required',
            'datebirth' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $id, // Menambahkan pengecualian untuk data dengan ID tertentu
            'password' => 'required|min:5|max:255',
        ]);

        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            // Jika ada, update foto dengan foto yang baru diunggah
            $attributes['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Update atribut-atribut pengguna
        $user->update($attributes);

        if ($user) {
            Alert::success('Sukses', 'Perbarui Data Pengguna Berhasil.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('user-management');
    }
    public function updateskpd(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            // Jika user dengan ID yang diberikan tidak ditemukan, berikan pesan error
            Alert::error('Error', 'Pengguna tidak ditemukan.')->autoclose(3500);
            return redirect('user-management');
        }
    
        $attributes = $request->validate([
            'opd_id' => 'required|exists:opd,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Tambahkan pengecualian untuk email saat proses update
            'password' => 'required|min:5|max:255',
        ]);
    
        // Cari SKPD berdasarkan opd_id
        $skpd = Skpd::find($attributes['opd_id']);
    
        if (!$skpd) {
            // Jika SKPD dengan opd_id yang diberikan tidak ditemukan, berikan pesan error
            Alert::error('Error', 'SKPD tidak ditemukan.')->autoclose(3500);
            return redirect('user-management');
        }
    
        // Update atribut-atribut user
        $user->opd_id = $skpd->id;
        $user->name = $skpd->name;
        $user->role = 'skpd';
        $user->address = $skpd->alamat;
        $user->status = 1; // Anda dapat menyesuaikan logika status sesuai kebutuhan
        $user->email = $attributes['email'];
        $user->password = $attributes['password'];
    
        if ($user->save()) {
            Alert::success('Sukses', 'Update Akun SKPD Berhasil.')->autoclose(3500);
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

        // Jika role user adalah 'skpd', alihkan ke view 'showskpd'
        if ($user->role === 'skpd') {
            return view('users.showskpd', compact('user'));
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

        // Dapatkan path foto dari kolom photo
        $photoPath = $user->photo;

        if ($user->delete()) {
            // Hapus foto dari storage jika foto ada
            if ($photoPath && Storage::exists($photoPath)) {
                Storage::delete($photoPath);
            }

            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('user-management');
    }

}
