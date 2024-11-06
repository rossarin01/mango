@extends('./layout/master')

@section('head')
@endsection

@section('content')
    <h3><i class="menu-icon tf-icons ti ti-users"></i> ผู้ใช้งานระบบ</h3>
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="row ">
                <div class="d-flex justify-content-between">
                    <div>
                        {{-- <input type="text" class="form-control" id="searchInput"> --}}
                    </div>
                    <div>
                        @can('user.create')
                            <button type="button" class="btn btn-primary btn_add" data-bs-toggle="modal">
                                <i class="ti ti-plus text-white ti-sm"></i>
                                เพิ่มใหม่
                            </button>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col-4">ชื่อ</th>
                            <th scope="col-4">อีเมล</th>
                            <th scope="col-2">อัพเดท</th>
                            <th scope="col-2"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ข้อมูลผู้ใช้ระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_user">
                        <input type="hidden" class="form-control" id="user_id" name="user_id">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">อีเมล</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="confirmpassword" class="form-label">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="switch">
                                    <input type="checkbox" id="is_active" name="is_active" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label for="is_active" class="form-label">สถานะใช้งาน</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary" form="form_user" id="submit_user">บันทึก</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editPermission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">กำหนดสิทธิ์การใช้งาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_permission">
                        <div id="permission_modal_content">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary" form="form_permission" id="submit_permission">บันทึก</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
{{-- select2 --}}
<script src="{{ asset('assets/js/app-ecommerce-category-list.js') }}"></script>

<script>

    var oTable;
    $(document).ready(function () {
        oTable = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            responsive: true,
            // scrollX: true,
            ajax: {
                url: "{{ route('user.datatable') }}",
                data: function(d) {
                    // d.search = $('#search').val();
                },
            },
            columns: [
                { 'className': "text-center", data: 'name', name: 'name', orderable: false },
                { 'className': "text-center", data: 'email', name: 'email', orderable: false },
                { 'className': "text-center", data: 'created_at', name: 'created_at', orderable: false },
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

    function resetForm()
    {
        $('#user_id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#confirmpassword').val('');
        $('#is_active').prop('checked', true);
    }

    $(document).on('click','.btn_add', function(e){
        e.preventDefault();
        resetForm();
        $("#password").prop('required',true);
        $("#confirmpassword").prop('required',true);
        $('#editUser').modal('show');
    });

    $(document).on('click', '.btn_edit', function(e) {
        e.preventDefault();
        let user_id = $(this).data('user_id');
        $.ajax({
            type: 'GET',
            url: '{{ route("user.update") }}',
            dataType: 'json',
            data: {
                'user_id' : user_id
            },
            success: function(response) {
                if (response.status == 200) {
                    resetForm();
                    $('#user_id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#email').val(response.data.email);
                    $("#password").prop('required',false);
                    $("#confirmpassword").prop('required',false);

                    if(response.data.isActive == 'N'){
                        $('#is_active').prop('checked', false);
                    }
                    $('#editUser').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX request failed');
                console.log(xhr.responseText);
            }
        });
    });


    $(document).on('click', '.btn_delete', function(e){
        e.preventDefault();
        let user_id = $(this).data('user_id');

        Swal.fire({
            title: 'ต้องการลบข้อมูล?',
            text: "คุณกำลังลบข้อมูล!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'GET',
                    url: '{{ route("user.delete") }}',
                    dataType: 'json',
                    data: {
                        'user_id' : user_id
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                title: "Delete Complate.!",
                                text: "successfuly delete complate",
                                icon: "success",
                                allowOutsideClick: false,
                            });
                            oTable.ajax.reload();
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

    $("#form_user").on("submit", function(e) {
        e.preventDefault();
        if ($('#password').val() !== $('#confirmpassword').val()) {

            Swal.fire({
                title: "ยืนยันรหัสผ่านไม่ถูกต้อง",
                text: "กรุณากรอกรหัสผ่านใหม่",
                icon: "error",
                allowOutsideClick: false,
            });

        }else{

            var formData = new FormData(this);
            Swal.fire({
                title: 'เพิ่มผู้ดูแลระบบ?',
                text: "คุณกำลังเพิ่มผู้ดูแลระบบ!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: '{{ route("user.store") }}',
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
                                    allowOutsideClick: false,
                                });
                                $('#editUser').modal('hide');
                                oTable.ajax.reload();
                            }
                            if (response.status == 500) {

                                Swal.fire({
                                    title: "Can not Save.!",
                                    text: response.message,
                                    icon: "error",
                                    allowOutsideClick: false,
                                });
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
                }
            });
        }

    });


    $(document).on('click', '.btn_permission', function(e){
        e.preventDefault();
        let user_id = $(this).data('user_id');

        $.ajax({
            type: 'GET',
            url: '{{ route("user.permission.update") }}',
            dataType: 'json',
            data: {
                'user_id' : user_id
            },
            success: function(response) {
                if (response.status == 200) {
                    $('#permission_modal_content').html(response.data);
                    $('#editPermission').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX request failed');
                console.log(xhr.responseText);
            }
        });



    });

    $("#form_permission").on("submit", function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        Swal.fire({
            title: 'กำหนดสิทธิ์?',
            text: "คุณกำลังกำหนดสิทธิ์ดูแลระบบ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'POST',
                    url: '{{ route("user.permission.store") }}',
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
                                allowOutsideClick: false,
                            });
                            $('#editPermission').modal('hide');
                            oTable.ajax.reload();
                        }
                        if (response.status == 500) {

                            Swal.fire({
                                title: "Can not Save.!",
                                text: response.message,
                                icon: "error",
                                allowOutsideClick: false,
                            });
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
            }
        });

    });


</script>
@endsection
