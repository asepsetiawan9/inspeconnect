<?php
namespace App\Http\Controllers;
use App\Models\SurveyReport;
use App\Models\Report;
use Illuminate\Http\Request;

class SurveyReportController extends Controller
{
    public function submitSurvey(Request $request)
    {
        // dd($request);
        $report = Report::findOrFail($request->reportId);

        $report->survey()->create([
            'rating' => $request->rating
        ]);

        $report->update([
            'survey_status' => 1
        ]);

        return response()->json(['message' => 'Survey berhasil disimpan'], 200);
    }
}