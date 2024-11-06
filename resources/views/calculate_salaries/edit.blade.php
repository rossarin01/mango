@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('calculatesalary.index') }}" class="btn btn-primary">Back</a>
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
                    <form id="fcalculate_salary">
                        <input type="hidden" name="calculate_salary_id" value="{{ $calculate_salary->id ?? '' }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name='branch' id="branch" class="select2-icons form-select branch" required >
                                            @foreach ($branchs as $branch)
                                                @if(!is_null($calculate_salary) && $calculate_salary->branch_id == $branch->id)
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
                                                @if(!is_null($calculate_salary) && $calculate_salary->department_id == $department->id)
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
                                        <label for="roster">Roster</label>
                                        <select name='roster' id="roster" class="select2-icons form-select roster" required>
                                            @if(!is_null($rosters))
                                                <option value="">--Select--</option>
                                                @foreach ($rosters as $roster)
                                                    @if(!is_null($calculate_salary) && $calculate_salary->roster_id == $roster->id)
                                                        <option value="{{ $roster->id }}" selected>{{ $roster->name }}</option>
                                                    @else
                                                        <option value="{{ $roster->id }}">{{ $roster->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-4">
                                        <button type="button" id="btn_gensalary" class="btn btn-primary">Gen</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="salary_name">Salary Name</label>
                                    <input type="text" name="salary_name" id="salary_name" value="{{ $calculate_salary->name }}"
                                        class="form-control" placeholder="Salary name" required>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div id="box_roster">
                                        {{-- พื้นที่แสดงตาราง box_roster_card --}}
                                        @if(!is_null($calculate_salary))
                                            {!! view('calculate_salaries.box_salary_card', [
                                                'roster_workdates' => $roster_workdates,
                                                'roster_template_details' => $roster_template_details,
                                                'employees' => $employees,
                                                'roster_tempalte_times' => $roster_tempalte_times,
                                                'checkin_checkouts' => $checkin_checkouts,
                                                'calculate_salary_weeklies' => $calculate_salary_weeklies
                                            ]) !!}
                                        @endif
                                    </div>
                                    <br>
                                    <hr>
                                    <button type="submit" form="fcalculate_salary" class="btn btn-primary">Save</button>
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

$(document).on('click', '.btndel_detail', function(e){
        e.preventDefault();
        let input_id = $(this).data('column_id');
        $('#'+input_id).val('');
    });

$(document).on('keyup change', '.weekday_rate, .weekend_rate, .weekend_diff, .weekend_surcharge', function(){
    let input_id = $(this).data('column_id');
    let weekday_total_hours = parseFloat($('#weekday_total_hours_'+input_id).val()) || 0;
    let weekend_total_hours = parseFloat($('#weekend_total_hours_'+input_id).val()) || 0;
    let weekday_rate = parseFloat($('#weekday_rate_'+input_id).val()) || 0;
    let weekend_rate = parseFloat($('#weekend_rate_'+input_id).val()) || 0;

    let pay = (weekday_total_hours * weekday_rate) + (weekend_total_hours * weekend_rate);
    pay = parseFloat(pay).toFixed(2);

    $('#weekend_payment_'+input_id).val(pay);

    let weekend_payment = parseFloat($('#weekend_payment_'+input_id).val()) || 0;
    let weekend_diff = parseFloat($('#weekend_diff_'+input_id).val()) || 0;
    let weekend_surcharge = parseFloat($('#weekend_surcharge_'+input_id).val()) || 0;

    let total = (weekend_payment + weekend_diff + weekend_surcharge);
    total = parseFloat(total).toFixed(2);

    $('#weekend_total_'+input_id).val(total);
});

$("#fcalculate_salary").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("calculatesalary.store") }}',
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

                    window.location.href="{{ route('calculatesalary.index') }}";
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

    $(document).on('click', '#btn_gensalary', function(e){
        e.preventDefault();
        let branch_id = $('#branch').val();
        let department_id = $('#department').val();
        let roster_id = $('#roster').val();

        $.ajax({
            type: 'GET',
            url: '{{ route("calculatesalary.detail.create") }}',
            data: {
                'branch_id': branch_id,
                'department_id': department_id,
                'roster_id': roster_id,
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
            url: '{{ route("getroster") }}',
            data: {
                'branch_id': branch_id,
                'department_id': department_id
            },
            dataType: 'json',
            success: function(response) {
                var index = 0;
                var option = '';
                console.log(response);
                $('select[name="roster"]').html('');
                $.each(response, function(key, value) {
                    if (index == 0) {
                        option = `<option value="">-- Select --</option>`;
                        option += `<option value="${value.id}">${value.name}</option>`;
                    } else {
                        option = `<option value="${value.id}">${value.name}</option>`;
                    }
                    $('select[name="roster"]').append(option);
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
