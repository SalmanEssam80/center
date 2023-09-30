<?php

use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\ClassRoomController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\ManagerController;
use App\Http\Controllers\api\UserAuthController;
use App\Http\Controllers\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('companies',CompanyController::class);
Route::apiResource('branches',BranchController::class);
Route::apiResource('managers',ManagerController::class);
Route::apiResource('classRooms',ClassRoomController::class);
Route::apiResource('employees',EmployeeController::class);

Route::post('user/auth/login',[UserAuthController::class,'login']);
Route::post('user/auth/register',[UserAuthController::class,'register']);

Route::get('user/posts',[PostController::class,'index']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user/posts/sanctum',[PostController::class,'indexSanctum']);
});
