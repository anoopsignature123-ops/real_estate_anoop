@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4 bg-light min-vh-100">

        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <span
                                class="badge bg-success bg-opacity-10 text-success mb-2 px-3 py-2 text-uppercase fw-bold fs-7">
                                Associate Security
                            </span>
                            <h2 class="mb-1 text-dark fw-bold h3 tracking-tight">My Profile Details</h2>
                            <p class="mb-0 text-muted small fw-medium">Verify your registered personal credentials, address
                                matrix, and active banking channels.</p>
                        </div>
                        <div class="d-none d-md-block flex-shrink-0 text-end">
                            <a href="{{ route('associate-panel.edit-profile') }}"
                                class="btn btn-success px-4 fw-semibold shadow-sm">
                                <i class="bi bi-pencil-square me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm bg-white rounded-3 h-100">
                    <div class="card-header bg-transparent pt-4 px-4 pb-3 border-bottom border-success border-opacity-25">
                        <h4 class="fw-bold mb-0 text-dark h5">
                            <i class="bi bi-person-bounding-box text-success me-2"></i>Personal Details
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="row row-cols-1 g-0">
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Sponsor Name</span>
                                <span class="text-dark fw-bold">{{ $associate->sponsor->associate_name ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Associate Name</span>
                                <span
                                    class="text-dark fw-bold text-uppercase">{{ $associate->associate_name ?? '-' }}</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Gender</span>
                                <span class="text-dark fw-bold">{{ $associate->gender ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Father/Husband Name</span>
                                <span class="text-dark fw-bold">{{ $associate->father_name ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">DOB</span>
                                <span class="text-dark fw-bold font-monospace">
                                    {{ $associate->dob ? \Carbon\Carbon::parse($associate->dob)->format('d M Y') : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm bg-white rounded-3 h-100">
                    <div class="card-header bg-transparent pt-4 px-4 pb-3 border-bottom border-success border-opacity-25">
                        <h4 class="fw-bold mb-0 text-dark h5">
                            <i class="bi bi-shield-check text-success me-2"></i>Nominee's Details
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="row row-cols-1 g-0">
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Nominee Name</span>
                                <span class="text-dark fw-bold">{{ $associate->bankDetail->nominee_name ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Nominee Relation</span>
                                <span class="text-dark fw-bold">{{ $associate->bankDetail->nominee_relation ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Nominee Age</span>
                                <span
                                    class="text-dark fw-bold font-monospace">{{ $associate->bankDetail->nominee_age ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm bg-white rounded-3 h-100">
                    <div class="card-header bg-transparent pt-4 px-4 pb-3 border-bottom border-success border-opacity-25">
                        <h4 class="fw-bold mb-0 text-dark h5">
                            <i class="bi bi-geo-alt-fill text-success me-2"></i>Address Information
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="row row-cols-1 g-0">
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold flex-shrink-0">Address</span>
                                <span class="text-dark fw-bold text-end w-75">{{ $associate->address ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">City</span>
                                <span class="text-dark fw-bold">{{ $associate->city ?? '-' }}</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">State</span>
                                <span class="text-dark fw-bold text-capitalize">{{ $associate->state ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Mobile</span>
                                <span
                                    class="text-dark fw-bold font-monospace">{{ $associate->mobile_number ?? '-' }}</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Email</span>
                                <span
                                    class="text-dark fw-bold font-monospace text-lowercase">{{ $associate->email ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Pancard No</span>
                                <span class="text-dark fw-bold font-monospace text-uppercase"
                                    style="letter-spacing: 0.5px;">{{ $associate->pancard_number ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Aadhaar No</span>
                                <span
                                    class="text-dark fw-bold font-monospace">{{ $associate->aadhar_number ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm bg-white rounded-3 h-100">
                    <div class="card-header bg-transparent pt-4 px-4 pb-3 border-bottom border-success border-opacity-25">
                        <h4 class="fw-bold mb-0 text-dark h5">
                            <i class="bi bi-bank2 text-success me-2"></i>Bank Details
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="row row-cols-1 g-0">
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">Bank Name</span>
                                <span
                                    class="text-dark fw-bold text-uppercase">{{ $associate->bankDetail->bank_name ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom">
                                <span class="text-secondary fw-semibold">Account No</span>
                                <span
                                    class="text-dark fw-bold font-monospace">{{ $associate->bankDetail->account_number ?? '-' }}</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-3 px-4 border-bottom bg-light bg-opacity-25">
                                <span class="text-secondary fw-semibold">IFSC Code</span>
                                <span class="text-success fw-bold font-monospace text-uppercase"
                                    style="letter-spacing: 0.5px;">{{ $associate->bankDetail->ifsc_code ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 px-4">
                                <span class="text-secondary fw-semibold">Account Holder Name</span>
                                <span
                                    class="text-dark fw-bold">{{ $associate->bankDetail->account_holder_name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Documents Section --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm bg-white rounded-4">
                        <div class="card-header bg-transparent border-bottom border-success border-opacity-25 px-4 py-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-1 text-dark">
                                        <i class="bi bi-file-earmark-check-fill text-success me-2"></i>
                                        Uploaded Documents
                                    </h5>
                                    <small class="text-muted">Verified associate documents preview</small>
                                </div>
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">4
                                    Documents</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-6 col-md-3">
                                    <div class="border rounded-4 p-3 text-center bg-light h-100">
                                        <div class="mb-3">
                                            <img src="{{ $associate->photo ? getFileUrl($associate->photo) : 'https://placehold.co/120x120?text=Photo' }}"
                                                class="rounded-4 border object-fit-cover shadow-sm" width="120"
                                                height="120">
                                        </div>
                                        <h6 class="fw-bold mb-1">Profile Photo</h6>
                                        <small class="text-muted">Associate Image</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="border rounded-4 p-3 text-center bg-light h-100">
                                        <div class="mb-3">
                                            <img src="{{ $associate->id_proof_photo ? getFileUrl($associate->id_proof_photo) : 'https://placehold.co/120x120?text=ID+Proof' }}"
                                                class="rounded-4 border object-fit-cover shadow-sm" width="120"
                                                height="120">
                                        </div>
                                        <h6 class="fw-bold mb-1">ID Proof</h6>
                                        <small class="text-muted">Aadhaar / Voter ID</small>
                                    </div>
                                </div>
                                {{-- PAN Card --}}
                                <div class="col-6 col-md-3">
                                    <div class="border rounded-4 p-3 text-center bg-light h-100">
                                        <div class="mb-3">
                                            <img src="{{ $associate->pancard_photo ? getFileUrl($associate->pancard_photo) : 'https://placehold.co/120x120?text=PAN' }}"
                                                class="rounded-4 border object-fit-cover shadow-sm" width="120"
                                                height="120">
                                        </div>
                                        <h6 class="fw-bold mb-1"> PAN Card</h6>
                                        <small class="text-muted"> PAN Verification</small>
                                    </div>
                                </div>
                                {{-- Passbook --}}
                                <div class="col-6 col-md-3">
                                    <div class="border rounded-4 p-3 text-center bg-light h-100">
                                        <div class="mb-3">
                                            <img src="{{ $associate->bankDetail->bank_passbook ? getFileUrl($associate->bankDetail->bank_passbook) : 'https://placehold.co/120x120?text=Passbook' }}"
                                                class="rounded-4 border object-fit-cover shadow-sm" width="120"
                                                height="120">
                                        </div>
                                        <h6 class="fw-bold mb-1">Bank Passbook</h6>
                                        <small class="text-muted">Account Verification</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
