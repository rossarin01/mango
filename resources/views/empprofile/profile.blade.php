@extends('./layout/master')

@section('content')
<div class="full-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form_employee" enctype="multipart/form-data">
                        {{-- เก็บรหัส Id ตาราง Employees --}}
                        <input type="hidden" name="employeesid" id="employeesid" value="{{ $employees->id ?? null }}">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employees_id">Employee Code</label>
                                        <input type="text" name="employees_id" id="employees_id" value="{{ $employees->employees_id ?? null }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $employees->name ?? null }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <input type="hidden" name="branch" id="branch" value="{{ $employees->branch ?? null }}" class="form-control" readonly>
                                        <input type="text" name="branch_name" id="branch_name" value="{{ $employees->getbranch->branch_name ?? null }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="hidden" name="department" id="department" value="{{ $employees->department ?? null }}" class="form-control" readonly>
                                        <input type="text" name="branch_name" id="branch_name" value="{{ $employees->getdepartment->department_name ?? null }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><u>ข้อมูลส่วนตัว</u></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" rows="4" cols="50" class="form-control">{{ $employees->address ?? null }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="{{ $employees->email ?? null }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ $employees->phone ?? null }}" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><u>ข้อมูลส่วนภาษี</u></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">TFN</label>
                                        <input type="text" name="TFN" id="TFN" value="{{ $employees->TFN ?? null }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">Super Name</label>
                                        <input type="text" name="super_name" id="super_name" value="{{ $employees->super_name ?? null }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">Super Number</label>
                                        <input type="text" name="super_number" id="super_number" value="{{ $employees->super_number ?? null }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><u>ข้อมูลส่วนธนาคาร</u></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">BSB</label>
                                        <input type="text" name="BSB" id="BSB" value="{{ $employees->BSB ?? null }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">Account name</label>
                                        <input type="text" name="account_name" id="account_name" value="{{ $employees->account_name ?? null }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="name">Account number</label>
                                        <input type="text" name="account_number" id="account_number" value="{{ $employees->account_number ?? null }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><u>รูปภาพ</u></strong>
                                </div>
                            </div>
                            <div class="row  mb-5">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">รูปภาพ</label>
                                    <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)">
                                    <div id="preview-container" class="mt-3"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div id="image-cerrent" class="mt-3">
                                        @if(!is_null($employees->image))
                                            <p style="color:#FF0000"> รูปปัจจุบัน </p>
                                            <img src="{{ $employees->image }}" style="max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <hr> --}}
                            <input type="hidden" name="position" id="position" value="{{ $employees->position ?? null }}">
                            <div class="row"">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <button form="form_employee" type="submit" class="btn btn-primary">Save</button>
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

        $("#form_employee").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("empprofile.profile.store") }}',
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
                        window.location.href = '{{route("empprofile.profile")}}';
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

        function previewImage(event) {
            var input = event.target;
            var container = document.getElementById('preview-container');
            container.innerHTML = '';
            var reader = new FileReader();

            reader.onload = function(){
                var labelContainer = document.createElement('div');
                labelContainer.innerHTML = 'รูปภาพตัวอย่าง';
                labelContainer.style.margin = '5px';

                var imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';
                imgContainer.style.display = 'inline-block';
                imgContainer.style.margin = '5px';

                var img = document.createElement('img');
                img.src = reader.result;
                img.style.maxHeight  = '100px';
                imgContainer.appendChild(img);

                var removeBtn = document.createElement('button');
                removeBtn.innerHTML = '✖';
                removeBtn.style.position = 'absolute';
                removeBtn.style.top = '0';
                removeBtn.style.right = '0';
                removeBtn.style.background = 'red';
                removeBtn.style.color = 'white';
                removeBtn.style.border = 'none';
                removeBtn.style.borderRadius = '5%';
                removeBtn.style.cursor = 'pointer';
                removeBtn.style.padding = '5px';
                removeBtn.style.margin = '0px';
                removeBtn.style.width = '25px';
                removeBtn.style.height = '28px';

                removeBtn.onclick = function() {
                    container.removeChild(imgContainer);
                    $('#image').val('');
                };

                imgContainer.appendChild(labelContainer);
                imgContainer.appendChild(removeBtn);
                container.appendChild(imgContainer);


            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
