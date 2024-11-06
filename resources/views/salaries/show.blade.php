@extends('./layout/master')

@section('content')
    <h1>Salary Details</h1>

    <p><strong>Employee ID:</strong> 
    {{ $salary->employees_id }}</p>

    <p><strong>Name:</strong> 
    {{ $salary->name }}</p>

    <p><strong>Department:</strong> 
    {{ $salary->department }}</p>

    <p><strong>Payment Method:</strong> 
    {{ $salary->payment_method }}</p>

    <p><strong>Payment Type:</strong> 
    {{ $salary->payment_type }}</p>

    <p><strong>Bank:</strong> 
    {{ $salary->bank }}</p>

    <p><strong>Account Number:</strong> 
    {{ $salary->account_number }}</p>

    <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
