<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Constants\Constant;
use App\Constants\PermissionConstant;
use App\Repositories\Permission\PermissionRepositoryInterface as PermissionRepository;
class PermissionController extends Controller
{
    /**
     * @var permissionRepository
     */
    protected $permissionRepository;

    /**
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return JsonResponse
     */
    public function getPermission() : JsonResponse
    {
        try {
            $permissions = $this->permissionRepository->getAll();

            return response()->json([
                'permissions'   => $permissions,
                'message'       => Constant::MSG_OK,
                'errorCode'     => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }

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
