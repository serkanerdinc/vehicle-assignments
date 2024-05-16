<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->findAll($request->all());
        return response()->json(["data" => $users], 200);

    }

    public function store(Request $request)
    {
        $user = $this->userRepository->create($request->all());
        if ($user) {
            return response()->json(["data" => $user], 201);
        } else {
            return response()->json(['error' => 'Kullanıcı oluşturulamadı.'], 500);
        }
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        if($user){
            return response()->json(["data" => $user], 200);
        } else {
            return response()->json(['error' => 'Kullanıcı bulunamadı.'], 500);
        }

    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->update($id, $request->all());
        if ($user) {
            return response()->json(["data" => $user], 200);
        } else {
            return response()->json(['error' => 'Kullanıcı güncellenemedi.'], 500);
        }
    }

    public function destroy($id)
    {
        $userDelete = $this->userRepository->delete($id);
        if(!$userDelete){
            return response()->json(['error' => 'Kullanıcının üzerinde araç var. Silinemez'], 500);
        } else {
            return response()->json(null, 204);
        }

    }
}
