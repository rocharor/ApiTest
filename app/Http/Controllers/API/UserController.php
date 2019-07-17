<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Models\Provider;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'cnpj' => 'required',
                'address' => 'required|string',
                'cep' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ])->validate();

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            return response()->json(['success' => $success], $this->successStatus);

        } catch(ValidationException $e){
            return response()->json(['error' => $e->errors()], 401);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function getProviders(Request $request)
    {
        // $token = str_replace('Bearer ', '', $request->header('authorization'));

        // // $decoded = \Firebase\JWT\JWT::decode($token, env('APP_KEY'), array('HS256'));
        // $decoded = \Firebase\JWT\JWT::decode($token, 'Ozl23EavECfmTZ3iLqTb8ZNT99enWYTjkwRsJUhm', array('HS256'));

        // dd($decoded);
        // dd($token);
        $providers = Provider::all();
        return response()->json(['success' => $providers], $this->successStatus);
    }

    public function postProviders(Request $request)
    {
        $user = Provider::create([
            'user_id' => $request->userId,
            'name' => $request->name,
            'email' => $request->email,
            'monthly_payment' => $request->monthlyPayment,
        ]);
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function deleteProviders(int $id)
    {
        $user = Provider::find($id)->delete();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
