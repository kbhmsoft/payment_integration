<?php

// app/Http/Controllers/UserProfileController.php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;



class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $query = User::query();

        // Apply filters based on query parameters
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $userProfiles = $query->get();

        return response()->json($userProfiles);
    }

    public function show($id)
    {
        // return $id;
        $userProfile = User::find($id);

        if (!$userProfile) {
            return response()->json(['error' => 'User profile not found'], 404);
        }

        return response()->json($userProfile);
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'date_of_birth' => 'required|date',
            ]);


            $dob =  date('Y-m-d', strtotime(str_replace('/', '-', $request->date_of_birth)));
            $userProfile = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'date_of_birth' => $dob,
                'password' => Hash::make($request->password)
            ]);

            // return $userProfile;
            return response()->json($userProfile, 201);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
    }

    public function update(Request $request, $id)
    {
        $userProfile = User::find($id);
        // return $request;
        if (!$userProfile) {
            return response()->json(['error' => 'User profile not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:user_profiles,email,' . $id,
            'date_of_birth' => 'date',
        ]);

        $userProfile->update($validatedData);

        return response()->json($userProfile);
    }

    public function destroy($id)
    {
        $userProfile = User::find($id);

        if (!$userProfile) {
            return response()->json(['error' => 'User profile not found'], 404);
        }

        $userProfile->delete();

        return response()->json(['message' => 'User profile deleted']);
    }
}
