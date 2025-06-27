<?php
namespace App\Http\Controllers;

use App\Models\PollingUnit;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;

class PollingUnitController extends Controller
{
    public function showResults(Request $request)
    {
        $pollingUnits = PollingUnit::with(['lga', 'ward'])->get();
        $selectedPollingUnit = null;
        $results = [];

        if ($request->has('polling_unit_uniqueid')) {
            $pollingUnitUniqueId = $request->input('polling_unit_uniqueid');

            $selectedPollingUnit = PollingUnit::where('uniqueid', $pollingUnitUniqueId)
                                              ->with(['lga', 'ward'])
                                              ->first();

            if (!$selectedPollingUnit) {
                return redirect()->back()->with('error', 'Polling Unit not found.');
            }

            $results = AnnouncedPuResult::where('polling_unit_uniqueid', $pollingUnitUniqueId)->get();
        }

        return view('polling_unit_results', compact('pollingUnits', 'selectedPollingUnit', 'results'));
    }
}
