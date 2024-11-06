@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
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
                            <div class="col-6" style="text-align: right">
                                <a href="{{ route('calculatesalary.create') }}" class="btn btn-primary">Add</a>
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
                                            <th class="col">#</th>
                                            <th class="col">Branch</th>
                                            <th class="col">Department</th>
                                            <th class="col">Name</th>
                                            <th class="col">Actions</th>
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
                url: "{{ route('calculatesalary.datatable') }}",
                data: function(d) {
                    d.search_branch = $('#search_branch').val();
                    d.search_department = $('#search_department').val();
                },
            },
            columns: [
                { 'className': "text-center", data: 'rownum', name: 'rownum', orderable: false },
                { 'className': "text-left", data: 'branch', name: 'branch', orderable: false },
                { 'className': "text-left", data: 'department', name: 'department', orderable: false },
                { 'className': "text-left", data: 'name', name: 'name', orderable: false },
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

    $(document).on('click', '.btn_edit', function(e){
        e.preventDefault();
        let calculate_salary_id =$(this).data('calculate_salary_id');
        window.location.href= '{{ url("calculatesalary/edit") }}/'+calculate_salary_id;
    });


    $(document).on('click', '.btn_export', function(e){
        e.preventDefault();
        let calculate_salary_id =$(this).data('calculate_salary_id');
        window.location.href= '{{ url("calculatesalary/export") }}/'+calculate_salary_id;
    });


    $(document).on('click', '.btn_delete', function(e){
        e.preventDefault();
        let calculate_salary_id =$(this).data('calculate_salary_id');
        Swal.fire({
            title: 'Want to delete salary data?',
            text: "You are deleting salary data.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("calculatesalary.delete") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        'calculate_salary_id' : calculate_salary_id
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
</script>
@endsection
