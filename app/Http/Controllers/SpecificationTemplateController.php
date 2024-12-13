<?php

namespace App\Http\Controllers;

use App\Models\SpecificationTemplate;
use App\Models\EquipmentCategory;
use Illuminate\Http\Request;

class SpecificationTemplateController extends Controller
{
    protected $fieldTypes = [
        'text' => 'Text Input',
        'number' => 'Number Input',
        'select' => 'Select Dropdown',
        'textarea' => 'Text Area',
        'date' => 'Date Input',
        'radio' => 'Radio Buttons',
        'checkbox' => 'Checkboxes',
        'email' => 'Email Input',
        'tel' => 'Telephone Input',
        'url' => 'URL Input',
        'file' => 'File Upload',
        'color' => 'Color Picker',
        'time' => 'Time Input',
        'datetime-local' => 'Date and Time'
    ];

    public function index(EquipmentCategory $equipmentCategory)
    {
        $templates = $equipmentCategory->specificationTemplates;
        return view('admin.specification-templates.index', compact('templates', 'equipmentCategory'));
    }

    public function create(EquipmentCategory $equipmentCategory)
    {
        $fieldTypes = $this->fieldTypes;
        return view('admin.specification-templates.create', compact('fieldTypes', 'equipmentCategory'));
    }

    public function store(Request $request, EquipmentCategory $equipmentCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'field_type' => 'required|string|in:' . implode(',', array_keys($this->fieldTypes)),
            'is_required' => 'nullable|boolean',
            'allow_multiple' => 'nullable|boolean',
            'default_value' => 'nullable|string',
            'options' => 'nullable|string',
            'validation_rules' => 'nullable|string',
        ]);

        // Explicitly set boolean values based on checkbox presence
        $validatedData['is_required'] = $request->boolean('is_required');
        $validatedData['allow_multiple'] = $request->boolean('allow_multiple');

        // Only allow multiple values for select and checkbox
        if (!in_array($validatedData['field_type'], ['select', 'checkbox'])) {
            $validatedData['allow_multiple'] = false;
        }

        // Handle options for select, radio, and checkbox types
        if ($request->filled('options') && in_array($validatedData['field_type'], ['select', 'radio', 'checkbox'])) {
            $options = array_map('trim', explode(',', $request->options));
            $validatedData['options'] = json_encode(array_filter($options));
        } else {
            $validatedData['options'] = null;
        }

        $equipmentCategory->specificationTemplates()->create($validatedData);

        return redirect()
            ->route('specification-templates.index', $equipmentCategory)
            ->with('success', 'Specification template created successfully.');
    }

    public function show(EquipmentCategory $equipmentCategory, SpecificationTemplate $template)
    {
        return view('admin.specification-templates.show', compact('template', 'equipmentCategory'));
    }

    public function edit(EquipmentCategory $equipmentCategory, SpecificationTemplate $template)
    {
        $fieldTypes = $this->fieldTypes;
        
        // Safely convert JSON options to comma-separated string
        if ($template->options) {
            $decodedOptions = json_decode($template->options, true);
            $template->options = is_array($decodedOptions) ? implode(', ', $decodedOptions) : '';
        }

        return view('admin.specification-templates.edit', compact('template', 'fieldTypes', 'equipmentCategory'));
    }

    public function update(Request $request, EquipmentCategory $equipmentCategory, SpecificationTemplate $template)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'field_type' => 'required|string|in:' . implode(',', array_keys($this->fieldTypes)),
            'is_required' => 'nullable|boolean',
            'allow_multiple' => 'nullable|boolean',
            'default_value' => 'nullable|string',
            'options' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->field_type, ['select', 'radio', 'checkbox']) && empty($value)) {
                        $fail('The options field is required for select, radio, and checkbox types.');
                    }
                },
            ],
            'validation_rules' => 'nullable|string',
        ]);

        // Explicitly set boolean values based on checkbox presence
        $validatedData['is_required'] = $request->boolean('is_required');
        $validatedData['allow_multiple'] = $request->boolean('allow_multiple');

        // Only allow multiple values for select and checkbox
        if (!in_array($validatedData['field_type'], ['select', 'checkbox'])) {
            $validatedData['allow_multiple'] = false;
        }

        // Handle options for select, radio, and checkbox types
        if ($request->filled('options') && in_array($validatedData['field_type'], ['select', 'radio', 'checkbox'])) {
            $options = array_map('trim', explode(',', $request->options));
            $validatedData['options'] = json_encode(array_filter($options));
        } else {
            $validatedData['options'] = null;
        }

        $template->update($validatedData);

        return redirect()
            ->route('specification-templates.index', $equipmentCategory)
            ->with('success', 'Specification template updated successfully.');
    }

    public function destroy(EquipmentCategory $equipmentCategory, SpecificationTemplate $template)
    {
        $template->delete();

        return redirect()
            ->route('specification-templates.index', $equipmentCategory)
            ->with('success', 'Specification template deleted successfully.');
    }
}
