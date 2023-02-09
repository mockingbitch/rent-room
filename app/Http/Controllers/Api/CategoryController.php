<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\Category\CategoryRepository;
use App\Constants\CategoryConstant;
use App\Constants\Constant;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCategory(Request $request) : JsonResponse
    {
        try {
            if ($request->id || null !== $request->id) :
                if (! $category = $this->categoryRepository->find($request->id)) :
                    return $this->exceptionResponse(CategoryConstant::MSG_NOT_FOUND);
                endif;

                return response()->json([
                    'category'  => $category,
                    'message'   => Constant::MSG_OK,
                    'error'     => Constant::ERR_CODE_OK,
                ], Response::HTTP_OK);
            endif;

            return response()->json([
                'categories'    => $this->categoryRepository->getAll(),
                'message'       => Constant::MSG_OK,
                'error'         => Constant::ERR_CODE_OK
            ], Response::HTTP_OK);
        } catch (\Exception ) {
            return $this->catchErrorResponse();
        }
    }

    /**
     * @param CategoryRequest $request
     *
     * @return JsonResponse
     */
    public function createCategory(CategoryRequest $request) : JsonResponse
    {
        if (! $this->categoryRepository->create($request->toArray())) :
            return $this->errorResponse(Constant::MSG_CREATE_FAILED);
        endif;

        return $this->successResponse(Constant::MSG_OK, Constant::ERR_CODE_OK, Response::HTTP_CREATED);
    }

    /**
     * @param CategoryRequest $request
     *
     * @return JsonResponse
     */
    public function updateCategory(CategoryRequest $request) : JsonResponse
    {
        if (! $this->categoryRepository->update($request->id, $request->toArray())) :
            return $this->errorResponse(Constant::MSG_UPDATE_FAILED);
        endif;

        return $this->successResponse();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteCategory(Request $request) : JsonResponse
    {
        if (! $this->categoryRepository->delete($request->id)) :
            return $this->errorResponse(Constant::MSG_DELETE_FAILED);
        endif;

        return $this->successResponse();
    }
}
