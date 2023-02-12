<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\User\UserRepository;
use App\Constants\UserConstant;
use App\Constants\Constant;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * @var userRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getUser(Request $request) : JsonResponse
    {
        try {
            if (null !== $request->userid) :
                if (! $user = $this->userRepository->find($request->userid)) :
                    return $this->exceptionResponse(UserConstant::MSG_NOT_FOUND);
                endif;

                return response()->json([
                    'user'      => $user,
                    'message'   => Constant::MSG_OK,
                    'error'     => Constant::ERR_CODE_OK
                ], Response::HTTP_OK);
            endif;

            return response()->json([
                'users'     => $this->userRepository->getAll(),
                'message'   => Constant::MSG_OK,
                'error'     => Constant::ERR_CODE_OK
            ], Response::HTTP_OK);
        } catch (\Exception ) {
            return $this->catchErrorResponse();
        }
    }

    public function updateAddress(UserRequest $request)
    {
        $user = auth()->user();
        $update = $this->userRepository->updateAddress($user->id, $request->ward_code);
        dd($update);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getUserAddress(Request $request) : JsonResponse
    {
        try {
            $user = $this->userRepository->find($request->id);

            return response()->json([
                'address_vi'    => getFullAddressVN($user),
                'address_en'    => getFullAddressEN($user),
                'message'       => Constant::MSG_OK,
                'error'         => Constant::ERR_CODE_OK
            ], Response::HTTP_OK);
        } catch (\Exception ) {
            return $this->exceptionResponse(Constant::MSG_ADDRESS_NOT_FOUND);
        }
    }
}
