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
                        <a href="{{ route('branch.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                            <form action="{{ route('branch.update', $branch->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" name="id" id="id" class="form-control" value="{{ $branch->id }}" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="branch_name">Branch Name</label>
                                    <input type="text" name="branch_name" id="branch_name" class="form-control" value="{{ $branch->branch_name }}" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
