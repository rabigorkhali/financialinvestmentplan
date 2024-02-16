<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RefreshTokenRequest;
use App\Http\Requests\Api\SocialLoginRequest;
use App\Services\Api\LoginService;
use App\Transformers\TokenTransformer;
use GuzzleHttp\Exception\ClientException;
use League\Fractal\Manager;

class LoginController extends ApiController
{
    public function __construct(LoginService $service)
    {
        parent::__construct(new Manager());
        $this->service = $service;
    }
    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Login Frontend Users",
     *      tags={"Frontend login"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="clientId",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="clientSecret",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="email",
     *                     oneOf={
     *                     	   @OA\Schema(type="email"),
     *                     }
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     oneOf={
     *                     	   @OA\Schema(type="password"),
     *                     }
     *                 ),
     *                 example={"clientId": 1 , "clientSecret": 12345678,"email": "test", "password": 12345678, "grantType":"password"}
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
     *              "tokenType": "Bearer",
*                   "expiresIn": 1296000,
    *               "accessToken": "access token",
    *               "refreshToken": "refresh token"
    *               }, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *     ),

     *     @OA\Response(
     *         response=422,
     *         description="User not found",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(type="object")
     *             },
     *             @OA\Examples(example="result", value={
     *                   "title": "The client id field is required.",
     *                   "detail": "The client id field is required."},
    *                     summary="An result object."),
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->all();
            $data = $this->service->parseFormat($data);
            $data['username'] = $data['email'];
            unset($data['email']);

            $tokenData = $this->service->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage());
        }
    }

    public function socialLogin(SocialLoginRequest $request)
    {
        try {
            if ($request->provider == 'google') {
                $tokenData = $this->service->loginWithgoogle($request);
            } elseif ($request->provider == 'facebook') {
                $tokenData = $this->service->loginWithFacebook($request);
            } elseif ($request->provider == 'apple') {
                $tokenData = $this->service->loginWithApple($request);
            } else {
                return $this->errorInternalError('Social-login setup needs to be done.');
            }

            return $this->respondWithItem($tokenData, new TokenTransformer, 'social-login');
        } catch (ClientException $e) {
            return $this->errorInternalError('Expired Token.');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage());
        }
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        try {
            $data = $request->all();
            $data = $this->service->parseFormat($data);
            $data['refresh_token'] = $data['refreshToken'];
            unset($data['refreshToken']);

            $tokenData = $this->service->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage());
        }
    }
}
