<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRepository
{
    public function create(array $data)
    {
        $validatedData = Validator::make($data, [
            'email' => [
                'required',
                'unique:users',
                'max:255',
                'email',
            ],
            'name' => ['required'],
            'department' => ['nullable'],
            'title' => ['nullable'],
            'phone' => ['nullable'],
        ])->validate();
        $validatedData["role"] = "user";

        return User::create($validatedData);
    }

    public function update($id, array $data)
    {
        $validatedData = Validator::make($data, [
            'email' => [
                Rule::unique('users')->ignore($id),
                'max:255',
                'email',
            ],
            'name' => ['nullable'],
            'department' => ['nullable'],
            'title' => ['nullable'],
            'phone' => ['nullable'],
        ])->validate();

        $user = User::findOrFail($id);
        $user->update($validatedData);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $vehicle = Vehicle::where(["user_id"=>$user->id])->exists();
        if($vehicle){
            return false;
        } else {
            $user->delete();
            return true;
        }
    }

    public function findById($id)
    {
        return User::where(["id"=>$id, "role"=> "user"])->first();
    }

    public function findAll(array $data)
    {
        return User::where("role","!=", "admin")->where($data)->get();
    }
}
