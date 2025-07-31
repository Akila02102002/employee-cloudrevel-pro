@if(empty($resVal['success']))
    <div class="text-center py-4">
        <p class="text-danger">{{ $resVal['message'] }}</p>
    </div>
@else
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th style="width: 5%;">S.NO</th>
                <th style="width: 20%;">Employee ID</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 20%;">DOB</th>
                <th style="width: 20%;">DOJ</th>
                <th style="width: 25%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $page = $resVal['page'];
                $limit = $resVal['limit'];
                $count = ($page - 1) > 0 ? (($page - 1) * $limit) + 1 : 1;
            @endphp
            @foreach ($resVal['list'] as $list)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $list->employee_id }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($list->dob)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($list->doj)->format('d-m-Y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/employees/view/' . $list->id . '?page=' . $resVal['page']) }}">
                                        View
                                    </a>
                                </li>
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ url('admin/employees/edit/' . $list->id . '?page=' . $resVal['page']) }}">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ url('admin/employees/delete/' . $list->id . '?page=' . $resVal['page']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3" id="pagination">
        {{ $resVal['list']->render() }}
    </div>
@endif