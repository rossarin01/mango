@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('department.create') }}" class="btn btn-primary">Add</a>
                        <div class="row mt-3">
                            <div class="col-3">
                                <select id="search_branch" name="branch" class="select2-icons form-select branch">
                                    @foreach ($branchs as $branch )
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="col-1">#</th>
                                            <th class="col-3">Branch</th>
                                            <th class="col-3">Department</th>
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
                url: "{{ route('department.datatable') }}",
                data: function(d) {
                    d.search_branch = $('#search_branch').val();
                },
            },
            columns: [
                { 'className': "text-center", data: 'rownum', name: 'rownum', orderable: false },
                { 'className': "text-center", data: 'branch', name: 'branch', orderable: false },
                { 'className': "text-left", data: 'department_name', name: 'department_name', orderable: false },
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

    $(document).on('click', '.btn_edit', function(e){
        e.preventDefault();
        let department_id =$(this).data('department_id');
        window.location.href= '{{ url("department") }}/'+department_id+'/edit';
    });


    $(document).on('click', '.btn_delete', function(e){
        e.preventDefault();
        let department_id = $(this).data('department_id');
        Swal.fire({
            title: 'Want to delete department data?',
            text: "You are deleting department data.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("department.delete") }}',
                    dataType: 'json',
                    data: {
                        'department_id' : department_id
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
