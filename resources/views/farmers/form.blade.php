<div class="row g-3">
    {{-- FARMER INFORMATION SECTION --}}
    <fieldset class="border rounded p-3 mb-4">
        <legend class="float-none w-auto px-2 fs-6 fw-bold text-success">
            <i class="bi bi-person-badge"></i> Farmer Information
        </legend>

        <div class="row g-3">
            {{-- Broker Selection --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Select Broker <span class="text-danger">*</span></label>
                <select name="broker_id" class="form-select @error('broker_id') is-invalid @enderror" required>
                    <option value="">Select Broker</option>
                    @foreach ($brokers as $broker)
                        <option value="{{ $broker->id }}" 
                            {{ old('broker_id', $farmer->broker_id ?? '') == $broker->id ? 'selected' : '' }}>
                            {{ $broker->name }}
                        </option>
                    @endforeach
                </select>
                @error('broker_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Farmer Name --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Farmer Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $farmer->name ?? '') }}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Farmer Name" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Caste --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Caste <span class="text-danger">*</span></label>
                <select name="caste" class="form-select @error('caste') is-invalid @enderror" required>
                    <option value="">Select Caste</option>
                    @foreach (['General', 'OBC', 'SC', 'ST'] as $caste)
                        <option value="{{ $caste }}" 
                            {{ old('caste', $farmer->caste ?? '') == $caste ? 'selected' : '' }}>{{ $caste }}</option>
                    @endforeach
                </select>
                @error('caste') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Mobile Number --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="mobile_number" value="{{ old('mobile_number', $farmer->mobile_number ?? '') }}"
                    class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Enter Mobile Number" required>
                @error('mobile_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Dynamic State & City --}}
            @include('state-city', [
                'states'        => $states,
                'selectedState' => old('state', $farmer->state ?? ''),
                'selectedCity'  => old('city', $farmer->city ?? '')
            ])

            {{-- ID Proofs --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">PAN Card Number <span class="text-danger">*</span></label>
                <input type="text" name="pancard_number" value="{{ old('pancard_number', $farmer->pancard_number ?? '') }}"
                    class="form-control @error('pancard_number') is-invalid @enderror" placeholder="ABCDE1234F">
                @error('pancard_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Aadhaar Number <span class="text-danger">*</span></label>
                <input type="text" name="aadhar_number" value="{{ old('aadhar_number', $farmer->aadhar_number ?? '') }}"
                    class="form-control @error('aadhar_number') is-invalid @enderror" placeholder="[Aadhaar Redacted]">
                @error('aadhar_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Address --}}
            <div class="col-12">
                <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Enter Full Address">{{ old('address', $farmer->address ?? '') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </fieldset>

    {{-- BANK DETAILS SECTION --}}
    <fieldset class="border rounded p-3">
        <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">
            <i class="bi bi-bank"></i> Bank Details
        </legend>
        @include('farmers.bank_details_form')
    </fieldset>
</div>

{{-- SUBMIT BUTTON --}}
<div class="text-end mt-4">
    <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
        <i class="bi {{ isset($farmer) ? 'bi-save' : 'bi-plus-circle' }} me-1"></i>
        {{ isset($farmer) ? 'Update Farmer Details' : 'Save Farmer' }}
    </button>
</div>