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
                        <h4 id="page-title" class="mb-0">Packages</h4>
                        <div>
                            <a href="{{ route('packages.index') }}" class="btn btn-info btn-sm">
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
                                <th>Package</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button
                                            class="btn btn-sm btn-outline-primary edit-button"
                                            data-name="{{ $package->name }}"
                                            data-slug="{{ $package->slug }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <form
                                            action="{{ route('packages.destroy', $package->slug) }}"
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
                        <h6 id="card-title" class="mb-0">Add Package</h6>
                    </div>
                    <div class="card-body">
                        <form id="edit-form" action="{{ route('packages.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <!-- Package Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Package</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter package name">
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
                const slug = $(this).data('slug');

                $('#edit-form').attr('action', `/admin/packages/${slug}/update`);
                $('input[name="_method"]').val('PATCH');
                $('#name').val(name);
                $('#submit-button').text('Update');
                $('#card-title').text(`Edit Package - ${name}`);
                $('#page-title').text(`Edit Package - ${name}`);
            });

            // Add New Button
            $('#new-button').on('click', function () {
                $('#edit-form').attr('action', '{{ route('packages.store') }}');
                $('input[name="_method"]').val('POST');
                $('#name').val('');
                $('#submit-button').text('Add New');
                $('#card-title').text('Add Package');
                $('#page-title').text('Add Package');
            });
        });
    </script>
@endpush
