@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0" style="color: #198754;"><i class="bi bi-life-preserver me-2"></i>Support Center</h3>
        </div>

        <div class="row g-4">
            {{-- Left Card: Form --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-bold m-0"><i class="bi bi-pencil-square me-2 text-success"></i>New Query</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('associate-panel.support.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Suject</label>
                                <input type="text" name="query" class="form-control form-control-lg"
                                    placeholder="What is the issue?" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="6" placeholder="Please provide details..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100 fw-bold">SUBMIT TICKET</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right Card: History with DataTable --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-bold m-0"><i class="bi bi-clock-history me-2 text-success"></i>Ticket History</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle" id="supportTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiries as $item)
                                    <tr>
                                        <td class="fw-bold">{{ ucfirst($item->query) }}</td>
                                        <td class="text-muted small text-truncate" style="max-width: 200px;">
                                            {{ ucfirst($item->description) }}</td>
                                        <td>
                                            @php $colors = ['Pending' => 'warning', 'Resolved' => 'success', 'In-Progress' => 'primary']; @endphp
                                            <span
                                                class="badge bg-{{ $colors[$item->status] ?? 'secondary' }}-subtle text-{{ $colors[$item->status] ?? 'secondary' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>{{ $item->created_at->format('d M, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables CSS & JS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#supportTable').DataTable({
                "order": [
                    [3, "desc"]
                ], // Newest first
                "pageLength": 5,
                "lengthMenu": [5, 10, 25]
            });
        });
    </script>
@endsection
