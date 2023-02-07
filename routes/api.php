<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Constants\PermissionConstant;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RolePermissionController;


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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'userProfile');
});

Route::controller(RoleController::class)->group(function () {
    // Route::group(['middleware' => ['permission:' . PermissionConstant::ARRAY_PERMISSIONS['read_role'] .'|'. PermissionConstant::ARRAY_PERMISSIONS['create_role'] .'']], function () {
    //     Route::get('role', 'getRole');
    //     Route::post('role', 'createRole');
    // });
    Route::post('role', 'createRole')->middleware('permission:' . PermissionConstant::ARRAY_PERMISSIONS['create_role']);
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('auto-insert-permission', 'autoInsertPermission');
    Route::get('permission', 'getPermission');
    Route::post('permission', 'createPermission');
});

Route::controller(RolePermissionController::class)->group(function () {
    Route::post('chown-permission', 'chownPermissionToRole');
    Route::post('chown-role', 'chownRoleToUser');
});