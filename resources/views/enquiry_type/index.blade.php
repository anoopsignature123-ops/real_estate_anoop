@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Enquiry Type Configuration</h3>
                <small class="text-muted">Manage types of customer enquiries</small>
            </div>
        </div>



        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h5 class="fw-bold mb-0" id="formTitle">Add New Lead Type</h5>
            </div>
            <div class="card-body">
                @include('enquiry_type.form')
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="enquiryTypeTable">
                        <thead class="table-light">
                            <tr>
                                <th width="80">#</th>
                                <th>Lead Type Name</th>
                                <th>Created Date</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enquiryTypes as $key => $type)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <span class="fw-bold">
                                            {{ ucfirst($type->name) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $type->created_at ? $type->created_at->format('d-M-Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary editBtn"
                                            data-id="{{ $type->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('enquiry-type.destroy', $type->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                                <i class="bi bi-trash"></i>
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

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#enquiryTypeTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    emptyTable: "No lead types configured yet"
                }
            });

            $('.editBtn').click(function() {
                let id = $(this).data('id');
                $('.form-control').removeClass('is-invalid');
                $.get('/enquiry-type/edit/' + id, function(data) {
                    $('#formTitle').text('Edit lead Type');
                    $('#name').val(data.name);
                    $('#enquiryTypeForm').attr('action', '/enquiry-type/update/' + id);
                    $('#methodField').html('@method('PUT')');
                    $('#submitBtn').text('Update Type').removeClass('btn-primary').addClass(
                        'btn-success');
                    $('#cancelBtn').removeClass('d-none');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'fast');
                });
            });

            $('#cancelBtn').click(function() {
                resetForm();
            });

            function resetForm() {
                $('#formTitle').text('Add New lead Type');
                $('#enquiryTypeForm')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('#enquiryTypeForm').attr('action', "{{ route('enquiry-type.store') }}");
                $('#methodField').html('');
                $('#submitBtn').text('Save Type').removeClass('btn-success').addClass('btn-primary');
                $('#cancelBtn').addClass('d-none');
            }

            $(document).on('click', '.delete-btn', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Enquiry Type will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
