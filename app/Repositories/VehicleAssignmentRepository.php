<?php

namespace App\Repositories;

use App\Models\VehicleAssignment;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class VehicleAssignmentRepository
{
    public function create($vehicleId, array $data)
    {
        $validatedData = Validator::make($data, [
            'user_id' => ['required'],
            'last_km' => ['required'],
            'note' => ['nullable']
        ])->validate();

        $validatedData["start_km"] = $validatedData["last_km"];
        $validatedData["start_note"] = $validatedData["note"];
        $validatedData["vehicle_id"] = $vehicleId;
        $validatedData["assigned_at"] = Carbon::now();
        unset($validatedData["last_km"]);
        unset($validatedData["note"]);
        $vehicle = Vehicle::where(["id"=>$vehicleId, "status"=> true])->first();
        if($vehicle && $vehicle->user_id==null){
            $vehicleAssignment =  VehicleAssignment::create($validatedData);
            $vehicle->user_id = $validatedData["user_id"];
            $vehicle->last_km = $validatedData["start_km"];
            $vehicle->save();
            return $vehicle;
        } else {
            return false;
        }
    }

    public function update($vehicleId, $assignmentId, array $data)
    {
        $validatedData = Validator::make($data, [
            'user_id' => ['required'],
            'last_km' => ['required'],
            'note' => ['nullable']
        ])->validate();
        $vehicle = Vehicle::where(["id"=>$vehicleId, "status"=> true])->first();
        if(!$vehicle){
            return false;
        }
        $assignment = VehicleAssignment::findOrFail($assignmentId);
        if($assignment->user_id == $validatedData["user_id"] || $assignment->returned_at!=null){
            return false;
        }
        $assignment->returned_at = Carbon::now();
        $assignment->finish_km = $validatedData["last_km"];
        $assignment->finish_note = $validatedData["note"];
        $assignment->save();

        $vehicle->last_km = $validatedData["last_km"];
        $vehicle->user_id = null;
        $vehicle->save();

        return $this->create($vehicleId, $data);
    }

    public function delete($vehicleId, $assignmentId, array $data)
    {
        $validatedData = Validator::make($data, [
            'last_km' => ['required'],
            'note' => ['nullable']
        ])->validate();
        $vehicle = Vehicle::where(["id"=>$vehicleId, "status"=> true])->first();
        if(!$vehicle){
            return false;
        }
        $assignment = VehicleAssignment::findOrFail($assignmentId);
        if($assignment->returned_at!=null){
            return false;
        }
        $assignment->returned_at = Carbon::now();
        $assignment->finish_km = $validatedData["last_km"];
        $assignment->finish_note = $validatedData["note"];
        $assignment->save();

        $vehicle->last_km = $validatedData["last_km"];
        $vehicle->user_id = null;
        $vehicle->save();

        return $vehicle;
    }

    public function findById($vehicleId, $assignmentId)
    {
        return VehicleAssignment::where(["id" => $assignmentId, "vehicle_id"=>$vehicleId])->with("user")->with("vehicle")->first();
    }

    public function findAll($vehicleId)
    {
        return VehicleAssignment::where(["vehicle_id" => $vehicleId])->with("user")->with("vehicle")->get();
    }
}
