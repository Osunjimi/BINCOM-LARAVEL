<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\LgaResultController;
use App\Http\Controllers\ResultSubmissionController;


Route::get('/', function () {
    return view('welcome');
});

// Display individual polling unit results
Route::get('/polling-unit-results', [PollingUnitController::class, 'showResults'])->name('polling.unit.results');

Route::post('/polling-unit-results', [PollingUnitController::class, 'showResults']);

//Display summed total result of all polling units under any particular local government
Route::get('/lga-summed-results', [LgaResultController::class, 'showSummedResults'])->name('lga.summed.results');

Route::post('/lga-summed-results', [LgaResultController::class, 'showSummedResults']);

//Create a page to be used to store results for ALL parties for a new polling unit
Route::get('/new-polling-unit-result', [ResultSubmissionController::class, 'create'])->name('new.polling.unit.result');

Route::post('/new-polling-unit-result', [ResultSubmissionController::class, 'store'])->name('store.new.polling.unit.result');
