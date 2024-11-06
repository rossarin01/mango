<style>
    .thead{
        background-color: #FFa;
        font-weight: bold;
    }
</style>
<div style="page-break-after: always;">
    <table>
        <tr>
            <td colspan="37" style="text-align: center"><h1 style="font-size: 35px;"><strong>{{ $roster->branch->branch_name }}</strong></h1></td>
        </tr>
        <tr>
            <td colspan="37" style="text-align: center"><h3 style="font-size: 25px;"><strong>{{ $roster->department->department_name }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="2">อัพเดท {{ date('Y-m-d') }}</td>
        </tr>
        <tr>
            <td style="height: 20px;"></td>
        </tr>
    </table>

    @php
        $total_hours_day = [];
    @endphp
    <table class="table table-bordered" style="border: 1px solid #000">
        <thead class="thead">
            <tr>
                <th rowspan="3" style="vertical-align: middle">รายชื่อ</th>
                @foreach ($roster_template_details as $roster_temp )
                    <th colspan="5" style="text-align: center">
                        @php
                            $date = null;
                            if(isset($roster_group_date[$roster_temp->day])){
                                $date = $roster_group_date[$roster_temp->day];
                                $total_hours_day[$roster_temp->day] = 0;

                                $date = date('D, j M Y', strtotime($date));
                            }
                        @endphp
                        {{ $date ?? null }}
                    </th>
                @endforeach
                <th rowspan="3" style="vertical-align: middle"><strong>TOTAL HOURS</strong></th>
            </tr>
            <tr>
                @foreach ($roster_template_details as $roster_temp)
                    @php
                        $tem_morning_shift = date('H:i', strtoTime($roster_temp->morning_shift));
                        $tem_evening_end = date('H:i', strtoTime($roster_temp->evening_end));
                    @endphp
                    <th colspan="2" style="text-align: center">เช้า ({{ $tem_morning_shift }})</th>
                    <th colspan="2" style="text-align: center">เย็น ({{ $tem_evening_end }})</th>
                    <th></th>
                @endforeach
            </tr>
            <tr>
                @foreach ($roster_template_details as $roster_temp)
                    @php
                        $count[$roster_temp->day]['morning_shift'] = 0;
                        $count[$roster_temp->day]['evening_shift'] = 0;
                    @endphp
                    @foreach ($roster_details as $roster)
                        @php
                            if($roster_temp->day == $roster->day && !is_null($roster->morning_shift) && !is_null($roster->morning_end)){
                                $count[$roster_temp->day]['morning_shift'] = $count[$roster_temp->day]['morning_shift'] + 1;
                            }
                            if($roster_temp->day == $roster->day && !is_null($roster->evening_shift) && !is_null($roster->evening_end)){
                                $count[$roster_temp->day]['evening_shift'] = $count[$roster_temp->day]['evening_shift'] + 1;
                            }
                        @endphp
                    @endforeach
                    <th colspan="2" style="text-align: center"><strong>{{ $count[$roster_temp->day]['morning_shift'] }}</strong></th>
                    <th colspan="2" style="text-align: center"><strong>{{ $count[$roster_temp->day]['evening_shift'] }}</strong></th>
                    <th style="text-align: center"><strong>HR</strong></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $all_total_hours = 0;
            @endphp
            @foreach ($employees as $employee )
            <tr>
                <td>
                    {{ $employee->name }}
                </td>
                @php
                    $total_hours = 0;
                @endphp
                @foreach ($roster_template_details as $key => $roster_temp )
                    @foreach ($roster_details as $roster )
                        @php
                            if($roster->employee_id == $employee->id){
                                if($roster->day == $roster_temp->day){
                                    $roster_morning_shift = (!is_null($roster->morning_shift) ? date('H:i', strtotime($roster->morning_shift)) : 'OFF');
                                    $roster_morning_end = (!is_null($roster->morning_end) ?date('H:i', strtotime($roster->morning_end)) : 'OFF');
                                    $roster_evening_shift = (!is_null($roster->evening_shift) ? date('H:i', strtotime($roster->evening_shift)) : 'OFF');
                                    $roster_evening_end = (!is_null($roster->evening_end) ? date('H:i', strtotime($roster->evening_end)) : 'OFF');

                                    // คำนวณช่ั่วโมง
                                    $hr_morning = 0;
                                    $hr_evening = 0;

                                    if(!is_null($roster->morning_shift) && !is_null($roster->morning_end)){
                                        $morning_shift = strtotime($roster->morning_shift);
                                        $morning_end = strtotime($roster->morning_end);
                                        $hr_morning = round( abs($morning_shift - $morning_end) / 3600, 2 );
                                    }
                                    if(!is_null($roster->evening_shift) && !is_null($roster->evening_end)){
                                        $evening_shift = strtotime($roster->evening_shift);
                                        $evening_end = strtotime($roster->evening_end);
                                        $hr_evening = round( abs($evening_shift - $evening_end) / 3600, 2 );
                                    }

                                    $hr = round($hr_morning + $hr_evening , 2);
                                    $total_hours += $hr;

                                    (isset($total_hours_day[$roster->day]) ? $total_hours_day[$roster->day] += $hr : 0);
                                    $all_total_hours += $hr;
                                }
                            }
                        @endphp
                    @endforeach

                    @if($hr_morning > 0)
                        <td style="text-align: center">{{ $roster_morning_shift }}</td>
                        <td style="text-align: center">{{ $roster_morning_end }}</td>
                    @else
                        <td colspan="2" style="text-align: center"><strong>OFF</strong></td>
                    @endif
                    @if($hr_evening > 0)
                        <td style="text-align: center">{{ $roster_evening_shift }}</td>
                        <td style="text-align: center">{{ $roster_evening_end }}</td>
                    @else
                        <td colspan="2" style="text-align: center"><strong>OFF</strong></td>
                    @endif

                    <td style="text-align: center"><strong>{{ $hr }}</strong></td>

                @endforeach

                <td>
                    <strong>{{ $total_hours }}</strong>
                </td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Total</strong></td>
                @foreach ($roster_template_details as $roster_temp )
                    @php
                        $total_hours_day_text = 0;
                        if(isset($roster_group_date[$roster_temp->day])){
                            $date = $roster_group_date[$roster_temp->day];
                            $total_hours_day_text = $total_hours_day[$roster_temp->day] ?? 0;
                        }
                    @endphp
                    <td colspan="5" style="text-align: center">
                        <strong>{{ $total_hours_day_text }}</strong>
                    </td>
                @endforeach
                <td style="vertical-align: middle">
                    <strong>{{ $all_total_hours }}</strong>
                </td>
            </tr>
        </tfoot>
    </table>

</div>
