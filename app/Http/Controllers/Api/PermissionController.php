<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionRequest;
use App\Constants\Constant;
use App\Constants\PermissionConstant;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * @param PermissionRequest $request
     *
     * @return JsonResponse
     */
    public function createPermission(PermissionRequest $request) : JsonResponse
    {
        try {
            $permission = Permission::create([PermissionConstant::COLUMN_NAME => $request->name]);

            return response()->json([
                'permission'    => $permission,
                'message'       => PermissionConstant::MSG_CREATED,
                'errorCode'     => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }
}
