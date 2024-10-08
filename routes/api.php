<?php

use App\Http\Controllers\Api\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('attendances', AttendanceController::class);
Route::get('attendance/view', [AttendanceController::class, 'view']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
