<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Repositories\Repository;
use Config;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiService
{
    /**
     * Stores the model used for service.
     * @var Eloquent object
     */
    protected $model;
    protected $client;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://kite.zerodha.com',
            'timeout' => 10,
            // You may add more Guzzle options here as needed
        ]);
        $this->apiKey = '8n4x6prssz4i5tnw';
        $this->apiSecret = 'i1uxds1nqyyj00rut79txo3nz803lvx5';
    }
    public function initiateLogin()
    {

        $redirectUrl = route('access.token');
        return redirect()->away("https://kite.zerodha.com/connect/login?v=3&api_key=$this->apiKey&redirect_params=some%3DX%26more%3DY&redirect_url=$redirectUrl");
    }

    public function getAccessToken($request)
    {
        $requestToken = $request->input('request_token');

        // Calculate checksum
        $checksum = hash('sha256', $this->apiKey . $requestToken . $this->apiSecret);

        // Prepare request data
        $data = [
            'api_key' => $this->apiKey,
            'request_token' => $requestToken,
            'checksum' => $checksum
        ];
        dd($data);

        // Make POST request to obtain access token
        $client = new Client();
        $response = $client->post('https://api.kite.trade/session/token', [
            'json' => $data
        ]);

        // Decode JSON response
        $responseData = json_decode($response->getBody(), true);

        // Extract and return access token
        $accessToken = $responseData['data']['access_token'] ?? null;
        return $accessToken;
    }
}
