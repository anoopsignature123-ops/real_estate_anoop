<form method="POST" id="enquiryTypeForm" action="{{ route('enquiry-type.store') }}">
    @csrf
    <div id="methodField"></div>
    <div class="row g-3 align-items-end">
        <div class="col-md-8">
            <label class="form-label text-muted small uppercase fw-bold">Lead Type Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter Lead Type Name" required autocomplete="off" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 text-end">
            <button type="submit" id="submitBtn" class="btn btn-primary px-4">Save Type</button>
            <button type="button" id="cancelBtn" class="btn btn-secondary px-4 d-none">Cancel</button>
        </div>
    </div>
</form>
