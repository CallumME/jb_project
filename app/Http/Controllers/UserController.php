<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    // public function index()
    // {
    //     $users = User::paginate(10); // Paginate the results with 10 users per page
    //     return response()->json($users);
    // }

    /**
     * @SWG\Post(
     *     path="/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     return response()->json($user, 201);
    // }

    /**
     * @SWG\Get(
     *     path="/users/{id}",
     *     summary="Get a specific user by ID",
     *     tags={"Users"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     $validated = $request->validate([
    //         'name' => 'sometimes|string|max:255',
    //         'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
    //         'password' => 'sometimes|string|min:8',
    //     ]);

    //     if (isset($validated['password'])) {
    //         $validated['password'] = Hash::make($validated['password']);
    //     }

    //     $user->update($validated);

    //     return response()->json($user);
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return response()->json(['message' => 'User deleted successfully.'], 200);
    // }
}
