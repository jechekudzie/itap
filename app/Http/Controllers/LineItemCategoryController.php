<?php

namespace App\Http\Controllers;

use App\Models\LineItemCategory;
use Illuminate\Http\Request;

class LineItemCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = LineItemCategory::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        LineItemCategory::create($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'LineItemCategory created successfully.');
    }

    public function show(LineItemCategory $LineItemcategory)
    {
        return view('admin.categories.show', compact('LineItemcategory'));
    }

    public function edit(LineItemCategory $LineItemcategory)
    {
        return view('admin.categories.edit', compact('LineItemcategory'));
    }

    public function update(Request $request, LineItemCategory $LineItemcategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $LineItemcategory->update($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'LineItemCategory updated successfully.');
    }

    public function destroy(LineItemCategory $LineItemcategory)
    {
        $LineItemcategory->delete();

        return redirect()->route('categories.index')
            ->with('success', 'LineItemCategory deleted successfully.');
    }
}
