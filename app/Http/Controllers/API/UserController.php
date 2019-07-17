<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ])->validate();

            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();
                $token =  $user->createToken($user->name)->accessToken;

                return response()->json(['access_token' => $token], Response::HTTP_OK);
            }

            return response()->json(['error' => __('Not Authorized')], Response::HTTP_UNAUTHORIZED);
        } catch(ValidationException $e) {
            return response()->json(['error' => $e->errors()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'cnpj' => 'required|unique:users',
                'address' => 'required|string',
                'cep' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ])->validate();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'cnpj' => $request->cnpj,
                'address' => $request->address,
                'cep' => $request->cep,
                'phone' => $request->phone,
                'password' => bcrypt($request->password)
            ]);

            if ($user) {
                $token =  $user->createToken($user->name)->accessToken;

                return response()->json([
                    'name' => $user->name,
                    'access_token' => $token
                ], Response::HTTP_CREATED);
            }

        } catch(ValidationException $e){
            return response()->json(['error' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
