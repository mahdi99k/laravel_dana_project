<?php

use App\Http\Controllers\admin\InojobAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\profile\UserController;
use App\Http\Controllers\website\FestivalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\InojobController;
use App\Http\Controllers\API\DataController;
use Illuminate\Http\Request;

Route::get('sayHello', function () {
    return "644Sc)64";
});
Route::post('getCode', [AuthController::class, 'getCode'])->name('getCode');
Route::post('sendCode', [AuthController::class, 'sendCode'])->name('sendCode');
Route::get('getInojob', [InojobController::class, 'getInojob'])->name('getInojob');
Route::get('getInojobs', [InojobController::class, 'getInojobs'])->name('getInojobs');
Route::get('doIt', [InojobController::class, 'doIt'])->name('doIt');
Route::get('getInojobsFields', [InojobController::class, 'getInojobsFields'])->name('getInojobsFields');
Route::get('getProvinces', [DataController::class, 'getProvinces'])->name('getProvinces');
Route::get('getCountries', [DataController::class, 'getCountries'])->name('getCountries');
Route::get('getCities/{id}', [DataController::class, 'getCities'])->name('getCities');
Route::get('getJournals', [DataController::class, 'getJournals'])->name('getJournals');
Route::get('getPublisher', [DataController::class, 'getPublisher'])->name('getPublisher');
Route::get('getScoreMajors', [DataController::class, 'getScoreMajors'])->name('getScoreMajors');
Route::get('getMajors', [DataController::class, 'getMajors'])->name('getMajors');
Route::get('getUniversities', [DataController::class, 'getUniversities'])->name('getUniversities');
Route::get('updateJsonFields', [UserController::class, 'updateJsonFields'])->name('updateJsonFields');
Route::get('getScoreInfo', [UserController::class, 'getScoreInfo']);
Route::get('getScoreInfo/{cert}/', [UserController::class, 'getCertScoreInfo']);
Route::get('getScoreInfo/{cert}/{type}', [UserController::class, 'getCertTypeScoreInfo']);
Route::get('getScoreInfo/{cert}/{type}/{filter}', [UserController::class, 'getCertTypeFilterScoreInfo']);
Route::post('storeScoreInfo', [UserController::class, 'storeScoreInfo']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('sendCodeAdmin', [AuthController::class, 'sendCode'])->name('sendCodeAdmin');

    Route::get('us', [UserController::class, 'updateUserScore'])->name('us');
    Route::post('setPriority', [InojobController::class, 'setPriority'])->name('setPriority');
    Route::post('addScore', [UserController::class, 'addScore'])->name('addScore');
    Route::post('updateScore/{id}', [UserController::class, 'updateScore'])->name('updateScore');
    Route::delete('deleteScore/{id}', [UserController::class, 'deleteScore'])->name('deleteScore');
    Route::get('getScore', [UserController::class, 'getScore'])->name('getScore');
    Route::get('getScores', [UserController::class, 'getScores'])->name('getScores');
    Route::get('getScores/{cert}', [UserController::class, 'getCertScores'])->name('getCertScores');
    Route::get('getScores/{cert}/{type}', [UserController::class, 'getCertTypeScores'])->name('getCertTypeScores');
    Route::group(['prefix' => '/inojobAdmin'], function () {
        Route::get('getUserData/{cert}/{type}/{userId}', [InojobAdminController::class, 'getUserData'])->name('getUserData');
        Route::get('getUserData/{cert}/{userId}', [InojobAdminController::class, 'getUserDataCert'])->name('getUserDataCert');
        Route::get('getUser/{userId}', [InojobAdminController::class, 'getUser'])->name('getUser');
        Route::get('getUsers', [InojobAdminController::class, 'getUsers'])->name('getUsers');
        Route::get('getPriorities/{userId}', [InojobAdminController::class, 'getPriorities'])->name('getPriorities');
    });

    Route::post('updateUser', [UserController::class, 'updateUser'])->name('updateUser');
    Route::get('getUser', [UserController::class, 'getUser'])->name('getUser');
    Route::post('userUpload', [UserController::class, 'userUpload'])->name('userUpload');
    Route::post('scoreUpload', [UserController::class, 'scoreUpload'])->name('scoreUpload');
    Route::get('getPriorities', [InojobController::class, 'getPriorities'])->name('getPriorities');
    Route::post('addPriority/{id}', [InojobController::class, 'addPriority'])->name('addPriority');
    Route::delete('deletePriority/{id}', [InojobController::class, 'deletePriority'])->name('deletePriority');
    Route::post('updatePriority/{id}', [InojobController::class, 'updatePriority'])->name('updatePriority');
    Route::get('getUserCase', [InojobController::class, 'getUserCase'])->name('getUserCase');
    Route::get('getPrioritiesStatus', [InojobController::class, 'getPrioritiesStatus'])->name('getPrioritiesStatus');
    Route::post('sendUserCase', [UserController::class, 'sendUserCase'])->name('sendUserCase');
    Route::delete('deleteUserCase', [InojobController::class, 'deleteUserCase'])->name('deleteUserCase');

    //---------- Score Info
    Route::get('getScoreInfo', [UserController::class, 'getScoreInfo']);
    Route::get('getScoreInfo/{cert}/', [UserController::class, 'getCertScoreInfo']);
    Route::get('getScoreInfo/{cert}/{type}', [UserController::class, 'getCertTypeScoreInfo']);
    Route::get('getScoreInfo/{cert}/{type}/{filter}', [UserController::class, 'getCertTypeFilterScoreInfo']);
    Route::post('storeScoreInfo', [UserController::class, 'storeScoreInfo']);
    Route::put('updateScoreInfo/{scoreInfo}', [UserController::class, 'updateScoreInfo']);

    //---------- Festival (types+levels+majors)
    Route::get('/getFestivalType', [FestivalController::class, 'getFestivalType']);
    Route::get('/getFestivalLevel/{id}', [FestivalController::class, 'getFestivalLevel']);
    Route::get('/getFestivalMajor/{id}', [FestivalController::class, 'getFestivalMajor']);

    Route::get('test', function () {
        return 'working';
    });
});

