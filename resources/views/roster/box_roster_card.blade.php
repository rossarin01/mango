<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th rowspan="2" style="vertical-align: middle">พนักงาน</th>
                @foreach ($roster_template_details as $roster )
                    <input type="hidden" name="days[]" value="{{ $roster->day }}">
                    <th colspan="4" style="text-align: center">
                        <input type="date" name="workdate[{{ $roster->day }}]" value="{{ $roster->workdate ?? null }}" class="form-control">
                    </th>
                @endforeach
            </tr>
            <tr>
                @foreach ($roster_template_details as $roster )
                    <th>เข้า (เช้า) {{ date('H:i', strtoTime($roster->morning_shift)) }}</th>
                    <th>ออก (เช้า) {{ date('H:i', strtoTime($roster->morning_end)) }}</th>
                    <th>เข้า (บ่าย) {{ date('H:i', strtoTime($roster->evening_shift)) }}</th>
                    <th>ออก (บ่าย) {{ date('H:i', strtoTime($roster->evening_end)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee )
            <tr>
                <td>
                    {{ $employee->name }}
                    <input type="hidden" name="emp_id[{{ $employee->id }}]" value="{{ $employee->id }}">
                </td>
                @foreach ($roster_template_details as $key => $roster )
                    <td>
                        <input type="time" id="morning_shift_{{$employee->id}}_{{$key}}" name="morning_shift[{{ $employee->id }}][{{ $roster->day }}]" value="{{ $roster->morning_shift }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="morning_end_{{$employee->id}}_{{$key}}" name="morning_end[{{ $employee->id }}][{{ $roster->day }}]" value="{{ $roster->morning_end }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_end_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="evening_shift_{{$employee->id}}_{{$key}}" name="evening_shift[{{ $employee->id }}][{{ $roster->day }}]" value="{{ $roster->evening_shift }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="evening_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="evening_end_{{$employee->id}}_{{$key}}" name="evening_end[{{ $employee->id }}][{{ $roster->day }}]" value="{{ $roster->evening_end }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="evening_end_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $(document).on('click', '.btndel_detail', function(e){
        e.preventDefault();
        let input_id = $(this).data('column_id');
        $('#'+input_id).val('');
    });
</script>
