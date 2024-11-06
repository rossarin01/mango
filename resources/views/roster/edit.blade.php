@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('roster.index') }}" class="btn btn-primary">Back</a>
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
                        <input type="hidden" name="roster_id" value="{{ $roster->id ?? '' }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name='branch' id="branch" class="select2-icons form-select branch" required>
                                            @foreach ($branchs as $branch)
                                                @if(!is_null($roster) && $roster->branch_id == $branch->id)
                                                    <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                                @else
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select name='department' id="department" class="select2-icons form-select department" required>
                                            @foreach ($departments as $department)
                                                @if(!is_null($roster) && $roster->department_id == $department->id)
                                                    <option value="{{ $department->id }}" selected>{{ $department->department_name }}</option>
                                                @else
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="roster_template">Roster Template</label>
                                        <select name='roster_template' id="roster_template" class="select2-icons form-select roster_template" required>
                                            @if(!is_null($roster_templates))
                                                <option value="">--Select--</option>
                                                @foreach ($roster_templates as $template)
                                                    @if($roster->roster_template_id == $template->id)
                                                        <option value="{{ $template->id }}" selected>{{ $template->name }}</option>
                                                    @else
                                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-4">
                                        {{-- <button type="button" id="btn_gentemplate" class="btn btn-primary">Gen</button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="roster_template">Roster Name</label>
                                    <input type="text" name="roster_name" id="roster_name" value="{{ $roster->name ?? '' }}" class="form-control" placeholder="roster name" required>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div id="box_roster">
                                        {{-- พื้นที่แสดงตาราง box_roster_card --}}
                                        @if(!is_null($roster_details) && $roster_details->isNotEmpty())
                                            {!! view('roster.box_roster_edit_card', [
                                                'roster_template_details' => $roster_template_details,
                                                'roster' => $roster,
                                                'roster_details' => $roster_details,
                                                'employees' => $employees,
                                                'roster_group_date' => $roster_group_date
                                            ]) !!}
                                        @endif
                                    </div>
                                    <br>
                                    <hr>
                                    <button type="submit" form="froster_detail" class="btn btn-primary">Save</button>
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
$("#froster_detail").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("roster.update") }}',
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

                    window.location.href="{{ url('roster') }}";
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

    $(document).on('click', '#btn_gentemplate', function(e){
        e.preventDefault();
        let branch_id = $('#branch').val();
        let department_id = $('#department').val();
        let roster_template_id = $('#roster_template').val();

        $.ajax({
            type: 'GET',
            url: '{{ route("roster.detail.create") }}',
            data: {
                'branch_id': branch_id,
                'department_id': department_id,
                'roster_template_id': roster_template_id,
            },
            success: function(response) {
                $('#box_roster').html(response);
            },
            error: function(response) {

                console.log("error");
                console.log(response.responseJSON);
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

    $(document).on('change', '.department', function(e){
        e.preventDefault();
        let branch_id = $('.branch').val();
        let department_id = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route("getrostertemplate") }}',
            data: {
                'branch_id': branch_id,
                'department_id': department_id
            },
            dataType: 'json',
            success: function(response) {
                var index = 0;
                var option = '';
                console.log(response);
                $('select[name="roster_template"]').html('');
                $.each(response, function(key, value) {
                    if (index == 0) {
                        option = `<option value="">-- Select --</option>`;
                        option += `<option value="${value.id}">${value.name}</option>`;
                    } else {
                        option = `<option value="${value.id}">${value.name}</option>`;
                    }
                    $('select[name="roster_template"]').append(option);
                    index++;
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });


    $(document).on('click', '.btndel_detail', function(e){
        e.preventDefault();
        let input_id = $(this).data('column_id');
        $('#'+input_id).val('');
    });

</script>
@endsection
