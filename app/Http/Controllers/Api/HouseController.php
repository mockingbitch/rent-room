<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\House\HouseRepositoryInterface as HouseRepository;
use App\Http\Requests\HouseRequest;
use App\Constants\Constant;
use App\Constants\HouseConstant;

class HouseController extends Controller
{
    /**
     * @var houseRepository
     */
    protected $houseRepository;

    /**
     * @param HouseRepository $houseRepository
     */
    public function __construct(HouseRepository $houseRepository)
    {
        $this->houseRepository = $houseRepository;
    }

    /**
     * int id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getHouse(Request $request) : JsonResponse
    {
        try {
            if ($request->id || null !== $request->id) :
                if (! $house = $this->houseRepository->find($request->id)) :
                    return $this->exceptionResponse(HouseConstant::MSG_NOT_FOUND);
                endif;

                $house->address_vi      = getFullAddressVN($house);
                $house->address_en      = getFullAddressEN($house);
                $house->category_id     = getCategoryId($house);
                $house->category_name   = getCategoryName($house);

                return response()->json([
                    'house'     => $house,
                    'message'   => Constant::MSG_OK,
                    'error'     => Constant::ERR_CODE_OK,
                ], Response::HTTP_OK);
            endif;

            return response()->json([
                'houses'        => $this->houseRepository->getAll(),
                'message'       => Constant::MSG_OK,
                'error'         => Constant::ERR_CODE_OK
            ], Response::HTTP_OK);
        } catch (\Exception ) {
            return $this->catchErrorResponse();
        }
    }

    /**
     * string name | ?string type | ?string description | string ward_code | integer category_id
     * @param HouseRequest $request
     *
     * @return JsonResponse
     */
    public function createHouse(HouseRequest $request) : JsonResponse
    {
        if (! $this->houseRepository->createHouse($request->toArray())) :
            return $this->errorResponse(Constant::MSG_CREATE_FAILED);
        endif;

        return $this->successResponse(Constant::MSG_OK, Constant::ERR_CODE_OK, Response::HTTP_CREATED);
    }

    /**
     * int id | string name | ?string type | ?string description | string ward_code | integer category_id
     * @param HouseRequest $request
     *
     * @return JsonResponse
     */
    public function updateHouse(HouseRequest $request) : JsonResponse
    {
        if (! $this->houseRepository->updateHouse($request->id, $request->toArray())) :
            return $this->errorResponse(Constant::MSG_UPDATE_FAILED);
        endif;

        return $this->successResponse();
    }

    /**
     * int id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteHouse(Request $request) : JsonResponse
    {
        if (! $this->houseRepository->delete($request->id)) :
            return $this->errorResponse(Constant::MSG_DELETE_FAILED);
        endif;

        return $this->successResponse();
    }
}
