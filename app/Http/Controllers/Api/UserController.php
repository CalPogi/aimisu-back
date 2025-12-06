<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::with(['department', 'organization'])->paginate(10);
    }

    public function show(User $user)
    {
        return $user->load(['department', 'organization']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:6',
            'role'            => 'required|in:admin,org_admin,user',
            'department_id'   => 'nullable|exists:departments,id',
            'organization_id' => 'nullable|exists:organizations,id',
            'phone'           => 'nullable|string|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json(
            $user->load(['department', 'organization']),
            201
        );
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'            => 'sometimes|string|max:255',
            'email'           => 'sometimes|email|unique:users,email,' . $user->id,
            'role'            => 'sometimes|in:admin,org_admin,user',
            'department_id'   => 'nullable|exists:departments,id',
            'organization_id' => 'nullable|exists:organizations,id',
            'phone'           => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return $user->load(['department', 'organization']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
