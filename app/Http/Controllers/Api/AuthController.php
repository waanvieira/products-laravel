<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**  @var UserService */
    private $service;

    /**     
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
      $this->service = $service;
    }

    public function authenticate(Request $request)
    {
      $credentials = $request->only('email', 'password');

      try {
          if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 400);
          }
      } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
      }

      return response()->json(compact('token'));
    }

    /**
     * Register User
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors()->toJson(), 400);
      }

      $user = $this->service->store($request);

      if (!$user) {
        return $this->error('Erro para cadastrar usuário');
      }

      $token = JWTAuth::fromUser($user);

      return response()->json(compact('user', 'token'), 201);
    }

    /**
     * Get authenthicate user
     *
     * @return void
     */
    public function getAuthenticatedUser()
    {
      try {

        if (!$user = JWTAuth::parseToken()->authenticate()) {
          return response()->json(['user_not_found'], 404);
        }
      } catch (TokenExpiredException $e) {

        return response()->json(['token_expired'], 'Token expirado');
      } catch (TokenInvalidException $e) {

        return response()->json(['token_invalid'], 'Token invalido');
      } catch (JWTException $e) {

        return response()->json(['token_absent'], 'Token ausente');
      }

      return response()->json(compact('user'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
      auth()->logout();
      return response()->json(['message' => 'Successfully logged out']);
    }
  
}
