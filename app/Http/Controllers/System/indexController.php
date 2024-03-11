<?php

namespace App\Http\Controllers\System;

use App\Services\ApiService;
use Illuminate\Http\Request;

class indexController extends ResourceController
{

    protected $model;
    protected $client;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->apiKey = '8n4x6prssz4i5tnw';

        $this->apiService = new ApiService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = '')
    {
        $data['breadcrumbs'] = $this->breadcrumbForIndex();

        return $this->renderView('index', $data);
    }

    public function moduleName()
    {
        return 'home';
    }

    /**
     * @returns {string}
     */
    public function viewFolder()
    {
        return 'system.home';
    }

    public function initiateLogin(Request $request)
    {
        $redirectUrl = route('access.token');
        return redirect()->away("https://kite.zerodha.com/connect/login?v=3&api_key=$this->apiKey&redirect_url=$redirectUrl");
    }

    public function getAccessToken(Request $request)
    {
        $apiService = $this->apiService;
        $apiResponse = $apiService->getAccessToken($request);
        dd($apiResponse);
    }
}
