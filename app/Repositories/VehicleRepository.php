<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleRepository
{
    public function create(array $data)
    {
        $validatedData = Validator::make($data, [
            'plate_number' => [
                'required',
                'unique:vehicles',
                'max:50',
            ],
            'model' => ['required'],
            'trademark' => ['nullable'],
            'engine_number' => ['nullable']
        ])->validate();
        return Vehicle::create($validatedData);
    }

    public function update($id, array $data)
    {
        $validatedData = Validator::make($data, [
            'plate_number' => [
                Rule::unique('vehicles')->ignore($id),
                'max:50',
            ],
            'model' => ['nullable'],
            'trademark' => ['nullable'],
            'engine_number' => ['nullable']
        ])->validate();

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($validatedData);
        return $vehicle;
    }

    public function delete($id): bool
    {
        $vehicle = Vehicle::findOrFail($id);
        if($vehicle->user_id!=null){
            return false;
        } else {
            $vehicle->update(["status"=>false]);
            return true;
        }

    }

    public function findById($id)
    {
        return Vehicle::where(["id" => $id, "status"=>true])->with('user')->first();
    }

    public function findAll()
    {
        return Vehicle::where(["status"=>true])->with('user')->get();
    }
}
