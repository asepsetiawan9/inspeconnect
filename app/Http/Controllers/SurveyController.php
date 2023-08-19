<?php
namespace App\Http\Controllers;
use App\Models\Survey;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function submitSurvey(Request $request)
    {
        $schedule = Schedule::findOrFail($request->scheduleId);

        $schedule->survey()->create([
            'rating' => $request->rating
        ]);

        // Update survey_status
        $schedule->update([
            'survey_status' => 1
        ]);

        return response()->json(['message' => 'Survey berhasil disimpan'], 200);
    }
}