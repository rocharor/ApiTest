<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Provider;
use Illuminate\Http\Response;
use App\Data\Services\ProviderService;

class ProviderController extends Controller
{
    private $service;

    public function __construct(ProviderService $service)
    {
        $this->service = $service;
    }

    public function get()
    {
        $response = $this->service->getAll(Auth::user()->id);
        dd($response);

        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:providers',
                'monthlyPayment' => 'required',
            ])->validate();

            $provider = Provider::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'monthly_payment' => $request->monthlyPayment,
            ]);

            if ($provider) {
                return response()->json(['data' => $provider], Response::HTTP_CREATED);
            }

        } catch(ValidationException $e) {
            return response()->json(['error' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(int $id)
    {
        $result = Provider::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        if ($result) {
            return response()->json(['data' => $result], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['error' => __('Error Delete')], Response::HTTP_BAD_REQUEST);
    }
}
