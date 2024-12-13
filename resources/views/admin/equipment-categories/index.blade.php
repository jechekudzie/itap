@extends('layouts.backend')

@push('head')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
@endpush


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Equipment Categories</h5>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('equipment-categories.create') }}" class="btn btn-primary btn-sm">
                    <span class="fas fa-plus me-1"></span>Add New Category
                </a>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <table id="buttons-datatables" class="table table-bordered table-striped fs--1 mb-0">
            <thead class="bg-200 text-900">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Specifications</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td>
                        <a href="{{ route('specification-templates.index', $category) }}" 
                           class="btn btn-falcon-info btn-sm">
                            <span class="fas fa-list me-1"></span>
                            Specifications ({{ $category->specificationTemplates->count() }})
                        </a>
                    </td>
                    <td>{{ $category->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('equipment-categories.edit', $category) }}" 
                               class="btn btn-falcon-primary">
                                <span class="fas fa-edit"></span>
                            </a>
                            <a href="{{ route('equipment-categories.show', $category) }}" 
                               class="btn btn-falcon-info">
                                <span class="fas fa-eye"></span>
                            </a>
                            <form action="{{ route('equipment-categories.destroy', $category) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-falcon-danger">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        $('#buttons-datatables').DataTable();
    });
</script>
@endpush
