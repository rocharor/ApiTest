<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Data\Services\UserService;
use App\Exceptions\DefaultException;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function endpointLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $response = $this->service->login($credentials);

            return response()->json(['access_token' => $response], Response::HTTP_OK);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function endpointRegister(Request $request)
    {
        try {
            $response = $this->service->store($request->all());

            return response()->json(['access_token' => $response], Response::HTTP_CREATED);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }
}
