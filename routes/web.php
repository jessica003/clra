<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\ContractorController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return redirect(url('/auth/login')); 
// });


Route::get('/',[AuthController::class, 'login'])->name('auth.login');
Route::post('/check',[AuthController::class, 'check'])->name('auth.check');
Route::get('/logout',[AuthController::class, 'logout'])->name('auth.logout');


Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/contractor-view-iv/{id}',[ContractorController::class, 'conviewiv']);
    Route::get('/contractor-add-iv/{id}/{audittype}',[ContractorController::class, 'conaddiv']);
    // Route::post('/contractor-add-ca',[ContractorController::class, 'conaddca']);
    Route::post('/contractor-location',[AuditorController::class, 'conLoc']);
    Route::get('/employer/dashboard',[AuthController::class, 'employerdashboard']);
    Route::get('/contractor/dashboard',[AuthController::class, 'contractordashboard']);
    Route::get('/auditor/dashboard',[AuthController::class, 'auditordashboard']);
    Route::resource('/contractor', ContractorController::class);
    Route::resource('/auditscheduler', AuditorController::class);
});
