@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('checkincheckout.index') }}" class="btn btn-primary">Back</a>
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
                        <form id="form_checkincheckout" enctype="multipart/form-data">
                            {{-- เก็บรหัส Id ตาราง Employees --}}
                            <input type="hidden" name="checkin_id" id="checkin_id" value="{{ $checkin_checkout->id ?? null }}">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employees_id">Employee Code</label>
                                            <input type="text" name="employees_id" id="employees_id" value="{{ $checkin_checkout->employee->employees_id ?? null }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="name">Employee Name</label>
                                            <input type="text" name="name" id="name" value="{{ $checkin_checkout->employee->name ?? null }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="branch">Branch</label>
                                            <select name='branch' class="select2-icons form-select branch" disabled>
                                                @foreach ($branchs as $branch )
                                                    @if($branch->id == $checkin_checkout->branch_id)
                                                        <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                                    @else
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select name='department' class="select2-icons form-select department" disabled>
                                                @foreach ($departments as $department )
                                                    @if($department->id == $checkin_checkout->department_id)
                                                        <option value="{{ $department->id }}" data-icon="ti ti-brand-bootstrap" selected>{{ $department->department_name }}</option>
                                                    @else
                                                        <option value="{{ $department->id }}" data-icon="ti ti-brand-bootstrap">{{ $department->department_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="address">Working Date</label>
                                            <input type="date" name="workdate" id="workdate" value="{{ $checkin_checkout->workdate ?? null }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="morning_shift">CheckIn (M)</label>
                                            <input type="time" name="morning_shift" id="morning_shift" value="{{ $checkin_checkout->morning_shift ?? null }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="morning_end">CheckOut (M)</label>
                                            <input type="time" name="morning_end" id="morning_end" value="{{ $checkin_checkout->morning_end ?? null }}" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="evening_shift">CheckIn (E)</label>
                                            <input type="time" name="evening_shift" id="evening_shift" value="{{ $checkin_checkout->evening_shift ?? null }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="evening_end">CheckOut (E)</label>
                                            <input type="time" name="evening_end" id="evening_end" value="{{ $checkin_checkout->evening_end ?? null }}" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row mt-3"">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <button form="form_checkincheckout" type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        $("#form_checkincheckout").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("checkincheckout.store") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            title: "Save Complate.!",
                            text: "successfuly save complate",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = '{{route("checkincheckout.index")}}';
                    }
                },
                error: function(response) {
                    Swal.fire({
                        title: "Can not Save.!",
                        text: response.responseJSON.message,
                        icon: "error",
                        allowOutsideClick: false,
                    });
                    console.log("error");
                    console.log(response.responseJSON);

                }
            });
        });


    </script>
@endsection
