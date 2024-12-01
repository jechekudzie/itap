@extends('layouts.backend')

@push('head')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
@endpush

@section('content')
    <div class="pb-5">
        <div class="row g-4">
            <!-- Table Section -->
            <div class="col-12 col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 id="page-title" class="mb-0">Services</h4>
                        <div>
                            <a href="{{ route('services.index') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-refresh"></i> Refresh
                            </a>
                            <button id="new-button" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Add New
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="table table-striped table-sm responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Category</th>
                                <th>Packages</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->serviceCategory->name }}</td>
                                    <td>
                                        <a href="{{ route('service-packages.index', $service->slug) }}" class="btn btn-primary btn-sm">
                                            Packages ({{ $service->servicePackages->count() }})
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button
                                            class="btn btn-sm btn-outline-primary edit-button"
                                            data-name="{{ $service->name }}"
                                            data-slug="{{ $service->slug }}"
                                            data-category="{{ $service->service_category_id }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <form
                                            action="{{ route('services.destroy', $service->slug) }}"
                                            method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="col-12 col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 id="card-title" class="mb-0">Add Services</h6>
                    </div>
                    <div class="card-body">
                        <form id="edit-form" action="{{ route('services.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <!-- Service Category -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Service Category</label>
                                <select name="service_category_id" id="category" class="form-select">
                                    <option value="">Select Service Category</option>
                                    @foreach(\App\Models\ServiceCategory::all() as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Service Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Service Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter service name">
                            </div>
                            <!-- Submit Button -->
                            <div class="text-end">
                                <button id="submit-button" type="submit" class="btn btn-primary">Add New</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#buttons-datatables').DataTable();

            // Edit Button
            $('.edit-button').on('click', function () {
                const name = $(this).data('name');
                const category = $(this).data('category');
                const slug = $(this).data('slug');

                $('#edit-form').attr('action', `/admin/services/${slug}/update`);
                $('input[name="_method"]').val('PATCH');
                $('#name').val(name);
                $('#category').val(category);
                $('#submit-button').text('Update');
                $('#card-title').text(`Edit Service - ${name}`);
                $('#page-title').text(`Edit Service - ${name}`);
            });

            // Add New Button
            $('#new-button').on('click', function () {
                $('#edit-form').attr('action', '{{ route('services.store') }}');
                $('input[name="_method"]').val('POST');
                $('#name').val('');
                $('#category').val('');
                $('#submit-button').text('Add New');
                $('#card-title').text('Add Service');
                $('#page-title').text('Add Service');
            });
        });
    </script>
@endpush
