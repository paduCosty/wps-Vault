<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'business_name' => 'required',
            'vat_number' => 'required',
            'password' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'type' => ['required', Rule::in(['user', 'admin'])],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'phone' => 'required',
            'address' => 'required',
            'business_name' => 'required',
            'vat_number' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'type' => ['required', Rule::in(['user', 'admin'])],
        ]);

        $user->update($validatedData);

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
