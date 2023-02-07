<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Constants\RoleConstant;
use App\Http\Requests\RoleRequest;
use App\Constants\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * @var roleRepository
     */
    protected $roleRepository;

    /**
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getRole(Request $request) : JsonResponse
    {
        try {
            $roles = $this->roleRepository->getAll();

            return response()->json([
                'roles'     => $roles,
                'message'   => Constant::MSG_OK,
                'errorCode' => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }

    /**
     * @param RoleRequest $request
     *
     * @return JsonResponse
     */
    public function createRole(RoleRequest $request) : JsonResponse
    {
        try {
            $role = Role::create([RoleConstant::COLUMN_NAME => $request->name]);

            return response()->json([
                'role'      => $role,
                'message'   => RoleConstant::MSG_CREATED,
                'errorCode' => Constant::ERR_CODE_OK
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->catchErrorResponse();
        }
    }
}
