<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\AuthController;

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

Route::name('api.')->group(function (){

    Route::name('jobs.')->group(function (){
        Route::get('jobs', [JobController::class, 'index'])->name('search');
        Route::get('jobs/{job}', [JobController::class, 'show'])->name('get-by-id');
        Route::post('jobs/{job}/applications', [JobController::class, 'applyCandidateTo'])->name('candidate.apply-to-job');
    });

    Route::name('skills.')->group(function (){
        Route::get('skills', [SkillController::class, 'index'])->name('all');
    });

    Route::name('auth.')->group(function (){
        Route::post('users', [AuthController::class, 'register'])->name('candidate.register');
        Route::post('users/login', [AuthController::class, 'login'])->name('candidate.login');
    });

});
