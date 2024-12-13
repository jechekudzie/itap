@extends('layouts.backend')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Edit Specification Template for {{ $equipmentCategory->name }}</h5>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="tab-content">
            <div class="tab-pane preview-tab-pane active" role="tabpanel">
                <form method="POST" action="{{ route('specification-templates.update', [$equipmentCategory, $template]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label" for="name">Template Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $template->name) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="field_type">Field Type</label>
                        <select class="form-select @error('field_type') is-invalid @enderror" 
                                id="field_type" 
                                name="field_type" 
                                required>
                            <option value="">Select Field Type</option>
                            @foreach($fieldTypes as $value => $label)
                                <option value="{{ $value }}" 
                                    {{ old('field_type', $template->field_type) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('field_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="options_container" style="display: none;">
                        <label class="form-label" for="options">Options (comma-separated)</label>
                        <input type="text"
                               class="form-control @error('options') is-invalid @enderror"
                               id="options"
                               name="options"
                               value="{{ old('options', ($template->options && is_array(json_decode($template->options, true))) ? implode(', ', json_decode($template->options, true)) : $template->options) }}"
                               placeholder="Option 1, Option 2, Option 3">
                        <div class="form-text">Enter options separated by commas</div>
                        @error('options')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="default_value">Default Value</label>
                        <input type="text" 
                               class="form-control @error('default_value') is-invalid @enderror" 
                               id="default_value" 
                               name="default_value" 
                               value="{{ old('default_value', $template->default_value) }}">
                        @error('default_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_required" 
                                   name="is_required" 
                                   value="1"
                                   {{ old('is_required', $template->is_required) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_required">Required Field</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="allow_multiple" 
                                   name="allow_multiple" 
                                   value="1"
                                   {{ old('allow_multiple', $template->allow_multiple) ? 'checked' : '' }}>
                            <label class="form-check-label" for="allow_multiple">Allow Multiple Values</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Template</button>
                        <a href="{{ route('specification-templates.index', $equipmentCategory) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fieldTypeSelect = document.getElementById('field_type');
    const optionsContainer = document.getElementById('options_container');
    const allowMultipleField = document.getElementById('allow_multiple');
    
    function toggleOptionsField() {
        const selectedType = fieldTypeSelect.value;
        if (['select', 'radio', 'checkbox'].includes(selectedType)) {
            optionsContainer.style.display = 'block';
            // Only show allow_multiple for select and checkbox
            allowMultipleField.parentElement.style.display = 
                ['select', 'checkbox'].includes(selectedType) ? 'block' : 'none';
        } else {
            optionsContainer.style.display = 'none';
            allowMultipleField.parentElement.style.display = 'none';
        }
    }

    // Initial check
    toggleOptionsField();
    
    // Listen for changes
    fieldTypeSelect.addEventListener('change', toggleOptionsField);
});
</script>
@endpush 