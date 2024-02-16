<?php

namespace App\Http\Controllers\System\page;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ResourceController;
use App\Services\System\PageService;
use Illuminate\Http\Request;

class PageController extends ResourceController
{
     public function __construct(private readonly PageService $pageService)
    {
        parent::__construct($pageService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\pageRequest';
    }

    public function moduleName()
    {
        return 'pages';
    }

    public function viewFolder()
    {
        return 'system.page';
    }

     public function changePageStatus(Request $request)
    {

        $this->service->changeStatus($request);

        return redirect($this->getUrl())->withErrors(['success' => 'Password successfully updated.']);
    }
}
