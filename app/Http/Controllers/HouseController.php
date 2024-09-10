<?php
namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::with('animals')->get();
        return view('houses', compact('houses'));
    }

    public function create()
    {
        $animals = Animal::all(); 
        return view('house-create', compact('animals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rua' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'animals' => 'array', 
            'animals.*' => 'exists:animals,id',
        ]);

        $house = new House($request->all());
        $house->user_id = auth()->user()->id; 
        $house->save();

        if ($request->has('animals')) {
            $house->animals()->attach($request->input('animals'));
        }

        return redirect()->route('houses');
    }

    public function destroy($id)
    {
        $house = House::findOrFail($id);
        $house->delete();
        return redirect()->route('houses')->with('success', 'House deleted successfully');
    }

    public function edit($id)
    {
        $house = House::findOrFail($id);
        $animals = Animal::all();
        return view('house-edit', compact('house', 'animals'));
    }

    public function update(Request $request, $id)
{
    $house = House::findOrFail($id);

    $validatedData = $request->validate([
        'rua' => 'nullable|string|max:255',
        'cep' => 'nullable|string|max:255',
        'bairro' => 'nullable|string|max:255',
        'cidade' => 'nullable|string|max:255',
        'estado' => 'nullable|string|max:255',
        'animals' => 'nullable|array',
        'animals.*' => 'exists:animals,id',
    ]);

    $house->update($validatedData);

    if ($request->has('animals')) {
        $house->animals()->sync($request->input('animals'));
    } else {
        $house->animals()->detach();
    }

    return redirect()->route('houses')->with('success', 'House updated successfully');
}
}