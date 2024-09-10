<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Log;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return view('animals', compact('animals'));
    }

    public function create()
    {
        return view('animal-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path('imgs'), $imageName);

        $animal = new Animal();
        $animal->name = $request->name;
        $animal->birthdate = $request->birthdate;
        $animal->description = $request->description;
        $animal->image_path = $imageName;
        $animal->user_id = auth()->user()->id;

        $animal->save();

        return redirect()->route('animals')->with('success', 'Animal created successfully.');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return redirect()->route('animals')->with('success', 'Animal deleted successfully');
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        return view('animal-edit', compact('animal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $animal = Animal::findOrFail($id);

        if ($request->has('name')) {
            $animal->name = $request->name;
        }

        if ($request->has('birthdate')) {
            $animal->birthdate = $request->birthdate;
        }

        if ($request->has('description')) {
            $animal->description = $request->description;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $animal->image_path = $imagePath;
        }

        $animal->save();

        return redirect()->route('animals')->with('success', 'Animal updated successfully');
    }
}
