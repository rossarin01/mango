@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('salaries.employees.mangococo.bakery.index') }}" class="btn btn-primary">Back</a>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                        <form action="{{ route('salaries.employees.mangococo.bakery.store') }}" method="POST">
                            @csrf
                                <div class="container">
                                    <div class="col-md-8">
                                    <div class="form-group">
                                            <label for="employees_id">Employee ID</label>
                                            <input type="number" name="employees_id" id="employees_id" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input type="text" name="department" id="department" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="payment_method">Payment Method</label>
                                            <input type="text" name="payment_method" id="payment_method" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <input type="text" name="payment_type" id="payment_type" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="bank">Bank</label>
                                            <input type="text" name="bank" id="bank" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="account_number">Account Number</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="">
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
