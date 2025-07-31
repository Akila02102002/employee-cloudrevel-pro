<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Employee System</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">Hi, {{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 ms-2">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

    <script>
        function checkEmpty(id, err_id, msg) {
            var valid_man = 0;
            var id_val = $("#" + id).val();
            if (id_val == '') {
                valid_man = 1;
                $("#" + err_id).html(msg);
            } else {
                $("#" + err_id).html('');
            }
            return valid_man;
        }
        function uniqueFieldCheck(fieldId, errorId, recordIdId, table, column, idColumnName) {
            let isUnique = true;
            const fieldValue = $('#' + fieldId).val();
            const recordId = $('#' + recordIdId).val();

            $.ajax({
                url: "{{ url('admin/employees/checkUnique') }}",
                method: 'GET',
                data: {
                    field: fieldValue,
                    id: recordId,
                    table: table,
                    reg_column: column,
                    reg_id_check: idColumnName,
                },
                async: false,
                cache: false,
                success: function (response) {
                    if (response.success === false) {
                        $('#' + errorId).html(response.message);
                        isUnique = false;
                    } else {
                        $('#' + errorId).html('');
                    }
                }
            });
            return isUnique ? 0 : 1;
        }
    </script>
</body>
</html>
