<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\Tag\TagRepository;
use App\Constants\TagConstant;
use App\Constants\Constant;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getTag(Request $request) : JsonResponse
    {
        try {
            if ($request->id || null !== $request->id) :
                if (! $tag = $this->tagRepository->find($request->id)) :
                    return $this->exceptionResponse(TagConstant::MSG_NOT_FOUND);
                endif;

                return response()->json([
                    'tag'  => $tag,
                    'message'   => Constant::MSG_OK,
                    'error'     => Constant::ERR_CODE_OK,
                ], Response::HTTP_OK);
            endif;

            return response()->json([
                'tags'    => $this->tagRepository->getAll(),
                'message'       => Constant::MSG_OK,
                'error'         => Constant::ERR_CODE_OK
            ], Response::HTTP_OK);
        } catch (\Exception ) {
            return $this->catchErrorResponse();
        }
    }

    /**
     * @param TagRequest $request
     *
     * @return JsonResponse
     */
    public function createTag(TagRequest $request) : JsonResponse
    {
        if (! $this->tagRepository->create($request->toArray())) :
            return $this->errorResponse(Constant::MSG_CREATE_FAILED);
        endif;

        return $this->successResponse(Constant::MSG_OK, Constant::ERR_CODE_OK, Response::HTTP_CREATED);
    }

    /**
     * @param TagRequest $request
     *
     * @return JsonResponse
     */
    public function updateTag(TagRequest $request) : JsonResponse
    {
        if (! $this->tagRepository->update($request->id, $request->toArray())) :
            return $this->errorResponse(Constant::MSG_UPDATE_FAILED);
        endif;

        return $this->successResponse();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteTag(Request $request) : JsonResponse
    {
        if (! $this->tagRepository->delete($request->id)) :
            return $this->errorResponse(Constant::MSG_DELETE_FAILED);
        endif;

        return $this->successResponse();
    }
}
