<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\SkillController;
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

Route::name('api.')->group(function (){

    Route::group(['prefix' => 'jobs', 'as' => 'jobs.'], function (){
        Route::get('/', [JobController::class, 'index'])->name('search');
        Route::get('/{job}', [JobController::class, 'show'])->name('get-by-id');
        Route::post('/{job}/applications', [JobController::class, 'applyCandidateTo'])->name('candidate.apply-to-job');
    });

    Route::group(['prefix' => 'skills', 'as' => 'skills.'], function (){
        Route::get('/', [SkillController::class, 'index'])->name('all');
    });

    Route::group(['prefix' => 'auth/users', 'as' => 'auth.'], function (){
        Route::post('/', [AuthController::class, 'register'])->name('candidate.register');
        Route::post('/login', [AuthController::class, 'login'])->name('candidate.login');
    });

});
