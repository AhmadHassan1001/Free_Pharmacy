<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/getmedicines',[MedicineController::class,'getmedicines']);
Route::get('/getparts/{id}',[MedicineController::class,'getparts']);
Route::get('/getpartsexpired',[MedicineController::class,'getpartsexpired']);
Route::get('/getpartsbyexp',[MedicineController::class,'getpartsbyexp']);
Route::get('/getmedicinebyname',[MedicineController::class,'getmedicinebyname']);
Route::get('/getmedicinesbyactives',[MedicineController::class,'getmedicinesbyactives']);
Route::post('/addparts',[MedicineController::class,'addparts']);
Route::post('/giveparts',[MedicineController::class,'giveparts']);