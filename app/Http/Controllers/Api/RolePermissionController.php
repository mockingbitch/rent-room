<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Role\RoleRepositoryInterface as RoleRepository;
use App\Repositories\Permission\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\User\UserRepositoryInterface as UserRepository;
use App\Repositories\ModelHasRole\ModelHasRoleRepositoryInterface as ModelHasRoleRepository;
use App\Http\Requests\AssignRoleToPermissionRequest;
use App\Http\Requests\AssignRoleToUserRequest;
use App\Constants\Constant;
use App\Constants\RolePermissionConstant;
use App\Constants\RoleConstant;
use App\Constants\PermissionConstant;


class RolePermissionController extends Controller
{
    /**
     * @var roleRepository
     */
    protected $roleRepository;

    /**
     * @var permissionRepository
     */
    protected $permissionRepository;

    /**
     * @var userRepository
     */
    protected $userRepository;

    /**
     * @var modelHasRoleRepository
     */
    protected $modelHasRoleRepository;

    /**
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param UserRepository $userRepository
     * @param ModelHasRoleRepository $modelHasRoleRepository
     */
    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository,
        UserRepository $userRepository,
        ModelHasRoleRepository $modelHasRoleRepository
        )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;
        $this->modelHasRoleRepository = $modelHasRoleRepository;
    }

    /**
     * Chown permissions to role. 1 Role has multiple permissions
     *
     * @param RolePermissionRequest $request
     *
     * @return JsonResponse
     */
    public function chownPermissionToRole(AssignRoleToPermissionRequest $request) : JsonResponse
    {
        try {
            $role           = Role::find($request->role_id);
            $permissions    = Permission::find($request->permission_id);

            $role->syncPermissions($permissions);

            return response()->json([
                'message'   => RolePermissionConstant::MSG_CREATED,
                'errorCode' => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }

    /**
     * @param RolePermissionRequest $request
     *
     * @return JsonResponse
     */
    public function chownRoleToUser(AssignRoleToUserRequest $request)
    {
        try {
            $role = Role::find($request->role_id);
            $user = $this->userRepository->find($request->user_id);

            $user->syncRoles($role);

            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }
}
