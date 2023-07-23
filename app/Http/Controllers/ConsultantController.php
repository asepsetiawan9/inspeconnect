<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use Illuminate\Http\Request;
use Alert;
use Storage;


class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultants = Consultant::paginate(5);

        return view('consultant.index', compact('consultants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultant.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'telp' => 'nullable',
            'birth' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimum ukuran foto: 2MB
            'jabatan' => 'nullable|string|max:255',
        ]);

        // Proses simpan foto ke folder consultant (storage/app/public/consultant)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('consultant', 'public');
        } else {
            $photoPath = null;
        }

        // Simpan data ke database
        $consultant = Consultant::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'desc' => $request->desc,
            'telp' => $request->telp,
            'birth' => $request->birth,
            'photo' => $photoPath,
            'jabatan' => $request->jabatan,
        ]);
        if ($consultant) {
            Alert::success('Sukses', 'Tambah Konsultan Berhasil.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }

        return redirect('consultant');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultant = Consultant::find($id);

        if (!$consultant) {
            return redirect('consultant')->with('error', 'Consultant not found.');
        }

        return view('consultant.show', compact('consultant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consultant = Consultant::find($id);

        if (!$consultant) {
            return redirect()->route('consultant.index')->with('error', 'Consultant not found.');
        }

        return view('consultant.edit', compact('consultant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $consultant = Consultant::find($id);

        if (!$consultant) {
            Alert::error('Error', 'Consultant not found.')->autoclose(3500);
            return redirect('consultant-management');
        }

        $attributes = $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'birth' => 'nullable|date_format:d-m-Y',
            'telp' => 'required|max:255',
            'jabatan' => 'nullable|max:255',
            'desc' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($consultant->photo && Storage::disk('public')->exists($consultant->photo)) {
                Storage::disk('public')->delete($consultant->photo);
            }
            // Upload the new photo
            $attributes['photo'] = $request->file('photo')->store('consultant', 'public');
        }

        $consultant->update($attributes);

        Alert::success('Sukses', 'Update Consultant Berhasil.')->autoclose(3500);
        return redirect('consultant');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id)
    {
        $consultant = Consultant::findOrFail($id);
        return view('consultant.confirm-delete', compact('consultant'));
    }

    public function delete($id)
{
    $consultant = Consultant::findOrFail($id);

    // Dapatkan path foto dari kolom photo
    $photoPath = $consultant->photo;

    if ($consultant->delete()) {
        // Hapus foto dari storage jika foto ada
        if ($photoPath !== null && Storage::exists($photoPath)) {
            Storage::delete($photoPath);
        }

        Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
    } else {
        Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
    }

    return redirect('consultant');
}

    
}
