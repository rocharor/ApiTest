<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Data\Services\ProviderService;
use App\Exceptions\DefaultException;

class ProviderController extends Controller
{
    private $service;

    public function __construct(ProviderService $service)
    {
        $this->service = $service;
    }

    public function endpointGet()
    {
        try {
            $response = $this->service->getAll();

            return response()->json(['data' => $response], Response::HTTP_OK);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function endpointTotalMonthlyPayment()
    {
        try {
            $response = $this->service->totalMonthlyPayment();

            return response()->json(['data' => $response], Response::HTTP_OK);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function endpointActiveProvider(Request $request)
    {
        try {
            $response = $this->service->activeProvider($request->ref);

            return response()->json(['data' => $response], Response::HTTP_OK);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function endpointStore(Request $request)
    {
        try {
            $response = $this->service->store($request->all());

            return response()->json(['data' => $response], Response::HTTP_CREATED);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function endpointDelete(int $id)
    {
        try {
            $response = $this->service->delete($id);

            return response()->json(['data' => $response], Response::HTTP_NO_CONTENT);
        } catch(DefaultException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'data' => $e->getContext()
            ]], Response::HTTP_BAD_REQUEST);
        }
    }
}
