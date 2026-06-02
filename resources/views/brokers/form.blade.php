<div class="row g-3">
    {{-- BROKER INFORMATION --}}
    <fieldset class="border rounded p-3 mb-4">
        <legend class="float-none w-auto px-2 fs-6 fw-bold text-success">
            <i class="bi bi-person-badge"></i> Broker Information
        </legend>

        <div class="row g-3">
            {{-- Name --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Broker Name <span class="text-danger">*</span></label>
                <input type="text" name="name" 
                    value="{{ old('name', $broker->name ?? '') }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter Broker Name" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Mobile --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="mobile_number" 
                    value="{{ old('mobile_number', $broker->mobile_number ?? '') }}"
                    class="form-control @error('mobile_number') is-invalid @enderror" 
                    placeholder="Enter Mobile Number" required>
                @error('mobile_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Dynamic State & City --}}
            @include('state-city', [
                'states'        => $states,
                'selectedState' => old('state', $broker->state ?? ''),
                'selectedCity'  => old('city', $broker->city ?? '')
            ])

            {{-- PAN Card --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">PAN Card Number <span class="text-danger">*</span></label>
                <input type="text" name="pancard_number" 
                    value="{{ old('pancard_number', $broker->pancard_number ?? '') }}"
                    class="form-control @error('pancard_number') is-invalid @enderror" 
                    placeholder="ABCDE1234F" required>
                @error('pancard_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Aadhaar Number --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Aadhaar Number <span class="text-danger">*</span></label>
                <input type="text" name="aadhar_number" 
                    value="{{ old('aadhar_number', $broker->aadhar_number ?? '') }}"
                    class="form-control @error('aadhar_number') is-invalid @enderror"
                    placeholder="[Aadhaar Redacted]" required>
                @error('aadhar_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Address --}}
            <div class="col-12">
                <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                <textarea name="address" rows="2" 
                    class="form-control @error('address') is-invalid @enderror"
                    placeholder="Enter Full Address" required>{{ old('address', $broker->address ?? '') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </fieldset>

    {{-- BANK DETAILS --}}
    <fieldset class="border rounded p-3">
        <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">
            <i class="bi bi-bank"></i> Bank Details
        </legend>
        @include('brokers.bank_details_form')
    </fieldset>
</div>

{{-- SUBMIT BUTTON --}}
<div class="text-end mt-4">
    <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
        <i class="bi {{ isset($broker) ? 'bi-save' : 'bi-plus-circle' }} me-1"></i>
        {{ isset($broker) ? 'Update Broker Details' : 'Save Broker' }}
    </button>
</div>