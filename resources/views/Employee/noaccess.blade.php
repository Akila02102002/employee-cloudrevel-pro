@extends('layouts.app')
@section('content')
<div class="no-access-screen">
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-bolder text-gray-900">You're not permitted to see this</h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-8">The page you're trying to access has restricted access.
                        <br class="mob-hide">If you feel this is a mistake, contact your admin.
                    </div>
                    <div class="mb-11">
                        <a href="{{ url('admin/employees') }}" class="btn btn-sm btn-primary">Go to Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
