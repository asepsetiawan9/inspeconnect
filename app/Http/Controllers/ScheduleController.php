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
        $schedules = Schedule::with('skpd', 'consultant')->paginate(5);

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
        $userRole = Auth::user()->role;

        $attributes = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'about' => 'required',
            'place' => 'required',
        ]);

        // Determine the status based on the user's role
        $status = ($userRole === 'skpd') ? 2 : 1;

        $attributes['status'] = $status;
        // Assuming you have a 'opd_id' and 'consultant_id' fields in the 'schedules' table
        $attributes['opd_id'] = Auth::user()->opd_id; // Change 'opd_id' to the actual foreign key column
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
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
