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

class SetupController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function autoInsertPermission() : JsonResponse
    {
        try {
            $permissions    = [];
            $role           = Role::create([RoleConstant::COLUMN_NAME => RoleConstant::ROLE_SUPER_ADMIN]);
            $user           = User::find(1);

            foreach (PermissionConstant::ARRAY_PERMISSIONS as $permission) :
                $permissions[] = Permission::create([PermissionConstant::COLUMN_NAME => $permission]);
            endforeach;

            $role->syncPermissions($permissions);
            $user->syncRoles($role);

            return response()->json([
                'message'       => Constant::MSG_SETUP_SUCCESS,
                'errorCode'     => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable ) {
            return $this->catchErrorResponse();
        }
    }
}
