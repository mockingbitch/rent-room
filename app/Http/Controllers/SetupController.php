<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Constants\Constant;
use App\Constants\RoleConstant;
use App\Constants\PermissionConstant;
use App\Constants\AddressSQLRaw;
use DB;

class SetupController extends Controller
{

    public function setUp()
    {
        try {
            \Artisan::call('db:seed --class=SqlFileSeeder');
            \Artisan::call('migrate');
        } catch (\Exception $e) {
            echo 'Error migrate db';
        }

        try {
            $role               = Role::create([RoleConstant::COLUMN_NAME => RoleConstant::ROLE_SUPER_ADMIN]);
            $roleHouseHolder    = Role::create([RoleConstant::COLUMN_NAME => RoleConstant::ROLE_HOUSE_HOLDER]);
            $roleGuest          = Role::create([RoleConstant::COLUMN_NAME => RoleConstant::ROLE_GUEST]);
        } catch (\Exception $e) {
            echo 'Error create role. ';
        }

        try {
            $user = User::create([
                'name' => env('USER_NAME'),
                'email' => env('USER_EMAIL'),
                'password' => bcrypt(env('USER_PASSWORD'))
            ]);
        } catch (\Exception $e) {
            echo 'Error create user. ';
        }

        try {
            $permissions = [];

            foreach (PermissionConstant::PERMISSIONS as $permission) :
                $permissions[] = Permission::create([PermissionConstant::COLUMN_NAME => $permission]);
            endforeach;
        } catch (\Exception $e) {
            echo 'Error create permissions. ';
        }

        try {
            $role->syncPermissions($permissions);
            $user->syncRoles($role);
        } catch (\Exception $e) {
            echo 'Error sync role & permissions. ';
        }

        return response()->json([
            'message'       => Constant::MSG_SETUP_SUCCESS,
            'errorCode'     => Constant::ERR_CODE_OK
        ], Response::HTTP_CREATED);
    }
}
