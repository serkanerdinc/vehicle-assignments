<?php

namespace App\Http\Controllers;

use App\Models\VehicleAssignment;
use Illuminate\Http\Request;
use App\Repositories\VehicleAssignmentRepository;

class VehicleAssignmentController extends Controller
{
    protected $vehicleAssignmentRepository;

    public function __construct(VehicleAssignmentRepository $vehicleAssignmentRepository)
    {
        $this->vehicleAssignmentRepository = $vehicleAssignmentRepository;
    }

    public function index($vehicleId): \Illuminate\Http\JsonResponse
    {
        $vehicleAssignment = $this->vehicleAssignmentRepository->findAll($vehicleId);
        return response()->json(["data" => $vehicleAssignment], 200);
    }

    public function store(Request $request, $vehicleId): \Illuminate\Http\JsonResponse
    {
        $vehicleAssignment = $this->vehicleAssignmentRepository->create($vehicleId, $request->all());
        if ($vehicleAssignment) {
            return response()->json(["data" => $vehicleAssignment], 201);
        } else {
            return response()->json(['error' => 'Hata oluştu'], 500);
        }
    }

    public function show($vehicleId, $assignmentId): \Illuminate\Http\JsonResponse
    {
        $vehicleAssignment = $this->vehicleAssignmentRepository->findById($vehicleId, $assignmentId);
        if($vehicleAssignment){
            return response()->json(["data" => $vehicleAssignment], 200);
        } else {
            return response()->json(['error' => 'Araç Zimmet hareketi bulunamadı.'], 500);
        }
    }

    public function update(Request $request, $vehicleId, $assignmentId): \Illuminate\Http\JsonResponse
    {
        $vehicleAssignment = $this->vehicleAssignmentRepository->update($vehicleId, $assignmentId, $request->all());

        if ($vehicleAssignment) {
            return response()->json(["data" => $vehicleAssignment], 200);
        } else {
            return response()->json(['error' => 'Araç zimmet güncellenirken hata oluştu'], 500);
        }
    }

    public function destroy(Request $request, $vehicleId, $assignmentId): \Illuminate\Http\JsonResponse
    {
        $vehicleAssignmentDelete = $this->vehicleAssignmentRepository->delete($vehicleId, $assignmentId, $request->all());
        if(!$vehicleAssignmentDelete){
            return response()->json(['error' => 'Araca zimmetli kullanıcı var. Silinemez'], 500);
        } else {
            return response()->json(null, 204);
        }
    }
}
