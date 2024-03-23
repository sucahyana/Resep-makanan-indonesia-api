<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DifficultyLevelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user() ? $request->user() : response()->json(['message' => 'Unauthorized'], 401);
})->middleware('auth:sanctum');

Route::prefix('api/v1')->group(function () {

	Route::prefix('/auth')->group(function () {
		Route::post('/register', [AuthController::class, 'register']);
		Route::post('/login', [AuthController::class, 'login'])->name('login');
		Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
	});

	Route::prefix('/recipes')->group(function () {
		Route::post('/', [RecipeController::class, 'store'])->name('store')->middleware('auth:sanctum');
		Route::get('/', [RecipeController::class, 'index'])->name('index');
		Route::put('/{id}', [RecipeController::class, 'update'])->name('update')->middleware('auth:sanctum');
		Route::delete('/{id}', [RecipeController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
		Route::get('/{id}', [RecipeController::class, 'show'])->name('show');

	});


	Route::prefix('/categories')->group(function () {
		Route::get('/list', [CategoryController::class, 'getCategoryList'])->name('categoryList');
		Route::get('/{category_id}', [CategoryController::class, 'searchByCategory'])->name('category');
	});

	Route::prefix('/difficulty-levels')->group(function () {
		Route::get('/list', [DifficultyLevelController::class, 'getDifficultyLevels'])->name('difficultyLevels');
		Route::get('/{difficulty_level_id}', [DifficultyLevelController::class, 'searchByDifficultyLevel'])->name('difficultyLevel');
	});
});
