@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('rostertemplate.index') }}" class="btn btn-primary">Back</a>
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
                    <form id="froster_detail">
                        <div class="container">
                            <input type="hidden" name="rostertemp_id" id="rostertemp_id" value="{{ $roster_template->id ?? null }}" class="form-control">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $roster_template->name ?? null }}" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select name='branch' class="select2-icons form-select branch" required>
                                        @foreach ($branchs as $branch)
                                            @if(!is_null($roster_template) && $roster_template->branch_id == $branch->id)
                                                <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                            @else
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                        <select name='department' class="select2-icons form-select department" required>
                                            @if(!is_null($departments) && $departments->isNotEmpty())
                                                @foreach ($departments as $department)
                                                    @if(!is_null($roster_template) && $roster_template->department_id == $department->id)
                                                        <option value="{{ $department->id }}" selected>{{ $department->department_name }}</option>
                                                    @else
                                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                </div>
                                <br>
                                <hr>
                                <div id="box_roster">
                                    @if(!is_null($roster_template))
                                        @if($roster_template->roster_template_detail->isNotEmpty())
                                            @foreach ($roster_template->roster_template_detail as $key => $rostertemp_detail)
                                                {!! view('roster_template.box_roster_card', [
                                                    'numItems' => $key+1,
                                                    'rostertemp_detail' => $rostertemp_detail
                                                ]) !!}
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <br>
                                <button id="btn_plus" class="btn btn-primary">เพิ่มรายการ</button>
                                <hr>
                                <button type="submit" form="froster_detail" class="btn btn-primary">Save</button>
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

    $("#froster_detail").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("rostertemplate.store") }}',
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
                        title: "บันทึกสำเร็จ.!",
                        text: "บันทึกข้อมูลสำเร็จ",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href="{{ url('rostertemplate') }}";
                }
            },
            error: function(response) {
                Swal.fire({
                    title: "ไม่สามารบันทึกข้อมูล",
                    text: response.responseJSON.message,
                    icon: "error",
                    allowOutsideClick: false,
                });
                console.log("error");
                console.log(response.responseJSON);
            }
        });
    });

    $(document).on('click', '#btn_plus', function(e){
        e.preventDefault();
        let numItems = $('.roster_card').length + 1;
        $.ajax({
            type: 'GET',
            url: '{{ route("rostertemplate.plus.detail") }}',
            data: {
                'numItems': numItems,
            },
            success: function(response) {
                $('#box_roster').append(response);
            },
            error: function(response) {

                console.log("error");
                console.log(response.responseJSON);
            }
        });
    })

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
