@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card-body">
                    <div class="col-md-12">
                        <a href="{{ route('salaries.employees.flyingtigress.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                            <form action="{{ route('salaries.employees.flyingtigress.update', $salary->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="employees_id">Employee ID</label>
                                    <input type="number" name="employees_id" id="employees_id" class="form-control" value="{{ $salary->employees_id }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $salary->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" id="department" class="form-control" value="{{ $salary->department }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ $salary->payment_method }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <input type="text" name="payment_type" id="payment_type" class="form-control" value="{{ $salary->payment_type }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <input type="text" name="bank" id="bank" class="form-control" value="{{ $salary->bank }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $salary->account_number }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
