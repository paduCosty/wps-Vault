<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\ValidateUser;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $validateUser->validate($request->all());
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        return $this->userResponse($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $validateUser->validate($request->all());
        $user->update($validatedData);
        return $this->userResponse($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function UserProfile()
    {
        $user = auth()->user();
        if ($user) {
            return $this->userResponse($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    protected function userResponse(User $user, $statusCode)
    {
        return response()->json($user, $statusCode);
    }
    

}