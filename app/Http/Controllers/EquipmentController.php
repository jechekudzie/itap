<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the equipment.
     */
    public function index()
    {
        $equipment = Equipment::with('category')->get();
        return view('admin.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating new equipment.
     */
    public function create()
    {
        $categories = EquipmentCategory::all();
        return view('admin.equipment.create', compact('categories'));
    }

    /**
     * Store a newly created equipment in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'equipment_category_id' => 'required|exists:equipment_categories,id',
            'description' => 'nullable|string',
            'status' => 'required|in:available,in_use,maintenance,retired',
            'serial_number' => 'nullable|string|max:255|unique:equipment,serial_number',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Move the file to public/equipment-images directory
            $image->move(public_path('equipment-images'), $imageName);
            
            // Store the path relative to public directory
            $validatedData['image_path'] = 'equipment-images/' . $imageName;
        }
    
        // Create the equipment
        $equipment = Equipment::create($validatedData);
    
        // Handle specifications
        if ($request->has('specifications')) {
            foreach ($request->specifications as $templateId => $value) {
                if (!empty($value)) {
                    $equipment->specifications()->create([
                        'specification_template_id' => $templateId,
                        'value' => is_array($value) ? json_encode($value) : $value,
                    ]);
                }
            }
        }
    
        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment created successfully.');
    }
    /**
     * Display the specified equipment.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load([
            'category',
            'specifications.template', // Load both specifications and their templates
        ]);
    
        return view('admin.equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified equipment.
     */
    public function edit(Equipment $equipment)
    {
        $categories = EquipmentCategory::all();
        return view('admin.equipment.edit', compact('equipment', 'categories'));
    }

    /**
     * Update the specified equipment in storage.
     */
  

     public function update(Request $request, Equipment $equipment)
{
    // Separate validation rules for basic data and image
    $validationRules = [
        'name' => 'required|string|max:255',
        'equipment_category_id' => 'required|exists:equipment_categories,id',
        'description' => 'nullable|string',
        'status' => 'required|in:available,in_use,maintenance,retired',
        'serial_number' => 'nullable|string|max:255|unique:equipment,serial_number,' . $equipment->id,
    ];

    // Only add image validation if a new image is being uploaded
    if ($request->hasFile('image')) {
        $validationRules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    $validatedData = $request->validate($validationRules);

    // Handle image removal
    if ($request->has('remove_image') && $equipment->image_path) {
        // Delete the existing image file
        if (file_exists(public_path($equipment->image_path))) {
            unlink(public_path($equipment->image_path));
        }
        $validatedData['image_path'] = null;
    }
    // Handle new image upload
    elseif ($request->hasFile('image')) {
        // Delete old image if exists
        if ($equipment->image_path && file_exists(public_path($equipment->image_path))) {
            unlink(public_path($equipment->image_path));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        
        // Move the file to public/equipment-images directory
        $image->move('equipment-images', $imageName);
        
        // Store the path relative to public directory
        $validatedData['image_path'] = 'equipment-images/' . $imageName;
    }

    // Rest of your update logic remains the same...
    $equipment->update($validatedData);

    // Handle specifications
    if ($request->has('specifications')) {
        $equipment->specifications()->delete();
        
        foreach ($request->specifications as $templateId => $value) {
            if (!empty($value)) {
                $equipment->specifications()->create([
                    'specification_template_id' => $templateId,
                    'value' => is_array($value) ? json_encode($value) : $value,
                ]);
            }
        }
    }

    return redirect()
        ->route('equipment.index')
        ->with('success', 'Equipment updated successfully.');
}


    /**
     * Remove the specified equipment from storage.
     */
    public function destroy(Equipment $equipment)
    {
        // Check for related records before deleting
        if ($equipment->accessories()->count() > 0) {
            return redirect()
                ->route('equipment.index')
                ->with('error', 'Cannot delete equipment that has accessories.');
        }

        $equipment->delete();

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }

}
