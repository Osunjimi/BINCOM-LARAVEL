<?php
namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\LGA;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class ResultSubmissionController extends Controller
{
    public function create()
    {
        $parties = Party::all();
        $lgas = LGA::all();
        return view('new_polling_unit_results', compact('parties', 'lgas'));
    }

    public function store(Request $request)
    {
        $rules = [
            'polling_unit_uniqueid' => 'required|string|max:50',
            'entered_by_user' => 'required|string|max:50',
            'party_scores' => 'required|array',
            'party_scores.*' => 'required|integer|min:0',
        ];

        $messages = [
            'polling_unit_uniqueid.required' => 'The polling unit unique ID is required.',
            'entered_by_user.required' => 'The user who entered the results is required.',
            'party_scores.required' => 'At least one party score is required.',
            'party_scores.*.required' => 'A score is required for each party.',
            'party_scores.*.integer' => 'Party scores must be whole numbers.',
            'party_scores.*.min' => 'Party scores cannot be negative.',
        ];

        try {
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->validate();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        DB::beginTransaction();

        try {
            foreach ($request->input('party_scores') as $partyAbbreviation => $score) {
                AnnouncedPuResult::create([
                    'polling_unit_uniqueid' => $request->input('polling_unit_uniqueid'),
                    'party_abbreviation' => $partyAbbreviation,
                    'party_score' => $score,
                    'entered_by_user' => $request->input('entered_by_user'),
                    'date_entered' => now(),
                    'user_ip_address' => $request->ip(),
                ]);
            }

            DB::commit();
            return redirect()->route('new.polling.unit.result')->with('success', 'Results stored successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing results: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving.')->withInput();
        }
    }
}
