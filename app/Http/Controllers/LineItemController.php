<?php

namespace App\Http\Controllers;

use App\Models\LineItemCategory;
use App\Models\LineItem;
use Illuminate\Http\Request;

class LineItemController extends Controller
{
    //
    public function index(LineItemCategory $LineItemcategory)
    {
        $lineItems = $LineItemcategory->lineItems;

        //dd($lineItems);
        return view('admin.line_items.index', compact('lineItems', 'LineItemcategory'));
    }

    public function create()
    {
        $categories = LineItemCategory::all();

        return view('admin.line_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'LineItemcategory_id' => 'required|exists:categories,id',
        ]);

        $LineItemcategory = $validatedData['LineItemcategory_id'];

        LineItem::create($validatedData);

        return redirect()->route('line_items.index', ['LineItemcategory' => $LineItemcategory])
            ->with('success', 'Line item created successfully.');
    }

    public function show(LineItem $lineItem)
    {
        return view('admin.line_items.show', compact('lineItem'));
    }

    public function edit(LineItem $lineItem)
    {
        $categories = LineItemCategory::all();

        return view('admin.line_items.edit', compact('lineItem', 'categories'));
    }

    public function update(Request $request, LineItem $lineItem)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'LineItemcategory_id' => 'required|exists:categories,id',
        ]);

        $lineItem->update($validatedData);

        return redirect()->route('line_items.index')
            ->with('success', 'Line item updated successfully.');
    }

    public function destroy(LineItem $lineItem)
    {
        $lineItem->delete();

        return redirect()->route('line_items.index')
            ->with('success', 'Line item deleted successfully.');
    }
}
