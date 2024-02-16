<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Api\ResponseTrait;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;



class ApiController extends Controller
{

    use ResponseTrait;

    const CODE_OK_STATUS = 200;
    const CODE_CREATED_STATUS = 201;
    const CODE_NO_CONTENT = 204;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_FORBIDDEN = 403;
    const CODE_NOT_FOUND = 404;
    const CODE_UNPROCESSABLE_ENTITY = 422;
    const CODE_INTERNAL_ERROR = 500;
    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    public function responseOk($message = "OK")
    {
        return $this->setStatusCode(self::CODE_OK_STATUS)
            ->respondWithSuccess(translateValidationErrorsOfApi($message), self::CODE_OK_STATUS);
    }

    public function responseCreated($message = "Created")
    {
        return $this->setStatusCode(self::CODE_CREATED_STATUS)
            ->respondWithSuccess(translateValidationErrorsOfApi($message), self::CODE_CREATED_STATUS);
    }

    public function errorNoContent($message = "No Conent")
    {
        return $this->setStatusCode(self::CODE_NO_CONTENT)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_NO_CONTENT);
    }

    public function errorBadRequest($message = 'Bad Request')
    {
        return $this->setStatusCode(self::CODE_BAD_REQUEST)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_BAD_REQUEST);
    }

    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(self::CODE_UNAUTHORIZED)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_UNAUTHORIZED);
    }

    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(self::CODE_FORBIDDEN)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_FORBIDDEN);
    }

    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(self::CODE_NOT_FOUND)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_NOT_FOUND);
    }

    public function errorUnprocessableSingleEntity($message = 'Unproceassssable Entity', $titleMessage = null, $key = null)
    {
        return $this->setStatusCode(self::CODE_UNPROCESSABLE_ENTITY)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_UNPROCESSABLE_ENTITY, $key, $titleMessage);
    }

    public function errorInternalError($message = 'Internal Error', $code = null)
    {
        return $this->setStatusCode($code !== null ? $code : 500)
            ->respondWithError(translateValidationErrorsOfApi($message), self::CODE_INTERNAL_ERROR);
    }

    public function jsonValidation($validator, $titleMessage = null)
    {
        return $this->setStatusCode(self::CODE_UNPROCESSABLE_ENTITY)
            ->jsonValidationReponse($validator);
    }

    public function validatePayload($payload, $rules = [], $message = [])
    {
        $validator = \Validator::make($payload, $rules, $message);
        if ($validator->fails()) {
            return $validator;
        } else {
            return null;
        }
    }

    public function errorUnprocessableMultipleEntity($validator, $titleMessage = null)
    {
        $errorData = array();
        foreach ($validator->errors()->toArray() as $key => $value) {
            $pointer = 'pointer';
            foreach ($value as $v) {
                $jsonErrorMessage['code'] = trans("code." . $key);
                $jsonErrorMessage['source'] = (object)[$pointer => '/data/attributes/' . $key];
                if ($titleMessage == null) {
                    $jsonErrorMessage['title'] = $v;
                } else {
                    $jsonErrorMessage['title'] = $titleMessage;
                }
                $jsonErrorMessage['detail'] = $v;
                array_push($errorData, $jsonErrorMessage);
            }
        }
        $error['errors'] = $errorData;
        $this->setStatusCode(self::CODE_UNPROCESSABLE_ENTITY);
        return $this->metaEncode($error);
    }

    protected function respondWithItem($item)
    {
        $data['data'] = $item;
        return $this->metaEncode(['data' => $item]);

    }
    protected function normalResponse($item, $callback, $resourceKey = null)
    {
        $resource = new Item($item, $callback, $resourceKey);
        $rootScope = $this->fractal->createData($resource);
        return $this->metaEncode($rootScope->toArray());
    }

    protected function respondWithCollection($collection)
    {
        $paginationData['total'] = $collection->total();
        $paginationData['count'] = $collection->count();
        $paginationData['per_page'] = $collection->perPage();
        $paginationData['current_page'] = $collection->currentPage();
        $paginationData['next_page_url'] = $collection->nextPageUrl();
        $paginationData['options'] = $collection->getOptions();
        $paginationData['total_pages'] = ceil($collection->total()/$collection->perPage());
        return $this->metaEncode(['data' => $collection, 'pagination_meta' =>$paginationData]);
    }


    protected function respondWithOutPagination($collection)
    {
        return $this->metaEncode(['data' => $collection]);

    }

    protected function respondWithMultipleCollection($collectionArray)
    {
        $resources['data'] = [];
        foreach ($collectionArray as $collection) {
            $resource = new Collection($collection['collection'], $collection['callback'], $collection['key']);
            if (isset($collection['setPagination']) && $collection['setPagination']) {
                $resource->setPaginator(new IlluminatePaginatorAdapter($collection['collection']));
            }
            $data = $this->fractal->createData($resource)->toArray();
            $resources['data'][$collection['key']] = $data;
        }
        return $this->metaEncode($resources);
    }

}
