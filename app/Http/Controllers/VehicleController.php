<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Repositories\VehicleRepository;

class VehicleController extends Controller
{
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $vehicle = $this->vehicleRepository->findAll();
        return response()->json(["data" => $vehicle], 200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $vehicle = $this->vehicleRepository->create($request->all());
        if ($vehicle) {
            return response()->json(["data" => $vehicle], 201);
        } else {
            return response()->json(['error' => 'Araç oluşturulamadı.'], 500);
        }
    }

    public function show($vehicleId): \Illuminate\Http\JsonResponse
    {
        $vehicle = $this->vehicleRepository->findById($vehicleId);
        if($vehicle){
            return response()->json(["data" => $vehicle], 200);
        } else {
            return response()->json(['error' => 'Araç bulunamadı.'], 500);
        }
    }

    public function update(Request $request, $vehicleId): \Illuminate\Http\JsonResponse
    {
        $vehicle = $this->vehicleRepository->update($vehicleId, $request->all());

        if ($vehicle) {
            return response()->json(["data" => $vehicle], 200);
        } else {
            return response()->json(['error' => 'Araç güncellenemedi.'], 500);
        }
    }

    public function destroy($vehicleId): \Illuminate\Http\JsonResponse
    {
        $vehicleDelete = $this->vehicleRepository->delete($vehicleId);
        if(!$vehicleDelete){
            return response()->json(['error' => 'Araca zimmetli kullanıcı var. Silinemez'], 500);
        } else {
            return response()->json(null, 204);
        }
    }
}
