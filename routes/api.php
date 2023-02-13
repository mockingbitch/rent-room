<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Constants\PermissionConstant;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HouseController;


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
Route::get('/reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

Route::controller(SetupController::class)->group(function () {
    Route::get('setup-request', 'setUp');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'userProfile');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'getRole')->middleware('permission:' . PermissionConstant::PERMISSIONS['read_role']);
    Route::post('role', 'createRole')->middleware('permission:' . PermissionConstant::PERMISSIONS['create_role']);
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('permission', 'getPermission')->middleware('permission:' . PermissionConstant::PERMISSIONS['read_permission']);
    Route::post('permission', 'createPermission')->middleware('permission:' . PermissionConstant::PERMISSIONS['create_permission']);
});

Route::controller(RolePermissionController::class)->group(function () {
    Route::post('chown-permission', 'chownPermissionToRole')->middleware('permission:' . PermissionConstant::PERMISSIONS['chown_permission']);
    Route::post('chown-role', 'chownRoleToUser')->middleware('permission:' . PermissionConstant::PERMISSIONS['chown_role']);
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'getCategory');
    Route::post('category', 'createCategory')->middleware('permission:' . PermissionConstant::PERMISSIONS['create_category']);
    Route::put('category', 'updateCategory')->middleware('permission:'. PermissionConstant::PERMISSIONS['update_category']);
    Route::delete('category', 'deleteCategory')->middleware('permission:'. PermissionConstant::PERMISSIONS['delete_category']);
});

Route::controller(TagController::class)->group(function () {
    Route::get('tag', 'getTag');
    Route::post('tag', 'createTag')->middleware('permission:' . PermissionConstant::PERMISSIONS['create_tag']);
    Route::put('tag', 'updateTag')->middleware('permission:'. PermissionConstant::PERMISSIONS['update_tag']);
    Route::delete('tag', 'deleteTag')->middleware('permission:'. PermissionConstant::PERMISSIONS['delete_tag']);
});

Route::controller(UserController::class)->group(function () {
    Route::post('user/address', 'updateAddress');
    Route::get('/user/address', 'getUserAddress');
});

Route::controller(HouseController::class)->group(function () {
    Route::get('house', 'getHouse');
    Route::post('house', 'createHouse');
    Route::put('house', 'updateHouse');
});
