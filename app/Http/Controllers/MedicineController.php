<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')->latest()->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'required|date|after:today',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine created successfully.');
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        return view('medicines.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'required|date',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }
} 