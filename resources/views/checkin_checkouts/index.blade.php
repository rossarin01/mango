@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <button id="btn_add_transaction" class="btn btn-primary">Add</button>
                        <div class="row mt-3">
                            <div class="col-3">
                                <select id="search_branch" name="branch" class="select2-icons form-select branch">
                                    @foreach ($branchs as $branch )
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select id='search_department' name="department" class="select2-icons form-select department">
                                    <option value="" data-icon="ti ti-brand-bootstrap">--Select--</option>
                                    @if(!is_null($departments))
                                        @foreach ($departments as $department )
                                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="date" id="search_workdate" name="search_workdate" class="form-control">
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="col-1">#</th>
                                            <th class="col-2">Emp Name</th>
                                            <th class="col-1">Workdate</th>
                                            <th class="col-1">CheckIn (M)</th>
                                            <th class="col-1">CheckOut (M)</th>
                                            <th class="col-1">CheckIn (E)</th>
                                            <th class="col-1">CheckOut (E)</th>
                                            <th class="col-2">Branch</th>
                                            <th class="col-2">Department</th>
                                            <th class="col-2">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade " id="modal_checkin">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="modalcontent">

            </div>
        </div>
    </div>
</div>
</div>


@endsection


@section('script')
<script>
    var oTable;
    $(document).ready(function () {
        oTable = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            responsive: true,
            ajax: {
                url: "{{ route('checkincheckout.datatable') }}",
                data: function(d) {
                    d.search_branch = $('#search_branch').val();
                    d.search_department = $('#search_department').val();
                    d.search_workdate = $('#search_workdate').val();
                },
            },
            columns: [
                { 'className': "text-center", data: 'rownum', name: 'rownum', orderable: false },
                { 'className': "text-left", data: 'employee_id', name: 'employee_id', orderable: false },
                { 'className': "text-center", data: 'workdate', name: 'workdate', orderable: false },
                { 'className': "text-center", data: 'morning_shift', name: 'morning_shift', orderable: false },
                { 'className': "text-center", data: 'morning_end', name: 'morning_end', orderable: false },
                { 'className': "text-center", data: 'evening_shift', name: 'evening_shift', orderable: false },
                { 'className': "text-center", data: 'evening_end', name: 'evening_end', orderable: false },
                { 'className': "text-center", data: 'branch', name: 'branch', orderable: false },
                { 'className': "text-left", data: 'department', name: 'department', orderable: false },
                { 'className': "text-center", data: 'btnedit', name: 'btnedit', orderable: false, searchable: false },
            ],
            order: [
                [0, 'asc']
            ],
            rowCallback: function(row, data, index) {

            },
            initComplete: function(settings, json) {

            }
        });
    });

    $(document).on('change', '#search_branch', function(e){
        e.preventDefault();
        oTable.draw();
    });

    $(document).on('change', '#search_department', function(e){
        e.preventDefault();
        oTable.draw();
    });

    $(document).on('change', '#search_workdate', function(e){
        e.preventDefault();
        oTable.draw();
    });

    $(document).on('click', '#btn_add_transaction', function(e){
        e.preventDefault();

        $.ajax({
            type: 'get',
            url: '{{ route("checkincheckout.gettransaction") }}',
            data: {
            },
            success: function(response) {
                console.log(response);
                if (response.status == 200) {
                    Swal.fire({
                        title: "Add Complate.!",
                        text: "add employee complate",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    oTable.ajax.reload();
                }
                if (response.status == 500) {
                    Swal.fire({
                        title: "Find Not Found.!",
                        text: response.message,
                        icon: "error",
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: "Find Not Found.!",
                    text: response.responseJSON.message,
                    icon: "error",
                    allowOutsideClick: false,
                });
                console.log("error");
                console.log(response.responseJSON);
            }
        });
    });

    $(document).on('click', '.btn_edit', function(e){
        e.preventDefault();
        let checkin_id =$(this).data('checkin_id');
        window.location.href= '{{ url("checkincheckout/edit/") }}/'+checkin_id;
    });

    $(document).on('click', '.btn_delete', function(e){
        e.preventDefault();
        let checkin_id =$(this).data('checkin_id');
        Swal.fire({
            title: 'Want to delete transaction time data?',
            text: "You are deleting transaction time data.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("checkincheckout.delete") }}',
                    dataType: 'json',
                    data: {
                        'checkin_id' : checkin_id
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
                            oTable.ajax.reload();
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

    $(document).on('change', '.branch', function(e){
        e.preventDefault();
        let branch_id = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route("getdepartment") }}',
            data: { 'branch_id': branch_id },
            dataType: 'json',
            success: function(response) {
                var index = 0;
                var option = '';
                console.log(response);
                $('select[name="department"]').html('');
                $.each(response, function(key, value) {
                    if (index == 0) {
                        option = `<option value="">-- Select --</option>`;
                        option += `<option value="${value.id}">${value.department_name}</option>`;
                    } else {
                        option = `<option value="${value.id}">${value.department_name}</option>`;
                    }
                    $('select[name="department"]').append(option);
                    index++;
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

</script>
@endsection
