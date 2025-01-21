<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentsApiController;
use App\Http\Controllers\Api\BlogTypeApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\FavoriteApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddExperienceApiController;


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

Route::post('/login', [AuthController::class, 'login']); // Login route

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']); // Logout route

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group the routes under a common prefix, e.g., 'students'
Route::prefix('student')->group(function () {
    Route::get('/', [StudentsApiController::class, 'index']);
    Route::post('/', [StudentsApiController::class, 'store']);
    Route::get('{id}', [StudentsApiController::class, 'show']);
    Route::put('{id}', [StudentsApiController::class, 'update']);
    Route::delete('{id}', [StudentsApiController::class, 'destroy']);
});

Route::prefix('blog_type')->group(function () {
    Route::get('/', [BlogTypeApiController::class, 'index']);
    Route::post('/', [BlogTypeApiController::class, 'store']);
    Route::get('{id}', [BlogTypeApiController::class, 'show']);
    Route::put('{id}', [BlogTypeApiController::class, 'update']);
    Route::delete('{id}', [BlogTypeApiController::class, 'destroy']);
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogApiController::class, 'index']);
    Route::post('/', [BlogApiController::class, 'store']);
    Route::get('{id}', [BlogApiController::class, 'show']);
    Route::put('{id}', [BlogApiController::class, 'update']);
    Route::delete('{id}', [BlogApiController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->post('/favorites/toggle', [FavoriteApiController::class, 'toggleFavorite']);
Route::middleware('auth:sanctum')->get('/favorites', [FavoriteApiController::class, 'getFavorites']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/experiences', [AddExperienceApiController::class, 'store']);
    Route::get('/experiences', [AddExperienceApiController::class, 'index']);
    Route::get('/experiences/{id}', [AddExperienceApiController::class, 'show']);
});