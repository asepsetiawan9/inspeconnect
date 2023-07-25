<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Str;
use Alert;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('user')->paginate(5);

        return view('report.index', compact('reports'));
    }
    public function getUsersByRole($role)
    {
        $users = User::where('role', $role)
            ->where('status', 1)
            ->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $userRole = Auth::user()->role;

        // Menentukan nilai status berdasarkan peran pengguna
        if ($userRole === 'admin') {
            $status = 1;
        } else {
            $status = 2;
        }

        // Validasi data yang diterima dari request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'role' => 'required|string|in:warga,skpd',
            'photos' => 'required|array|max:5', // Maksimal 5 foto
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya menerima format gambar
        ]);

        // Simpan data laporan ke database
        $report = new Report();
        $report->name = $request->name;
        $report->desc = $request->desc;
        $report->role = $request->role;
        $report->user_id = $request->user_id;
        $report->status = $status;

        if ($request->hasFile('photos')) {
            $photosPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPath = Str::random(10) . '.' . $photo->getClientOriginalExtension();
                Storage::putFileAs('public/report', $photo, $photoPath);
                $photosPaths[] = $photoPath;
            }
            $report->photos = json_encode($photosPaths);
        }

        if ($report->save()) {
            Alert::success('Sukses', 'Laporan berhasil dikirim.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }
        return redirect('report');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('user')->find($id);
        // dd($report);

        if (!$report) {
            return redirect()
                ->route('consultant.index')
                ->with('error', 'Report not found.');
        }

        return view('report.show', compact('report'));
    }

    public function edit($id)
    {
        // Fetch the report data based on the given ID
        $report = Report::find($id);

        // Check if the report is found
        if (!$report) {
            return redirect()
                ->route('report.index')
                ->with('error', 'Report not found.');
        }

        // Fetch all users to populate the select input
        $users = User::all();

        // Assuming you want to restrict editing to certain roles
        $allowedRoles = ['admin', 'your_other_allowed_roles'];
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            return redirect()
                ->route('report.index')
                ->with('error', 'You are not authorized to edit this report.');
        }

        return view('report.edit', compact('report', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Fetch the report data based on the given ID
        $report = Report::find($id);

        // Check if the report is found
        if (!$report) {
            return redirect()
                ->route('report.index')
                ->with('error', 'Report not found.');
        }

        // Assuming you want to restrict editing to certain roles
        $allowedRoles = ['admin', 'your_other_allowed_roles'];
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            return redirect()
                ->route('report.index')
                ->with('error', 'You are not authorized to edit this report.');
        }

        // Validasi data yang diterima dari request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'role' => 'required|string|in:warga,skpd',
            'photos' => 'required|array|max:5', // Maksimal 5 foto
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya menerima format gambar
        ]);

        // Update data laporan di database
        $report->name = $request->name;
        $report->desc = $request->desc;
        $report->role = $request->role;
        $report->user_id = $request->user_id;

        if ($request->hasFile('photos')) {
            $photosPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPath = Str::random(10) . '.' . $photo->getClientOriginalExtension();
                Storage::putFileAs('public/report', $photo, $photoPath);
                $photosPaths[] = $photoPath;
            }
            $report->photos = json_encode($photosPaths);
        }

        if ($report->save()) {
            Alert::success('Sukses', 'Laporan berhasil diperbarui.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data.')->autoclose(3500);
        }
        return redirect('report');
    }

    public function confirmDelete($id)
    {
        $report = Report::findOrFail($id);
        return view('report.confirm-delete', compact('report'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $report = Report::findOrFail($id);

        // Get paths of photos from the photos column
        $photoPaths = json_decode($report->photos, true);

        if ($report->delete()) {
            // Delete photos from storage if they exist
            if ($photoPaths !== null && is_array($photoPaths)) {
                foreach ($photoPaths as $photoPath) {
                    if (Storage::exists('public/report/' . $photoPath)) {
                        Storage::delete('public/report/' . $photoPath);
                    }
                }
            }

            Alert::success('Sukses', 'Data berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.')->autoclose(3500);
        }

        return redirect('report');
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        // Find the report by ID
        $report = Report::findOrFail($id);

        // Update the status
        $report->status = $request->status;
        $report->save();

        // Return a success response
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}
