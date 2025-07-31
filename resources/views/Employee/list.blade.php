@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Employee</h2>
    </div>
    @if (Session::has('success'))
        @include('Employee.successpopup')
    @endif
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form id="filterForm" class="row g-3 mb-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search name">
                </div>
            </form>
        </div>
    </div>
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ url('admin/employees/add') }}" class="btn btn-primary font-weight-bolder back_btn">
                    <i class="fas fa-plus me-1"></i>Create New Employee
                </a>
            </div>
        @endif
    @endauth
    <div id="taskTable">
        @include('Employee.pagination_data')
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#search').on('input change', function () {
        loadEmployee();
    });

    function loadEmployee() {
        let search = $('#search').val();
        $.ajax({
            url: '{{ url("admin/employees/listAll") }}',
            method: 'POST',
            data: {
                search: search,
                need_page: 1
            },
            beforeSend: function () {
                $('#taskTable').html('Loading...');
            },
            success: function (data) {
                $('#taskTable').html(data);
            },
            error: function () {
                $('#taskTable').html('<div class="text-danger">Error loading data.</div>');
            }
        });
    }
});
</script>
@endsection