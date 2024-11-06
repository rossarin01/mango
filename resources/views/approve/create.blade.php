@extends('./layout/master')

@section('content')
    <h1></h1>

    <form action="{{ route('approve.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employees_id">Employee ID</label>
            <input type="number" name="employees_id" id="employees_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fingerprint_check_in">Fingerprint_check_in</label>
            <input type="time" name="fingerprint_check_in" id="fingerprint_check_in" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fingerprint_check_in(edit)">Fingerprint_check_in(edit)</label>
            <input type="time" name="fingerprint_check_in(edit)" id="fingerprint_check_in(edit)" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>
@endsection
