<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Without Authentication
Route::get("listclubs",[ApiController::class, "listClubs"]);
Route::get("listclubs/{id}",[ApiController::class, "getSingleClub"]);
Route::post("addclub",[ApiController::class, "createClub"]);
Route::patch("updateclub/{id}",[ApiController::class, "updateClub"]);
Route::get("deleteclub/{id}",[ApiController::class, "deleteClub"]);


