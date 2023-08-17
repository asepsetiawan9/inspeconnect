<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Str;
use Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporanDikirim;
use App\Mail\NotifLaporanBaru;
use App\Mail\StatusLaporanBerubah;
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
        $userId = auth()->user()->id;
        $isAdmin = auth()->user()->role === 'admin';

        if($isAdmin){
            $reports = Report::with('user')->paginate(5);

        }else{
            $reports = Report::with('user')
                            ->where('user_id', $userId)
                            ->paginate(5);
        }
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
        $userRole = Auth::user()->role;
        $defaultRole = in_array($userRole, ['warga', 'skpd']) ? $userRole : '';

        // Fetch users based on the role (adjust this logic based on your database structure)
        $users = User::where('role', $userRole)->get();

        return view('report.create', compact('defaultRole', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
            'photos' => 'required|array|max:5', // Maksimal 5 file
            'photos.*' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
        ]);

        // Simpan data laporan ke database
        $report = new Report();
        $report->name = $request->name;
        $report->desc = $request->desc;
        $report->role = $request->role;
        $report->pertemuan = $request->pertemuan;
        $report->kontak = $request->kontak;
        $report->datetime = $request->datetime;
        $report->tempat_bertemu = $request->tempat_bertemu;
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
            // Mengirim email notifikasi kepada user
            if ($userRole === 'skpd' || $userRole === 'warga') {
                    Mail::to($report->user->email)->send(new LaporanDikirim($report));
        
                // Mengirim email notifikasi kepada admin
                $adminEmail = 'atot_tea@yahoo.com';
                Mail::to($adminEmail)->send(new NotifLaporanBaru($report));
            }
    
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
                ->route('report')
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
// dd($report);
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
        $report->pertemuan = $request->pertemuan;
        $report->kontak = $request->kontak;
        $report->datetime = $request->datetime;
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
            'respon_admin' => 'required',
        ]);

        // Find the report by ID
        $report = Report::findOrFail($id);

        // Update the status and respon_admin
        $report->status = $request->status;
        $report->respon_admin = $request->respon_admin;
        $report->save();

        // Get the status label
        $statusLaporan = '';
        if ($report->status === '1') {
            $statusLaporan = 'Selesai';
        } elseif ($report->status === '2') {
            $statusLaporan = 'Perlu di Tindak Lanjuti';
        } elseif ($report->status === '3') {
            $statusLaporan = 'Diproses';
        }

        // dd($statusLaporan);

        // Send the email
        $userEmail = $report->user->email;
        Mail::to($userEmail)->send(new StatusLaporanBerubah($report, $statusLaporan));

        // Return a success response
        return response()->json(['message' => 'Status and Respon Admin updated successfully'], 200);
    }

}
