{{-- resources/views/associate-panel/team/my_tree.blade.php --}}

@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tree.css') }}">
@endpush
@section('content')
    <div class="container-fluid mt-4">

        {{-- Header --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-success"
                        style="height: 90px;
                        background: linear-gradient(135deg, #166534, #22c55e);">
                    </div>

                    <div class="card-body px-4 pb-4 pt-0">

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">

                            <div class="d-flex align-items-center gap-4">

                                {{-- Avatar --}}
                                <div class="rounded-circle bg-white shadow border border-4 border-white d-flex align-items-center justify-content-center fw-bold text-success"
                                    style="width:90px;height:90px;margin-top:-45px;font-size:30px;">

                                    {{ strtoupper(substr(auth()->user()->associate_name ?? 'A', 0, 1)) }}

                                </div>

                                {{-- Info --}}
                                <div class="pt-3">

                                    <span
                                        class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-2">

                                        Active Associate

                                    </span>

                                    <h3 class="fw-bold mb-1">

                                        {{ auth()->user()->associate_name ?? 'Associate' }}

                                    </h3>

                                    <p class="text-muted mb-0">

                                        Team hierarchy & organization structure

                                    </p>

                                </div>

                            </div>

                            {{-- Search --}}
                            <form method="GET">

                                <div class="d-flex gap-2 flex-wrap">

                                    <input type="text" name="associate_id" value="{{ request('associate_id') }}"
                                        placeholder="Enter Associate ID" class="form-control rounded-3"
                                        style="min-width:250px;">

                                    <button class="btn btn-success rounded-3 px-4">

                                        <i class="bi bi-search me-1"></i>

                                        Show

                                    </button>

                                    <a href="{{ route('associate-panel.my-tree') }}"
                                        class="btn btn-secondary rounded-3 px-4">

                                        Reset

                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Tree Card --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                @if ($rootAssociate)
                    <div class="tree-container">

                        <div class="org-chart-wrapper">

                            @include('associate-panel.team.node', [
                                'associate' => $rootAssociate,
                            ])

                        </div>

                    </div>
                @else
                    <div class="text-center py-5">

                        <div class="mb-3">

                            <i class="bi bi-diagram-3 fs-1 text-muted"></i>

                        </div>

                        <h5 class="fw-bold text-muted">

                            No Associate Found

                        </h5>

                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection
