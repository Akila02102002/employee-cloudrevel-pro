@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">View Employee</h3>
        <a href="{{ url('admin/employees') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee ID</label>
                    <div class="view-sub-val" >
                        <strong>{{ $query->employee_id }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Employee Name</label>
                    <div class="view-sub-val" >
                        <strong>{{ $query->name }}</strong>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <div class="view-sub-val" >
                        <strong>{{ $query->email }}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <div class="view-sub-val" >
                        <strong>{{ \Carbon\Carbon::parse($query->dob)->format('d-m-Y') }}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="doj" class="form-label">Date of Joining</label>
                    <div class="view-sub-val" >
                        <strong>{{ \Carbon\Carbon::parse($query->doj)->format('d-m-Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
