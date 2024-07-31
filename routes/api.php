<?php
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\KlubController;
use App\Http\Controllers\Api\PemainController;
use App\Http\Controllers\Api\FanController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']); //logout
    //liga
    Route::resource('liga', LigaController::class)->except(['edit', 'create']);
    //klub
    Route::resource('klub', KlubController::class)->except(['edit', 'create']);
    //pemain
    Route::resource('pemain', PemainController::class)->except(['edit', 'create']);
    //fans
    Route::resource('fan', FanController::class)->except(['edit', 'create']);
});

//Auth route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);




//manual
// Route::get('liga', [LigaController::class, 'index']);
// Route::post('liga', [LigaController::class, 'store']);
// Route::get('liga/{id}', [LigaController::class, 'show']);
// Route::put('liga/{id}', [LigaController::class, 'update']);
// Route::delete('liga/{id}', [LigaController::class, 'destroy']);

//metik
// Route::resource('klub', KlubController::class)->except(['edit', 'create']);
// Route::resource('pemain', PemainController::class)->except(['edit', 'create']);
// Route::resource('fan', FanController::class)->except(['edit', 'create']);
