@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add New Employee</h5>
            <a href="{{ route('employee.index') }}" class="btn btn-sm btn-light">← Back to List</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('employee.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" required value="{{ old('mobile') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                    <input type="text" name="designation" class="form-control" required
                        value="{{ old('designation') }}">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary <span class="text-danger">*</span></label>
                    <input type="text" name="salary" class="form-control" required value="{{ old('salary') }}">
                </div>

                <div class="mb-3">
                    <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                    <input type="date" name="joining_date" class="form-control" required
                        value="{{ old('joining_date') }}">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label"> Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" required value="{{ old('dob') }}">
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                   <select name="department" class="form-control" required>
    <option value="">-- Select Department --</option>

    {{-- Core Departments --}}
    <option value="software" {{ old('department') == 'software' ? 'selected' : '' }}>Software / Development</option>
    <option value="hr" {{ old('department') == 'hr' ? 'selected' : '' }}>Human Resources</option>
    <option value="operations" {{ old('department') == 'operations' ? 'selected' : '' }}>Operations</option>
    <option value="sales" {{ old('department') == 'sales' ? 'selected' : '' }}>Sales</option>
    <option value="marketing" {{ old('department') == 'marketing' ? 'selected' : '' }}>Marketing</option>
    <option value="accounts" {{ old('department') == 'accounts' ? 'selected' : '' }}>Accounts & Finance</option>
    <option value="admin" {{ old('department') == 'admin' ? 'selected' : '' }}>Administration</option>

    {{-- IT + Support --}}
    <option value="it-support" {{ old('department') == 'it-support' ? 'selected' : '' }}>IT Support</option>
    <option value="qa" {{ old('department') == 'qa' ? 'selected' : '' }}>Quality Assurance</option>
    <option value="technical-support" {{ old('department') == 'technical-support' ? 'selected' : '' }}>Technical Support</option>

    {{-- Management --}}
    <option value="management" {{ old('department') == 'management' ? 'selected' : '' }}>Management</option>
    <option value="business-development" {{ old('department') == 'business-development' ? 'selected' : '' }}>Business Development</option>
    
    {{-- Customer & Legal --}}
    <option value="customer-service" {{ old('department') == 'customer-service' ? 'selected' : '' }}>Customer Service</option>
    <option value="legal" {{ old('department') == 'legal' ? 'selected' : '' }}>Legal & Compliance</option>

    {{-- Procurement, Logistics, and R&D --}}
    <option value="procurement" {{ old('department') == 'procurement' ? 'selected' : '' }}>Procurement</option>
    <option value="logistics" {{ old('department') == 'logistics' ? 'selected' : '' }}>Logistics / Supply Chain</option>
    <option value="rnd" {{ old('department') == 'rnd' ? 'selected' : '' }}>R&D</option>

    {{-- Design & Creative --}}
    <option value="design" {{ old('department') == 'design' ? 'selected' : '' }}>Design / UI-UX</option>
    <option value="content" {{ old('department') == 'content' ? 'selected' : '' }}>Content / Copywriting</option>
</select>

                </div>
                <div class="mb-3">
                    <label for="uan" class="form-label">UAN No <span class="text-danger">*</span></label>
                    <input type="text" name="uan" class="form-control" required value="{{ old('uan') }}">
                </div>
                <div class="mb-3">
                    <label for="pf" class="form-label">PF No <span class="text-danger">*</span></label>
                    <input type="text" name="pf" class="form-control" required value="{{ old('pf') }}">
                </div>
                <div class="mb-3">
                    <label for="pan" class="form-label">Pan No <span class="text-danger">*</span></label>
                    <input type="text" name="pan" class="form-control" required value="{{ old('pan') }}">
                </div>
                <div class="mb-3">
                    <label for="esic" class="form-label">ESIC No <span class="text-danger">*</span></label>
                    <input type="text" name="esic" class="form-control" required value="{{ old('esic') }}">
                </div>
                <div class="mb-3">
                    <label for="paddress" class="form-label"> Permanant Address <span
                            class="text-danger">*</span></label>
                    <input type="text" name="paddress" class="form-control" required value="{{ old('paddress') }}">
                </div>
                <div class="mb-3">
                    <label for="caddress" class="form-label"> Current Address <span class="text-danger">*</span></label>
                    <input type="text" name="caddress" class="form-control" required value="{{ old('caddress') }}">
                </div>
                <div class="mb-3">
                    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
<select name="bank_name" class="form-control" required>
    <option value="">-- Select Bank --</option>

    {{-- Public Sector Banks --}}
    <optgroup label="Public Sector Banks">
        <option value="State Bank of India">State Bank of India (SBI)</option>
        <option value="Bank of Baroda">Bank of Baroda</option>
        <option value="Punjab National Bank">Punjab National Bank (PNB)</option>
        <option value="Canara Bank">Canara Bank</option>
        <option value="Union Bank of India">Union Bank of India</option>
        <option value="Bank of India">Bank of India</option>
        <option value="Indian Bank">Indian Bank</option>
        <option value="Central Bank of India">Central Bank of India</option>
        <option value="Indian Overseas Bank">Indian Overseas Bank</option>
        <option value="UCO Bank">UCO Bank</option>
        <option value="Bank of Maharashtra">Bank of Maharashtra</option>
        <option value="Punjab & Sind Bank">Punjab &amp; Sind Bank</option>
    </optgroup>

    {{-- Private Sector Banks --}}
    <optgroup label="Private Sector Banks">
        <option value="HDFC Bank">HDFC Bank</option>
        <option value="ICICI Bank">ICICI Bank</option>
        <option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
        <option value="Axis Bank">Axis Bank</option>
        <option value="IndusInd Bank">IndusInd Bank</option>
        <option value="Yes Bank">Yes Bank</option>
        <option value="Federal Bank">Federal Bank</option>
        <option value="IDBI Bank">IDBI Bank</option>
        <option value="Bandhan Bank">Bandhan Bank</option>
    </optgroup>

    {{-- Regional / Others --}}
    <optgroup label="Regional + Cooperative Banks">
        <option value="RBL Bank">RBL Bank</option>
        <option value="Karur Vysya Bank">Karur Vysya Bank</option>
        <option value="Karnataka Bank">Karnataka Bank</option>
        <option value="Andhra Bank">Andhra Bank</option>
        <option value="Allahabad Bank">Allahabad Bank</option>
    </optgroup>

    {{-- Payment Banks --}}
    <optgroup label="Payments Banks">
        <option value="Airtel Payments Bank">Airtel Payments Bank</option>
        <option value="India Post Payments Bank">India Post Payments Bank</option>
        <option value="Jio Payments Bank">Jio Payments Bank</option>
        <option value="Fino Payments Bank">Fino Payments Bank</option>
    </optgroup>

    {{-- Major Foreign Banks in India --}}
    <optgroup label="Foreign Banks">
        <option value="Deutsche Bank">Deutsche Bank</option>
        <option value="Bank of Ceylon">Bank of Ceylon</option>
        <option value="AB Bank">AB Bank</option>
    </optgroup>
</select>

                </div>

                <div class="mb-3">
                    <label for="account_no" class="form-label">Account Number <span class="text-danger">*</span></label>
                    <input type="text" name="account_no" class="form-control" required value="{{ old('account_no') }}">
                </div>

                <div class="mb-3">
                    <label for="ifsc" class="form-label">IFSC Code <span class="text-danger">*</span></label>
                    <input type="text" name="ifsc" class="form-control" required value="{{ old('ifsc') }}">
                </div>
                <div class="mb-3">
                    <label>Incentives</label>
                    <input type="number" step="0.01" name="incentives" class="form-control"
                        value="{{ old('incentives', $employee->incentives ?? 0) }}">
                </div>

                <div class="mb-3">
                    <label>Bonus</label>
                    <input type="number" step="0.01" name="bonus" class="form-control"
                        value="{{ old('bonus', $employee->bonus ?? 0) }}">
                </div>

                <div class="mb-3">
                    <label>City Allowance</label>
                    <input type="number" step="0.01" name="city_allowance" class="form-control"
                        value="{{ old('city_allowance', $employee->city_allowance ?? 0) }}">
                </div>



                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Save Employee</button>
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection