<?php
namespace App\Http\Controllers;

use App\Models\LGA;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LgaResultController extends Controller
{
    public function showSummedResults(Request $request)
    {
        $lgas = LGA::all();
        $selectedLga = null;
        $summedResults = [];

        if ($request->has('lga_id')) {
            $lgaId = $request->input('lga_id');
            $selectedLga = LGA::where('lga_id', $lgaId)->first();

            if (!$selectedLga) {
                return redirect()->back()->with('error', 'LGA not found.');
            }

            $summedResults = AnnouncedPuResult::select('party_abbreviation', DB::raw('SUM(party_score) as total_score'))
                ->join('polling_unit', 'announced_pu_results.polling_unit_uniqueid', '=', 'polling_unit.uniqueid')
                ->where('polling_unit.lga_id', $lgaId)
                ->groupBy('party_abbreviation')
                ->orderBy('party_abbreviation')
                ->get();
        }

        return view('lga_summed_results', compact('lgas', 'selectedLga', 'summedResults'));
    }
}

