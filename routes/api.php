<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Constants\PermissionConstant;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Controllers\SetupController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

Route::controller(SetupController::class)->group(function () {
    Route::get('auto-insert-permission', 'autoInsertPermission');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'userProfile');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'getRole')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['read_role']);
    Route::post('role', 'createRole')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['create_role']);
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('permission', 'getPermission')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['read_permission']);
    Route::post('permission', 'createPermission')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['create_permission']);
});

Route::controller(RolePermissionController::class)->group(function () {
    Route::post('chown-permission', 'chownPermissionToRole')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['chown_permission']);
    Route::post('chown-role', 'chownRoleToUser')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['chown_role']);
});