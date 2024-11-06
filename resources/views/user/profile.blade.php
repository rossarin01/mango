@extends('./layout/master')

@section('head')
@endsection

@section('content')
    <h3><i class="menu-icon tf-icons ti ti-users"></i> ผู้ใช้งานระบบ</h3>
    <div class="card" style="width: 50%; margin-left:auto; margin-right:auto">
        <div class="card-body">
            <div class="row ">
                <form id="form_user">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id ?? '' }}">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name ?? '' }}" aria-describedby="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name ?? '' }}" aria-describedby="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Department</label>
                            <input type="email" class="form-control" id="department" name="department" value="{{ $user->department ?? '' }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Branch</label>
                            <input type="email" class="form-control" id="branch" name="branch" value="{{ $user->branch ?? '' }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password" class="form-label">Passwoard</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" form="form_user" id="submit_user">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
{{-- select2 --}}
<script src="{{ asset('assets/js/app-ecommerce-category-list.js') }}"></script>

<script>


$("#form_user").on("submit", function(e) {
    e.preventDefault();

    // เตรียมข้อมูลจากฟอร์ม
    var formData = new FormData(this);

    // แสดงการยืนยันก่อนแก้ไขข้อมูล
    Swal.fire({
        title: 'แก้ไขข้อมูล?',
        text: "คุณกำลังแก้ไขข้อมูล!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {

            // ทำคำขอ AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route("user.profile.update") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    // ตรวจสอบสถานะการตอบกลับ
                    if (response.status === 200) {
                        Swal.fire({
                            title: "บันทึกสำเร็จ!",
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            icon: "success",
                            allowOutsideClick: false,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else if (response.status === 500) {
                        Swal.fire({
                            title: "ไม่สามารถบันทึกข้อมูลได้",
                            text: response.message,
                            icon: "error",
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(response) {
                    // จัดการข้อผิดพลาดจากเซิร์ฟเวอร์
                    var errorMessage = response.responseJSON ? response.responseJSON.message : "เกิดข้อผิดพลาดในการส่งคำขอ";
                    Swal.fire({
                        title: "ไม่สามารถบันทึกข้อมูลได้",
                        text: errorMessage,
                        icon: "error",
                        allowOutsideClick: false,
                    });
                    console.log("Error:", errorMessage);
                }
            });
        }
    });
});



</script>
@endsection
