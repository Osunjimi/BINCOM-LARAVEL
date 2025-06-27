<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\LgaResultController;
use App\Http\Controllers\ResultSubmissionController; // This controller handles storing new results

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Page (Optional)
Route::get('/', function () {
    return view('welcome');
});

// Question 1: Display individual polling unit results
Route::get('/polling-unit-results', [PollingUnitController::class, 'showResults'])->name('polling.unit.results');
// Allow POST requests for the form submission on this page
Route::post('/polling-unit-results', [PollingUnitController::class, 'showResults']);

// Question 2: Display summed total result of all polling units under any particular local government
Route::get('/lga-summed-results', [LgaResultController::class, 'showSummedResults'])->name('lga.summed.results');
// Allow POST requests for the form submission on this page
Route::post('/lga-summed-results', [LgaResultController::class, 'showSummedResults']);

// Question 3: Create a page to be used to store results for ALL parties for a new polling unit
// Changed route path from '/new-result' to '/new-polling-unit-result' for consistency with name
Route::get('/new-polling-unit-result', [ResultSubmissionController::class, 'create'])->name('new.polling.unit.result');
// Changed route path from '/new-result' to '/new-polling-unit-result' and name for consistency
Route::post('/new-polling-unit-result', [ResultSubmissionController::class, 'store'])->name('store.new.polling.unit.result');
