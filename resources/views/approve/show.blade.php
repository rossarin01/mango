@extends('./layout/master')

@section('content')
    <h1></h1>

    <p><strong>Employee ID:</strong> 
    {{ $approve->employees_id }}</p>

    <p><strong>Date:</strong> 
    {{ $approve->date }}</p>

    <p><strong>Fingerprint_check_in:</strong> 
    {{ $approve->fingerprint_check_in }}</p>

    <p><strong>Fingerprint_check_in(edit):</strong> 
    {{ $approve->fingerprint_check_in(edit) }}</p>


    <a href="{{ route('approve.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('approve.edit', $calculateSalary->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('approve.destroy', $calculateSalary->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
