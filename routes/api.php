<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\StarWarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:api')->group(function () {
    Route::get('/people', [StarWarsController:: class, 'getPeople']);
    Route::get('/people/{id}', [StarWarsController:: class, 'getPersonById']);
    Route::get('/planets', [StarWarsController:: class, 'getPlanets']);
    Route::get('/planets/{id}', [StarWarsController:: class, 'getPlanetById']);
    Route::get('/vehicles', [StarWarsController:: class, 'getVehicles']);
    Route::get('/vehicles/{id}', [StarWarsController:: class, 'getVehicleById']);
});

