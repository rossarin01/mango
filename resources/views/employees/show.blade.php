@extends('./layout/master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Employee ID:</strong>
                    {{ $employee->employees_id ?? '' }}</p>

                <p><strong>Name:</strong>
                    {{ $employee->name ?? '' }}</p>

                <p><strong>Department:</strong>
                    {{ $employee->getdepartment?->department_name ?? '' }}</p>

                <p><strong>Branch:</strong>
                    {{ $employee->getbranch->branch_name ?? '' }}</p>
            </div>
            <div class="col-md-6" style="text-align: center">
                @if(!is_null($employee->image))
                    <img src="{{ $employee->image }}" style="max-height: 130px;">
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <strong><u>ข้อมูลส่วนตัว</u></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <p><strong>Address:</strong>
                    {{ $employee->address ?? '' }}</p>

                <p><strong>Email:</strong>
                    {{ $employee->email ?? '' }}</p>

                <p><strong>Phone:</strong>
                    {{ $employee->phone ?? '' }}</p>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <strong><u>ข้อมูลส่วนภาษี</u></strong>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>TFN:</strong>
                    {{ $employee->TFN ?? '' }}</p>

                <p><strong>Super Name:</strong>
                    {{ $employee->super_name ?? '' }}</p>

                <p><strong>Super Number:</strong>
                    {{ $employee->super_number ?? '' }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <strong><u>ข้อมูลส่วนธนาคาร</u></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <p><strong>BSB:</strong>
                    {{ $employee->BSB ?? '' }}</p>

                <p><strong>Account Name:</strong>
                    {{ $employee->account_name ?? '' }}</p>

                <p><strong>Account Number:</strong>
                    {{ $employee->account_number ?? '' }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Position:</strong>
                    {{ $employee->position ?? '' }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ url('employeesedit').'/'.$employee->id }}" class="btn btn-warning">Edit</a>
                <button type="button" id="btn_delete" data-employee_id="{{ $employee->id }}" class="btn btn-danger">Delete</button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('click', '#btn_delete', function(e){
        e.preventDefault();
        let employee_id = $(this).data('employee_id');
        Swal.fire({
            title: 'Want to delete employee data?',
            text: "You are deleting employee data.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("employees.delete") }}',
                    dataType: 'json',
                    data: {
                        'employee_id' : employee_id
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                title: "Delete Complate.!",
                                text: "successfuly save complate",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            window.location.href = '{{ route("employees.index") }}';
                        }
                        if (response.status == 500) {
                            Swal.fire({
                                title: "Can not Delete.!",
                                text: response.message,
                                icon: "error",
                                allowOutsideClick: false,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
