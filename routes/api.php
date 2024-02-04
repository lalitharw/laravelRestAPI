<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post("/register",[UserController::class,"register"]);
Route::middleware('auth:sanctum')->group([
    function () {
        Route::get("/student", [StudentController::class, "index"]);
        Route::get("/student/{id}", [StudentController::class, "show"]);
        Route::post("/student", [StudentController::class, "store"]);
        Route::put("/student/{id}", [StudentController::class, "update"]);
        Route::delete("/student/delete/{id}", [StudentController::class, "destroy"]);
    }
]);
