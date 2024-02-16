<?php

namespace App\Repositories;

use App\Exceptions\Api\ApiGenericException;
use App\Exceptions\ResourceNotFoundException;
use App\Interfaces\OpenInterface;
use Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Repository implements OpenInterface
{
    /**
     * Stores the model used for service.
     * @var Eloquent object
     */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    // get all data
    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->paginate(PAGINATE);
        } else {
            return $query->orderBy('id', 'DESC')->get();
        }
    }

    // find model by its identifier

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByEmail($email)
    {
        $data = $this->model->where('email', $email)->first();
        if (!isset($data)) {
            throw new ModelNotFoundException;
        }

        return $data;
    }

    //store single record

    public function create($data)
    {
        return $this->model->create($data);
    }

    // store bulk records
    public function storeBulk($data)
    {
        return $this->model->createMany($data);
    }

    //update record

    public function update($data, $id)
    {
        $update = $this->itemByIdentifier($id);
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);

        return $update;
    }

    //delete a record

    public function delete($data, $id)
    {
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }

    //Get intem by its identifier

    public function itemByIdentifier($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            return throw new ResourceNotFoundException($e->getMessage());
        }
    }

    public function checkById($id)
    {
        $data = $this->model->whereId($id)->first();
        if (!$data) {
            throw new ApiGenericException('Data not found', 400);
        }
    }

    // Data for index page
    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
        ];
    }

    // Data for create page
    public function createPageData($request)
    {
        return [
            'status' => $this->status(),
        ];
    }

    // Data for edit page
    public function editPageData($request, $id)
    {
        return [
            'item' => $this->itemByIdentifier($id),
            'status' => $this->status(),
        ];
    }

    // get query for modal
    public function query()
    {
        return $this->model->query();
    }

    public function status()
    {
        return [
            ['value' => 1, 'label' => 'Active'],
            ['value' => 0, 'label' => 'Inactive'],
        ];
    }
}
