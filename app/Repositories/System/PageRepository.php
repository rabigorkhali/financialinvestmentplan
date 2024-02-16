<?php

namespace App\Repositories\System;

use App\Interfaces\System\PageRepositoryInterface;
use App\Model\Page;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Storage;

class PageRepository extends Repository implements PageRepositoryInterface
{
    public function __construct(private readonly Page $page)
    {
        parent::__construct($page);
    }


    public function getAllData($data = null, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where(function ($q) use ($data) {
                $q->where('title', 'ILIKE', '%' . $data->keyword . '%')
                    ->where('slug', 'ILIKE', '%' . $data->keyword . '%')
                    ->where('meta_title', 'ILIKE', '%' . $data->keyword . '%')
                    ->where('keywords', 'ILIKE', '%' . $data->keyword . '%');
            });
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->paginate(paginate());
        }

        return $query->orderBy('id', 'DESC')->with('role')->get();
    }


    public function createPage($request)
    {
        return $this->model->create($request);
    }

    public function updatePage($page, $data)
    {
        return $page->update($data);
    }

    public function deletePage($id)
    {
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }

    public function changeStatus($request)
    {
        $user = $this->itemByIdentifier($request->id);
        $user->status = !$user->status;
        $user->save();
    }
}
