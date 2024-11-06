@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('salaries.employees.mangococo.front.create') }}" class="btn btn-primary">Add</a>
                    </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Payment
                                                <div>Method</div></th>
                                            <th>Payment
                                                <div>Type</div></th>
                                            <th>Bank</th>
                                            <th>Account
                                                <div>Number</div></th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salaries as $salary)
                                            <tr>
                                                <td>{{ $salary->employees_id }}</td>
                                                <td>{{ $salary->name }}</td>
                                                <td>{{ $salary->department }}</td>
                                                <td>{{ $salary->payment_method }}</td>
                                                <td>{{ $salary->payment_type }}</td>
                                                <td>{{ $salary->bank }}</td>
                                                <td>{{ $salary->account_number }}</td>
                                                <td>
                                                    <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info">View</a>
                                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
