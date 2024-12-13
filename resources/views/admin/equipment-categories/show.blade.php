@extends('layouts.backend')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Equipment Category Details</h5>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('equipment-categories.edit', $equipmentCategory) }}" class="btn btn-primary btn-sm">
                    Edit Category
                </a>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name</label>
                    <p>{{ $equipmentCategory->name }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Slug</label>
                    <p>{{ $equipmentCategory->slug }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <p>{{ $equipmentCategory->description ?? 'No description available' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Created At</label>
                    <p>{{ $equipmentCategory->created_at->format('F j, Y H:i:s') }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Last Updated</label>
                    <p>{{ $equipmentCategory->updated_at->format('F j, Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <a href="{{ route('equipment-categories.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
