@extends('layouts.backend')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Edit Equipment Category</h5>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="tab-content">
            <div class="tab-pane preview-tab-pane active" role="tabpanel">
                <form method="POST" action="{{ route('equipment-categories.update', $equipmentCategory->slug) }}">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label" for="name">Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               type="text" 
                               value="{{ old('name', $equipmentCategory->name) }}" 
                               required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $equipmentCategory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Category</button>
                        <a href="{{ route('equipment-categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
