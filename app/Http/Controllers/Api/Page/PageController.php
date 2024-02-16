<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\system\pageRequest;
use App\Http\Resources\PageResource;
use App\Repositories\System\PageRepository;
use App\Services\System\PageService;
use Illuminate\Http\Request;


class PageController extends ApiController
{
    public function __construct(PageService $pageService, PageRepository $pageRepository)
    {
        $this->service = $pageService;
        $this->repository = $pageRepository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/pages",
     *      summary="Get list of projects",
     *      tags={"Pages"},
     *      description="Returns list of pages",
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(type="object")
     *             },
     *             @OA\Examples(example="result", value= {
     *             "title": "Iste quos laboris qu",
     *             "description": "<p>sdafadsfasd</p>",
     *             "image": "http://127.0.0.1:8000/storage/uploads/page/RR8liBRVijrnxWxCjYn58kEqJwCRfHsmmDzcip0j.jpg",
     *                   "meta_title": "Reprehenderit dolore update",
     *                   "meta_description": "Sit ullamco veniam update",
     *                 "status": true
     *               }, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *       ),
     *     )
     */

    public function index(Request $request)
    {
        $pages = $this->repository->getAllData($request);
        return $this->respondWithCollection(PageResource::collection($pages));
    }

    // /**
    //  * @OA\Get(
    //  *      path="/api/v1/pages/{id}",
    //  *      tags={"Pages"},
    //  *      summary="Get pages information",
    //  *      description="Returns pages data",
    //  *      @OA\Parameter(
    //  *          name="id",
    //  *          description="page id",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *      @OA\Response(
    //  *          response=200,
    //  *          description="Successful operation",
    //  *       ),
    //  *      @OA\Response(
    //  *          response=400,
    //  *          description="Bad Request"
    //  *      ),
    //  *      @OA\Response(
    //  *          response=401,
    //  *          description="Unauthenticated",
    //  *      ),
    //  *      @OA\Response(
    //  *          response=403,
    //  *          description="Forbidden"
    //  *      )
    //  * )
    //  */



    // public function detailInfo($id)
    // {
    //     $page = $this->repository->checkById($id);
    //     if ($page == null) {
    //         return $this->errorNotFound();
    //     }
    //     return $this->respondWithItem(new PageResource($page));
    // }


    /**
     * @OA\Post(
     *     path="/api/v1/pages",
     *     operationId="create",
     *      tags={"Pages"},
     *     summary="Create Page",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="description",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="meta_title",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="meta_description",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="keywords",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="image",
     *                     oneOf={
     *                     	   @OA\Schema(type="file"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="status",
     *                     oneOf={
     *                     	   @OA\Schema(type="boolean"),
     *                     }
     *                 ),
     *                 example={"title": "page title" , "slug": "slug", "description": "this is description", "meta_title": "meta title", "meta_description":"this is meta description","keywords":"meta","image":"this is image", "status":true}
     *             )
     *         )
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(type="object")
     *             },
     *             @OA\Examples(example="result", value={
     *             "success": true,
     *               }, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *     ),
     * )
     */

    public function store(request $request)
    {
        $page = $this->service->store($request);
        return  $this->respondWithItem(new PageResource($page));
    }

    /**
     * @OA\Put(
     *      path="/api/v1/pages/{id}",
     *      operationId="updatePage",
     *      tags={"Pages"},
     *      summary="Update existing page",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the post to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *        @OA\RequestBody(
     *     @OA\MediaType(
     *             mediaType="application/json",
     * @OA\Schema(
     *     schema="UpdatePostRequest",
     *     @OA\Property(property="title", type="string"),
     *     @OA\Property(property="slug", type="string"),
     *     @OA\Property(property="description", type="string"),
     *     @OA\Property(property="meta_title", type="string"),
     *     @OA\Property(property="meta_description", type="string"),
     *     @OA\Property(property="keywords", type="string"),
     *     @OA\Property(property="image", type="string")
     * ),
     *                 example={"title":"page title" , "slug": "slug", "description": "this is description", "meta_title": "meta title", "meta_description":"this is meta description","keywords":"meta","image":"this is image", "status":true}
     *             )
     *          ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(type="object")
     *             },
     *             @OA\Examples(example="result", value={
     *             "success": true,
     *               }, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *     ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function update(pageRequest $request, $id)
    {
        $page = $this->service->update($request, $id);
        return $this->respondWithItem(new PageResource($page));
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/pages/{id}",
     *      operationId="deletePage",
     *      tags={"Pages"},
     *      summary="Delete existing page",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Page id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function delete(Request $request, $id)
    {
        $this->service->delete($request, $id);

        return $this->responseOk();
    }
}
