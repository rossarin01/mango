@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Date</th>
                                        <th>Fingerprint
                                            <div>break-start</div></th>
                                        <th>Fingerprint
                                            <div>break-start(edit)</div></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approve as $approve)
                                        <tr>
                                            <td>{{ $approve->employees_id }}</td>
                                            <td>{{ $approve->date }}</td>
                                            <td>{{ $approve->fingerprint_break_start }}</td>
                                            <td>{{ $approve->fingerprint_break_start(edit) }}</td>
                                            <td>

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
