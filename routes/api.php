<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkHoursController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'user'] , function () {
    Route::controller(AuthController::class)->group(function() {

    Route::post('/register' , 'register')->name('user.register');
    Route::post('/login' , 'login')->name('user.login');
    Route::post('/logout' , 'logout')->middleware('auth:sanctum');
});
});

Route::group(['prefix'=>'user' , 'middleware' => 'auth:sanctum'] , function () {
    Route::controller(AttendanceController::class)->group(function() {

    Route::get('/check_in' , 'checkIn');
    Route::get('/check_out' , 'checkOut');
});
});

Route::group(['prefix'=>'user' , 'middleware' => 'auth:sanctum'] , function () {
    Route::controller(WorkHoursController::class)->group(function() {

    Route::post('/get_total_hours' , 'getTotalHours');
});
});

