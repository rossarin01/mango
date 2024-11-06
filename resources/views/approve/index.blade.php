@extends('./layout/master')

@section('content')
    <h1></h1>
    <a href="{{ route('approve.create') }}"></a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Employee ID</th>
                <th>Date</th>
                <th>Fingerprint
                    <div>check-in</div></th>
                <th>Fingerprint
                    <div>check-in(edit)</div></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approve as $approve)
                <tr>
                    <td>{{ $approve->employees_id }}</td>
                    <td>{{ $approve->date }}</td>
                    <td>{{ $approve->fingerprint_check_in }}</td>
                    <td>{{ $approve->fingerprint_check_in(edit) }}</td>
                    <td>
                        <a href="{{ route('approve.show', $approve->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('approve.edit', $approve->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('approve.destroy', $approve->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
