<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Consultant;
use Illuminate\Http\Request;
use App\Models\Skpd;
use Illuminate\Support\Facades\Auth;
use Alert;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the user ID of the logged-in user
        $userId = auth()->user()->id;
        $isAdmin = auth()->user()->role === 'admin';

        if($isAdmin){
            $schedules = Schedule::with('skpd', 'consultant')->paginate(5);
        }else{
            $schedules = Schedule::with('skpd', 'consultant')
                            ->where('user_id', $userId)
                            ->paginate(5);
        }

        return view('schedule.index', compact('schedules'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultants = Consultant::paginate(8);
        
        return view('schedule.create', compact('consultants'));
    }
    public function createSchedule($consultantId)
    {
        $skpds = Skpd::all();
        $consultant = Consultant::find($consultantId);
        $userRole = auth()->user()->role;

        if (!$consultant) {
            // Handle if the consulatnt is not found
            return redirect()->route('your-error-route')->with('error', 'Consultant not found.');
        }

        // Pass the $consultant to your view or handle the logic for scheduling here
        return view('schedule.createschedule', compact('consultant', 'skpds', 'userRole'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $user = Auth::user();
        $userRole = $user->role;

        $attributes = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'about' => 'required',
            'place' => 'required',
            'pertemuan' => 'required',
        ]);

        // Determine the status based on the user's role
        $status = ($userRole === 'skpd') ? 2 : 1;

        $attributes['status'] = $status;
        $attributes['user_id'] = $user->id; // Set user_id based on the logged-in user

        // Assuming you have a 'opd_id' and 'consultant_id' fields in the 'schedules' table
        $attributes['opd_id'] = $request->opd_id; // Change 'opd_id' to the actual foreign key column
        $attributes['consultant_id'] = $request->consultant_id;

        try {
            Schedule::create($attributes);
            Alert::success('Sukses', 'Jadwal Konsultasi Berhasil Dibuat.')->autoclose(3500);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }
        return redirect('schedule/create');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);

        // Check if the schedule is not found
        if (!$schedule) {
            return redirect()->route('your-error-route')->with('error', 'Schedule not found.');
        }

        $consultantId = $schedule->consultant_id;
        $opdId = $schedule->opd_id;

        // Find the consultant and check if it's not found
        $consultant = Consultant::find($consultantId);
        if (!$consultant) {
            return redirect()->route('your-error-route')->with('error', 'Consultant not found.');
        }

        // Find all SKPDs
        $skpd = Skpd::find($opdId);


        return view('schedule.show', compact('schedule', 'consultant', 'skpd'));
    }


    public function edit($id)
    {
        $schedule = Schedule::find($id);

        // Check if the schedule is not found
        if (!$schedule) {
            return redirect()->route('your-error-route')->with('error', 'Schedule not found.');
        }

        $consultantId = $schedule->consultant_id;
        $opdId = $schedule->opd_id;

        // Find the consultant and check if it's not found
        $consultant = Consultant::find($consultantId);
        if (!$consultant) {
            return redirect()->route('your-error-route')->with('error', 'Consultant not found.');
        }

        // Find all SKPDs
        $skpds = Skpd::all();

        // Find the selected SKPD (if any)
        $selectedSkpd = Skpd::find($opdId);

        $userRole = auth()->user()->role;

        return view('schedule.edit', compact('consultant', 'schedule', 'skpds', 'selectedSkpd', 'userRole', 'opdId'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $user = Auth::user();
        $userRole = $user->role;
        $userRole = Auth::user()->role;
    
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'about' => 'required',
            'place' => 'required',
            'pertemuan' => 'required',
        ]);
    
        // Determine the status based on the user's role
        $status = ($userRole === 'skpd') ? 2 : 1;
        $attributes['user_id'] = $user->id;
    
        $attributes['status'] = $status;
        // Assuming you have a 'opd_id' and 'consultant_id' fields in the 'schedules' table
        $attributes['opd_id'] = $request->opd_id; // Change 'opd_id' to the actual foreign key column
        $attributes['consultant_id'] = $request->consultant_id; 
    
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->update($attributes);
            Alert::success('Sukses', 'Jadwal Konsultasi Berhasil Diupdate.')->autoclose(3500);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.')->autoclose(3500);
        }
        return redirect('schedule/create');
    }
    
    // ScheduleController.php
    public function updateStatus(Request $request, Schedule $schedule)
    {
        $request->validate([
            'status' => 'required|in:1,2,3,4', // Validating the status field
            'respon_admin' => 'required', // Validating the respon_admin field
        ]);
    
        // Update the status and respon_admin in the database
        $schedule->update([
            'status' => $request->status,
            'respon_admin' => $request->respon_admin,
        ]);

        return response()->json(['message' => 'Status and Respon Admin updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedule.confirm-delete', compact('schedule'));
    }

    public function delete($id)
    {
        $schedule = Schedule::findOrFail($id);

        if ($schedule->delete()) {
            Alert::success('Sukses', 'Jadwal berhasil dihapus.')->autoclose(3500);
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus jadwal.')->autoclose(3500);
        }

        return redirect('schedule');
    }

}
