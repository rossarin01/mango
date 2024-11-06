<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th rowspan="2" style="vertical-align: middle">พนักงาน</th>
                @foreach ($roster_template_details as $roster_temp )
                    <input type="hidden" name="days[]" value="{{ $roster_temp->day }}">
                    <th colspan="4" style="text-align: center">
                        @php
                            $date = null;
                            if(isset($roster_group_date[$roster_temp->day])){
                                $date = $roster_group_date[$roster_temp->day];
                            }
                        @endphp
                        <input type="date" name="workdate[{{ $roster_temp->day }}]" value="{{ $date ?? null }}"
                        class="form-control">
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

                @foreach ($roster_template_details as $key => $roster_temp )
                    @foreach ($roster_details as $roster )
                        @php
                            if($roster->employee_id == $employee->id){
                                if($roster->day == $roster_temp->day){
                                    $roster_id = $roster->id;
                                    $roster_morning_shift = $roster->morning_shift;
                                    $roster_morning_end = $roster->morning_end;
                                    $roster_evening_shift = $roster->evening_shift;
                                    $roster_evening_end = $roster->evening_end;
                                }
                            }
                        @endphp
                    @endforeach
                    <input type="hidden" name="roster_detail_id[{{ $roster_id }}]" value="{{ $roster_id ?? '' }}">
                    <td>
                        <input type="time" id="morning_shift_{{$employee->id}}_{{$key}}" name="morning_shift[{{ $roster_id }}]" value="{{ $roster_morning_shift ?? '' }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="morning_end_{{$employee->id}}_{{$key}}" name="morning_end[{{ $roster_id }}]" value="{{ $roster_morning_end ?? '' }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_end_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="evening_shift_{{$employee->id}}_{{$key}}" name="evening_shift[{{ $roster_id }}]" value="{{ $roster_evening_shift ?? '' }}">
                        <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="evening_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                            <i class="ti ti-trash text-white ti-sm"></i>
                        </button>
                    </td>
                    <td>
                        <input type="time" id="evening_end_{{$employee->id}}_{{$key}}" name="evening_end[{{ $roster_id }}]" value="{{ $roster_evening_end ?? '' }}">
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
