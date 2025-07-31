@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Add Employee</h3>
        <a href="{{ url('admin/employees') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ url('admin/employees/save') }}" method="POST" id="employeeForm">
                @csrf
                <input type="hidden" id="hidden_id" value="0">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee_id" class="form-label">Employee ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="employee_id" id="employee_id" value="{{ old('employee_id') }}">
                        <small class="text-danger" id="employee_id_err"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Employee Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        <small class="text-danger" id="name_err"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        <small class="text-danger" id="email_err"></small>
                    </div>
                    <div class="col-md-3">
                        <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}">
                        <small class="text-danger" id="dob_err"></small>
                    </div>
                    <div class="col-md-3">
                        <label for="doj" class="form-label">Date of Joining <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="doj" id="doj" value="{{ old('doj') }}">
                        <small class="text-danger" id="doj_err"></small>
                    </div>
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-primary" id="formSubmit">Save Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#formSubmit').click(function () {
        let valid = 0;
        function checkField(id, errId) {
            let value = $('#' + id).val().trim();
            if (value === '') {
                $('#' + errId).text('This field is required');
                return 1;
            } else {
                $('#' + errId).text('');
                return 0;
            }
        }

        valid += checkField('employee_id', 'employee_id_err');
        valid += checkField('name', 'name_err');
        valid += checkField('email', 'email_err');
        valid += checkField('dob', 'dob_err');
        valid += checkField('doj', 'doj_err');

        if (valid === 0) {
            valid += uniqueFieldCheck('employee_id', 'employee_id_err', 'hidden_id', 'tbl_employee', 'employee_id', 'id');
            valid += uniqueFieldCheck('email', 'email_err', 'hidden_id', 'tbl_employee', 'email', 'id');

        if (valid === 0) {
                $('#employeeForm').submit();
            }
        }
    });
</script>
@endsection
