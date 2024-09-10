<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function updateImage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('imgs'), $imageName);

            DB::table('user')
                ->where('id', $user->id)
                ->update(['avatar_path' => $imageName]);
        }

        return redirect()->route('profile');
    }

    public function updateInfo(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'cpf' => 'required|string|max:14',
            'passport' => 'nullable|string|max:20',
            'phone' => 'required|string|max:15',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Update user attributes
            $user->name = $request->name;
            $user->birthdate = $request->birthdate;
            $user->cpf = $request->cpf;
            $user->passport = $request->passport;
            $user->phone = $request->phone;

            // Save the changes to the database
            $user->save();

            // Redirect to the profile route
            return redirect()->route('profile')->with('success', 'User information updated successfully.');
        }

        // Return a JSON response if the user is not found
        return response()->json(['message' => 'User not found.'], 404);
    }
}
