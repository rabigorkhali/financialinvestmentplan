<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Repositories\System\PageRepository;
use App\Traits\ImageTrait;

class PageService
{
    use ImageTrait;

    public $dir = '/uploads/pages';

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->pageRepository->getAllData($data);
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
        ];
    }

    public function createPageData($request)
    {
        return [
            'status' => $this->status(),

        ];
    }

    public function store($request)
    {
        try {
            $data = $request->except('_token');
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage($this->dir, 'image');
            }
            return $this->pageRepository->createPage($data);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function editPageData($request, $id)
    {
        $page = $this->pageRepository->itemByIdentifier($id);
        return [
            'item' => $page,
            'status' => $this->status(),
        ];
    }

    public function update($request, $id)
    {
        $page = $this->pageRepository->itemByIdentifier($id);
        $data = $request->except('_token');

        if (isset($request['image'])) {
            $this->removeImage($this->dir, $page->image);
            $data['image'] = $this->uploadImage($this->dir, 'image');
        }

        $this->pageRepository->updatePage($page, $data);
        return $page;
    }

    public function delete($request, $id)
    {
        return $this->pageRepository->deletePage($id);
    }

    public function changeStatus($request)
    {
        return $this->pageRepository->changeStatus($request);
    }

    public function status()
    {
        return [
            ['value' => 1, 'label' => 'Active'],
            ['value' => 0, 'label' => 'Inactive'],
        ];
    }
}
