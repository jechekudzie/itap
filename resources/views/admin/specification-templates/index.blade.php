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
                <h5 class="mb-0">Specification Templates</h5>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-group">
                    <a href="{{ route('equipment-categories.index') }}" class="btn btn-falcon-default btn-sm me-2">
                        <span class="fas fa-arrow-left me-1"></span>Back to Categories
                    </a>
                    <a href="{{ route('specification-templates.create', $equipmentCategory) }}" class="btn btn-primary btn-sm">
                        <span class="fas fa-plus me-1"></span>Add New Template
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <table id="buttons-datatables" class="table table-bordered table-striped fs--1 mb-0">
            <thead class="bg-200 text-900">
                <tr>
                    <th>Name</th>
                    <th>Field Type</th>
                    <th>Required</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ str_replace('_', ' ', ucfirst($template->field_type)) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($template->is_required)
                            <span class="badge bg-success">Required</span>
                        @else
                            <span class="badge bg-secondary">Optional</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($template->description, 50) }}</td>
                    <td>{{ $template->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('specification-templates.edit', [$equipmentCategory, $template]) }}" 
                               class="btn btn-falcon-primary">
                                <span class="fas fa-edit"></span>
                            </a>
                            <a href="{{ route('specification-templates.show', [$equipmentCategory, $template]) }}" 
                               class="btn btn-falcon-info">
                                <span class="fas fa-eye"></span>
                            </a>
                            <form action="{{ route('specification-templates.destroy', [$equipmentCategory, $template]) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this template?');">
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
