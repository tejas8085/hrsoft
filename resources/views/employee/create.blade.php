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
                    <input type="text" name="designation" class="form-control" required value="{{ old('designation') }}">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary <span class="text-danger">*</span></label>
                    <input type="text" name="salary" class="form-control" required value="{{ old('salary') }}">
                </div>

                <div class="mb-3">
                    <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                    <input type="date" name="joining_date" class="form-control" required value="{{ old('joining_date') }}">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label"> Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" required value="{{ old('dob') }}">
                </div>

<div class="mb-3">
    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
    <select name="department" class="form-control" required>
        <option value="">-- Select Department --</option>
        <option value="software" {{ old('department') == 'software' ? 'selected' : '' }}>Software</option>
        <option value="hr" {{ old('department') == 'hr' ? 'selected' : '' }}>Human Resource</option>
        <option value="sales" {{ old('department') == 'sales' ? 'selected' : '' }}>Sales</option>
        <option value="account" {{ old('department') == 'account' ? 'selected' : '' }}>Account</option>
        <option value="marketing" {{ old('department') == 'marketing' ? 'selected' : '' }}>Marketing</option>
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
                    <label for="paddress" class="form-label"> Permanant Address <span class="text-danger">*</span></label>
                    <input type="text" name="paddress" class="form-control" required value="{{ old('paddress') }}">
                </div>
                <div class="mb-3">
                    <label for="caddress" class="form-label"> Current Address  <span class="text-danger">*</span></label>
                    <input type="text" name="caddress" class="form-control" required value="{{ old('caddress') }}">
                </div>
                <div class="mb-3">
    <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
    <select name="bank_name" class="form-control" required>
        <option value="">-- Select Bank --</option>
        <option value="SBI" {{ old('bank_name') == 'SBI' ? 'selected' : '' }}>State Bank of India</option>
        <option value="HDFC" {{ old('bank_name') == 'HDFC' ? 'selected' : '' }}>HDFC Bank</option>
        <option value="ICICI" {{ old('bank_name') == 'ICICI' ? 'selected' : '' }}>ICICI Bank</option>
        <option value="PNB" {{ old('bank_name') == 'PNB' ? 'selected' : '' }}>Punjab National Bank</option>
        <option value="AXIS" {{ old('bank_name') == 'AXIS' ? 'selected' : '' }}>Axis Bank</option>
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


                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Save Employee</button>
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
