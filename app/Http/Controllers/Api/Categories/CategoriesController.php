<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\PageResource;
use App\Services\System\CategoryService;
use App\Transformers\CategoriesTransformer;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{
    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->service->indexPageData($request);

        return $this->respondWithCollection(PageResource::collection($categories));
    }

    public function detail($id)
    {
        $category = $this->service->singleData($id);
        if ($category == null) {
            return $this->errorNotFound();
        }

        return $this->respondWithItem($category, new CategoriesTransformer, 'Categories');
    }

    public function create(CategoryRequest $request)
    {
        $category = $this->service->store($request);

        return $this->respondWithItem($category, new CategoriesTransformer, 'Categories');
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->service->update($request, $id);

        return $this->respondWithItem($category, new CategoriesTransformer, 'Categories');
    }

    public function delete(Request $request, $id)
    {
        $this->service->delete($request, $id);

        return $this->responseOk();
    }
}
